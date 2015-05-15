<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Entity.php';
require_once 'Caliper/entities/foaf/Agent.php';

class Organization extends Entity implements foaf\Agent {
	/**
	 * 
	 * @param string $id
	 * @param string $parentOrg
	 */
	public function __construct($id = NULL, $parentOrg = NULL) {
		$this->id = $id;		
		$this->parentOrg = $parentOrg;
		$this->setType(EntityType::ORGANIZATION);
	}
	
	private $parentOrg;

	public function  getParentOrg() {
		return $this->parentOrg;
	}

	public function  setParentOrg($parentOrg) {
		$this->parentOrg = $parentOrg;
	}
	
	public  function jsonSerialize() {
        $serializedParent = parent::jsonSerialize();

        // This class doesn't use these properties, so unset them.
        unset($serializedParent['name']);
        unset($serializedParent['description']);

        return $serializedParent;
	}
}
