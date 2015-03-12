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
   * @return boolean                   whether the measure call succeeded
   */
  public function measure($caliperEvent) {
      $this->flushSingleMeasure($caliperEvent);
      return true;
  }

  /**
   * Flushes a single describe
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleDescribe($item);

  /**
   * Flushes a single measure
   * @param  [type] $item  [description]
   * @return [type]        [description]
   */
  abstract function flushSingleMeasure($item);
}
