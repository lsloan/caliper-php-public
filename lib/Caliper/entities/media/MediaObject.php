<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/MediaObject.php';

abstract class MediaObject extends DigitalResource implements schemadotorg\MediaObject {
    /** @var int (seconds) */
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->getDuration(),
        ]);
    }

    /** @return int duration (seconds) */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $duration (seconds)
     * @return $this|MediaObject
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }
}