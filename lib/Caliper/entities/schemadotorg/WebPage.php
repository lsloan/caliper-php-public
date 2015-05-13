<?php
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'CreativeWork.php';

class WebPage extends CaliperDigitalResource implements CreativeWork {
    private $version;

    public function  __construct($id) {
        parent::__construct();
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/WebPage');
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'version' => $this->getVersion(),
        ]);
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
