<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/events/CaliperEventContexts.php';
require_once 'Caliper/events/CaliperEventTypes.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/actions/Action.php';

class NavigationEvent extends CaliperEvent {

    /**
     * Describes the resource from which the navigation starts
     */
    private $navigatedFrom;

    public function __construct() {
        parent::__construct();

        $this->setContext(CaliperEventContexts::NAVIGATION);
        $this->setType(CaliperEventTypes::NAVIGATION);
        $this->setAction(Action::NAVIGATED_TO);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'navigatedFrom' => $this->getNavigatedFrom(),
        ]);
    }

    /**
     * @return the navigatedFrom
     */
    public function getNavigatedFrom() {
        return $this->navigatedFrom;
    }

    /**
     * @param $navigatedFrom
     * the navigatedFrom to set
     */
    public function setNavigatedFrom($navigatedFrom) {
        $this->navigatedFrom = $navigatedFrom;
        return $this;
    }

    /**
     * @return the fromResource
     * @deprecated
     */
    public function getFromResource() {
        return $this->getNavigatedFrom();
    }

    /**
     * @param fromResource
     * the fromResource to set
     * @deprecated
     */
    public function setFromResource($fromResource) {
        return $this->setNavigatedFrom($fromResource);
    }

}
