<?php
require_once 'Caliper/request/Envelope.php';
require_once 'Caliper/request/EventStoreRequestor.php';

class HttpRequestor extends EventStoreRequestor {
    private $options;

    /** @param Options $options */
    public function __construct(Options $options) {
        $this->setOptions($options);
    }

    /** @return Options */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return $this|HttpRequestor
     */
    public function setOptions($options) {
        $this->options = $options;
        return $this;
    }

    /**
     * @param Entity|Event|Entity[]|Event[] $items
     * @return bool success
     */
    public function send($sensorId, $items) {
        $status = false;

        if (!is_array($items)) {
            $items = [$items];
        }

        foreach ($items as $aItem) {
            if (!(($aItem instanceof Entity) || ($aItem instanceof Event))) {
                throw new InvalidArgumentException(__METHOD__ .
                    ': array of ' . Entity::class . ' or ' . Event::class . ' expected');
            }
        }

        $envelope = (new Envelope())
            ->setSensorId($sensorId)
            ->setData($items);

        $payload = json_encode($envelope, $this->getOptions()->getJsonEncodeOptions());

        $request = new http\Client\Request(
            'POST',
            $this->getOptions()->getHost(),
            [
                'Content-Type' => 'application/json',
                'Authorization' => $this->getOptions()->getApiKey(),
            ],
            (new http\Message)->getBody()->append($payload)
        );
        $request->setOptions([
            'timeout' => $this->getOptions()->getConnectionTimeout()
        ]);

        $client = (new http\Client)->enqueue($request)->send();
        $response = $client->getResponse($request);

        $responseCode = $response->getResponseCode();

        if ($responseCode != 200) {
            throw new RuntimeException('Failure: HTTP error code: ' . $responseCode);
        } else {
            $status = true;
        }

        return $status;
    }
}
