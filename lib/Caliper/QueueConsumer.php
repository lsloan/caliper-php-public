<?php
abstract class Caliper_QueueConsumer extends Caliper_Consumer {
    protected $type = 'QueueConsumer';

    /**
    * Store  apiKey and options as part of this consumer
    * @param string $apiKey
    * @param array  $options
    */
    public function __construct($apiKey, $options = array()) {
        parent::__construct($apiKey, $options);
    }

  public function __destruct() {
    # Nothing to do at this tim on destruction
  }

  /**
   * Describe an entity 
   * @return boolean true
   */
  public function describe($caliperEntity) {
      $this->flushSingleDescribe($caliperEntity, $this->apiKey, $this->options['sensorId']);
      return true;
  }

  /**
   * Send learning events
   * @return boolean true
   */
  public function send($caliperEvent) {
      $this->flushSingleSend($caliperEvent, $this->apiKey, $this->options['sensorId']);
      return true;
  }

  /**
   * Flushes a single describe
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleDescribe($item, $apiKey, $sensor);

  /**
   * Flushes a single send
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleSend($item, $apiKey, $sensor);
}
