<?php
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/entities/DigitalResourceType.php';

class Frame extends DigitalResource implements Targetable {
    private $index;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(DigitalResourceType::FRAME);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'index' => $this->getIndex(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getIndex() {
        return $this->index;
    }

    /**
     * @param mixed $index
     * @return object
     */
    public function setIndex($index) {
        $this->index = $index;
        return $this;
    }
}
