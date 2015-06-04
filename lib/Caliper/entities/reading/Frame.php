<?php
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';

class Frame extends DigitalResource implements Targetable {
    /** @var int */
    private $index;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new DigitalResourceType(DigitalResourceType::FRAME));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'index' => $this->getIndex(),
        ]);
    }

    /** @return int index */
    public function getIndex() {
        return $this->index;
    }

    /**
     * @param int $index
     * @return $this|Frame
     */
    public function setIndex($index) {
        if (!is_int($index)) {
            throw new InvalidArgumentException(__METHOD__ . ': int expected');
        }

        $this->index = $index;
        return $this;
    }
}
