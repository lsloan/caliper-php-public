<?php
abstract class Consumer {
    protected $type = 'Consumer';
    protected $options;
    protected $apiKey;

    /**
     * @param string $apiKey
     * @param mixed[] $options
     */
    public function __construct($apiKey, $options = []) {
        $this->apiKey = $apiKey;
        $this->options = $options;
    }

    /**
     * Send events
     * @param Event $event
     * @return bool success
     */
    abstract public function send(Event $event);

    /**
     * Describe entities
     * @param Entity $entity
     * @return bool success
     */
    abstract public function describe(Entity $entity);

    /**
     * On an error, try and call the error handler, if debugging output to
     * error_log as well.
     * @param  string $code
     * @param  string $msg
     */
    protected function handleError($code, $msg) {

        if (isset($this->options['error_handler'])) {
            $handler = $this->options['error_handler'];
            $handler($code, $msg);
        }

        if ($this->debug()) {
            error_log('[Caliper][' . $this->type . '] ' . $msg);
        }
    }

    /**
     * Check whether debug mode is enabled
     * @return boolean
     */
    protected function debug() {
        return isset($this->options['debug']) ? $this->options['debug'] : false;
    }
}
