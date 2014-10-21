<?php
require_once (dirname(dirname(__FILE__)).'/CaliperEvent.php');
require_once (dirname(dirname(dirname(__FILE__))).'/entities/CaliperDigitalResource.php');
require_once (dirname(dirname(dirname(__FILE__))).'/actions/ReadingActions.php');


/**
 *@author balachandiran.v
 *
 */
class NavigationEvent extends CaliperEvent implements JsonSerializable {

	
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
	
	/**
	 * 
	 * @see CaliperEvent::jsonSerialize()
	 * to implement jsonLD
	 */
	public function jsonSerialize(){
		return ['@context'=>$this->getContext(),
				'@type'=>$this->getType(),
				'actor'=>$this->getActor(),
				'action'=>$this->getAction(),
				'object'=>$this->getObject(),
				'target'=>$this->getTarget(),
				'startedAtTime'=>$this->getStartedAt(),
				'endedAtTime'=>$this->getEndedAt(),
                'duration' => $this->getDuration(),
				'edApp'=>$this->getEdApp(),
				'group'=>$this->getLisOrganization(),
				'navigatedFrom'=>$this->getFromResource(),
			  ];
	}
}




