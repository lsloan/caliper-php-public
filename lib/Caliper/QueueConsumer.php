<?php
abstract class Caliper_QueueConsumer extends Caliper_Consumer {
    protected $type = "QueueConsumer";

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
   * @return boolean whether the track call succeeded
   */
  public function describe($caliperEntity) {
      $this->flushSingleDescribe($caliperEntity);
      return true;
  }

  /**
   * Send learning events
   * @return boolean success
   */
  public function send($caliperEvent) {
      $this->flushSingleSend($caliperEvent);
      return true;
  }

  /**
   * Flushes a single describe
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleDescribe($item);

  /**
   * Flushes a single send
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleSend($item);
}
