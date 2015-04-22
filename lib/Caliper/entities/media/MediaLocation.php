<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/Targetable.php';

class MediaLocation extends CaliperDigitalResource implements Targetable {
    private $currentTime;

    public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType('http://purl.imsglobal.org/caliper/v1/MediaLocation');
    }
    
    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */
    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'currentTime' => $this->getCurrentTime(),
        ]);
    }

    /**
     * @param int $currentTimeSeconds
     * @return $this
     */
    public function setCurrentTime($currentTimeSeconds) {
        $this->currentTime = $currentTimeSeconds;
        return $this;
    }

    /**
     * @return int Current time in seconds
     */
    public function getCurrentTime() {
        return $this->currentTime;
    }
}