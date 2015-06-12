<?php
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/schemadotorg/MediaObject.php';

abstract class MediaObject extends DigitalResource implements schemadotorg\MediaObject {
    /** @var long (seconds) */
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->getDuration(),
        ]);
    }

    /** @return long duration (seconds) */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param long $duration (seconds)
     * @return $this|MediaObject
     */
    public function setDuration($duration) {
        if (!is_long($duration)) {
            throw new InvalidArgumentException(__METHOD__ . ': long expected');
        }

        $this->duration = $duration;
        return $this;
    }
}