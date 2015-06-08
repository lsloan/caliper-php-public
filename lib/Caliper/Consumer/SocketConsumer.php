<?php

class SocketConsumer extends QueueConsumer {
    protected $type = 'Socket';
    protected $options;

    /**
     * Creates a new socket consumer for dispatching async requests immediately
     * @param string $apiKey
     * @param array $options
     */
    public function __construct($apiKey, $options = []) {
        $defaultOptions = [
            'host' => 'http://localhost/',
            'timeout' => 0.5,
            'sensorId' => null,
            'jsonEncodeOptions' => JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
            'debug' => false,
        ];

        $this->options = array_merge($defaultOptions, $options);

        parent::__construct($apiKey, $this->options);
    }

    /**
     * @param Entity|Event $item
     * @return bool success
     */
    public function flushSingleItem($item) {
        if (!(($item instanceof Entity) || ($item instanceof Event))) {
            throw new InvalidArgumentException(__METHOD__ . ': Entity or Event object expected');
        }

        $envelope = (new Envelope())
            ->setSensor($this->options['sensorId'])
            ->setData($item);

        $payload = json_encode($envelope, $this->options['jsonEncodeOptions']);

        $request = new http\Client\Request(
            'POST',
            $this->options['host'],
            [
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
            ],
            (new http\Message)->getBody()->append($payload)
        );

        $client = (new http\Client)->enqueue($request)->send();
        $response = $client->getResponse($request);

        return ($response->getResponseCode() === 200);
    }
}
