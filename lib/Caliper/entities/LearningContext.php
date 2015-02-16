<?php
class LearningContext {
    public $edApp;
    public $lisOrganization;
    protected $agent;

    public function jsonSerialize() {
        return [
            'edApp' => $this->getEdApp(),
            'lisOrganization' => $this->getLisOrganization(),
            'agent' => $this->getAgent(),
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
