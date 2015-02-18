<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/events/CaliperEvent.php';
require_once 'Caliper/events/CaliperEventContexts.php';
require_once 'Caliper/events/CaliperEventTypes.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/actions/ReadingActions.php';

class NavigationEvent extends CaliperEvent {

	public function __construct() {
		parent::__construct();

		$this->setContext(CaliperEventContexts::NAVIGATION);
		$this->setType(CaliperEventTypes::NAVIGATION);
		$this->setAction(ReadingActions::NAVIGATED_TO);
	}

	/**
	 * Describes the resource from which the navigation starts
	 */	
	private $fromResource;

	/**
	 * @return the fromResource
	 */
	public function getFromResource() {
		return $this->fromResource;
	}

	/**
	 * @param fromResource
	 * the fromResource to set
	 */
	public function setFromResource($fromResource) {
		$this->fromResource = $fromResource;
	}

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'navigatedFrom' => $this->getFromResource(),
        ]);
    }

}
