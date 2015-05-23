<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/Event.php';
require_once 'Caliper/events/EventContext.php';
require_once 'Caliper/events/EventType.php';
require_once 'Caliper/entities/DigitalResource.php';
require_once 'Caliper/actions/Action.php';

class NavigationEvent extends Event {
    /** @var DigitalResource */
    private $navigatedFrom;

    public function __construct() {
        parent::__construct();

        $this->setContext(EventContext::NAVIGATION);
        $this->setType(EventType::NAVIGATION);
        $this->setAction(Action::NAVIGATED_TO);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'navigatedFrom' => $this->getNavigatedFrom(),
        ]);
    }

    /** @return DigitalResource navigatedFrom */
    public function getNavigatedFrom() {
        return $this->navigatedFrom;
    }

    /**
     * @param DigitalResource $navigatedFrom
     * @return $this|NavigationEvent
     */
    public function setNavigatedFrom($navigatedFrom) {
        $this->navigatedFrom = $navigatedFrom;
        return $this;
    }

    /**
     * @deprecated
     * @return DigitalResource navigatedFrom
     */
    public function getFromResource() {
        return $this->getNavigatedFrom();
    }

    /**
     * @deprecated
     * @param DigitalResource $fromResource
     * @return $this|NavigationEvent
     */
    public function setFromResource($fromResource) {
        return $this->setNavigatedFrom($fromResource);
    }
}

