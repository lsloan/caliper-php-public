<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/schemadotorg/MediaObject.php';

class MediaObject extends CaliperDigitalResource implements schemadotorg\MediaObject {
    private $duration;

    public function __construct() {
        parent::__construct();
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->getDuration(),
        ]);
    }

    /**
     * @return int Duration in seconds
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $durationSeconds
     * @return $this
     */
    public function setDuration($durationSeconds) {
        $this->duration = $durationSeconds;
        return $this;
    }
}