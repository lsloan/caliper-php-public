<?php

class Caliper_Consumer_Socket extends Caliper_QueueConsumer {
    protected $type = 'Socket';
    protected $options;
    private $socket_failed;

    /**
     * Creates a new socket consumer for dispatching async requests immediately
     * @param string $apiKey
     * @param array $options
     *     number   "timeout" - the timeout for connecting
     *     function "error_handler" - function called back on errors.
     *     boolean  "debug" - whether to use debug output, wait for response.
     */
    public function __construct($apiKey, $options = array()) {
        $this->options = $options;

        if (!isset($this->options['timeout']))
            $this->options['timeout'] = 0.5;

        if (!isset($this->options['host']))
            $this->options['host'] = 'localhost';

        if (!isset($this->options['describeURI']))
            $this->options['describeURI'] = '/v1/describe';

        if (!isset($this->options['sendURI']))
            $this->options['sendURI'] = '/v1/send';

        if (!isset($this->options['sensorId']))
            $this->options['sensorId'] = null;

        if (!isset($this->options['jsonEncodeOptions']))
            $this->options['jsonEncodeOptions'] = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

        parent::__construct($apiKey, $this->options);
    }

    public function flushSingleDescribe($item, $apiKey, $sensor) {
        $socket = $this->createSocket();

        if (!$socket)
            return;

        $envelope = (new Envelope())
            ->setSensor($sensor)
            ->setData($item);

        $payload = json_encode($envelope, $this->options['jsonEncodeOptions']);

        $body = $this->createDescribeBody($this->options['host'], $apiKey, $payload);

        return $this->makeRequest($socket, $body);
    }

    private function createSocket() {

        if ($this->socket_failed)
            return false;

        $protocol = $this->ssl() ? "ssl" : "tcp";
        $host = $this->options["host"];
        if ($this->options["port"]) {
            $port = $this->options["port"];
        } else {
            $port = $this->ssl() ? 443 : 80;
        }
        $timeout = $this->options["timeout"];

        try {
            # Open our socket to the API Server.
            $socket = pfsockopen($protocol . "://" . $host, $port, $errno,
                $errstr, $timeout);

            # If we couldn't open the socket, handle the error.
            if ($errno != 0) {
                $this->handleError($errno, $errstr);
                $this->socket_failed = true;
                return false;
            }

            if ($this->debug()) {
                echo "<pre>[DEBUG] Connected to event store: ${protocol}://${host}:${port}</pre>\n";
            }

            return $socket;

        } catch (Exception $e) {
            $this->handleError($e->getCode(), $e->getMessage());
            $this->socket_failed = true;
            return false;
        }
    }

    /**
     * Create the body to send as the post request.
     * @param  string $host
     * @param  string $content
     * @return string body
     */
    private function createDescribeBody($host, $apiKey, $content) {

        $req = "";
        $req .= "POST " . $this->options["describeURI"] . " HTTP/1.1\r\n";
        $req .= "Host: " . $host . "\r\n";
        $req .= "Authorization: " . $apiKey . "\r\n";
        $req .= "Content-Type: application/json\r\n";
        $req .= "Accept: application/json\r\n";
        $req .= "Content-length: " . strlen($content) . "\r\n";
        $req .= "\r\n";
        $req .= $content;

        return $req;
    }

    /**
     * Attempt to write request to the socket.
     * Wait for response only if debug mode is enabled.
     *
     * @param  stream $socket the handle for the socket
     * @param  string $req request body
     * @return boolean $success
     */
    private function makeRequest($socket, $req, $retry = true) {

        $bytes_written = 0;
        $bytes_total = strlen($req);
        $closed = false;

        if ($this->debug()) {
            echo '<pre>[DEBUG] Making request: ' . $req . "</pre>\n";
        }

        # Write the request
        while (!$closed && $bytes_written < $bytes_total) {
            try {
                $written = fwrite($socket, substr($req, $bytes_written));
            } catch (Exception $e) {
                $this->handleError($e->getCode(), $e->getMessage());
                $closed = true;
            }
            if (!isset($written) || !$written) {
                $closed = true;
                if ($this->debug()) {
                    echo '<pre>[DEBUG] Socket was in closed state... retrying: ' . $retry . "</pre>\n";
                }
            } else {
                $bytes_written += $written;
                if ($this->debug()) {
                    echo '<pre>[DEBUG] Bytes written: ' . $written . "</pre>\n";
                }
            }
        }

        # If the socket has been closed, attempt to retry a single time.
        if ($closed) {
            fclose($socket);

            if ($retry) {
                $socket = $this->createSocket();
                if ($socket) return $this->makeRequest($socket, $req, false);
            }
            return false;
        }


        $success = true;

        if ($this->debug()) {
            $res = $this->parseResponse(fread($socket, 2048));
            echo '<pre>[DEBUG] Response: ' . print_r($res, true) . "</pre>\n";
            if ($res["status"] != "200") {
                $this->handleError($res["status"], $res["message"]);
                $success = false;
            }
        }

        fclose($socket);

        return $success;
    }

    /**
     * Parse our response from the server, check header and body.
     * @param  string $res
     * @return array
     *     string $status  HTTP code, e.g. "200"
     *     string $message JSON response from the api
     */
    private function parseResponse($res) {

        $contents = explode("\n", $res);

        # Response comes back as HTTP/1.1 200 OK
        # Final line contains HTTP response.
        $status = explode(" ", $contents[0], 3);
        $result = $contents[count($contents) - 1];

        return array(
            "status" => isset($status[1]) ? $status[1] : null,
            "message" => $result
        );
    }

    public function flushSingleSend($item, $apiKey, $sensor) {
        $socket = $this->createSocket();

        if (!$socket)
            return;

        $envelope = (new Envelope())
            ->setSensor($sensor)
            ->setData($item);

        $payload = json_encode($envelope, $this->options['jsonEncodeOptions']);

        $body = $this->createSendBody($this->options['host'], $apiKey, $payload);

        return $this->makeRequest($socket, $body);
    }

    /**
     * Create the body to send as the post request.
     * @param  string $host
     * @param  string $content
     * @return string body
     */
    private function createSendBody($host, $apiKey, $content) {

        $req = "";
        $req .= "POST " . $this->options["sendURI"] . " HTTP/1.1\r\n";
        $req .= "Host: " . $host . "\r\n";
        $req .= "Authorization: " . $apiKey . "\r\n";
        $req .= "Content-Type: application/json\r\n";
        $req .= "Accept: application/json\r\n";
        $req .= "Content-length: " . strlen($content) . "\r\n";
        $req .= "\r\n";
        $req .= $content;

        return $req;
    }
}
