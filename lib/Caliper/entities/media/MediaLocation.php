<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/Targetable.php';

class MediaLocation extends CaliperDigitalResource implements Targetable {
    private $currentTime;
    private $version;

    public function __construct($id) {
        parent::__construct();
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/MediaLocation');
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'currentTime' => $this->getCurrentTime(),
            'version' => $this->getVersion(),
        ]);
    }

    /**
     * @return int Current time in seconds
     */
    public function getCurrentTime() {
        return $this->currentTime;
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
     * @return mixed
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }
}