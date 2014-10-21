<?php

/**
 * @author balachandiran.v
 *
 */
class LearningContext extends CaliperEntity {

    public $edApp;
    public $lisOrganization;
    protected $agent;

    function __construct() {
        parent::__construct();
    }

    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */

    public function jsonSerialize() {

        return ['@id' => $this->getId(),
            '@type' => $this->getType(),
            'name' => $this->getName(),
            'edApp' => $this->getEdApp(),
            'lisOrganization' => $this->getLisOrganization(),
            'agent' => $this->getAgent(),
            'lastModifiedTime' => $this->getLastModifiedAt()
        ];
    }

    /**
     * @return mixed
     */
    public function getAgent() {
        return $this->agent;
    }

    /**
     * @param mixed $agent
     */
    public function setAgent($agent) {
        $this->agent = $agent;
    }

    /**
     * @return mixed
     */
    public function getEdApp() {
        return $this->edApp;
    }

    /**
     * @param mixed $edApp
     */
    public function setEdApp($edApp) {
        $this->edApp = $edApp;
    }

    /**
     * @return mixed
     */
    public function getLisOrganization() {
        return $this->lisOrganization;
    }

    /**
     * @param mixed $lisOrganization
     */
    public function setLisOrganization($lisOrganization) {
        $this->lisOrganization = $lisOrganization;
    }
}