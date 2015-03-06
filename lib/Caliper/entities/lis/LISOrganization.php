<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/CaliperEntity.php';
require_once 'Caliper/entities/foaf/Agent.php';

class LISOrganization extends CaliperEntity implements Agent {
	/**
	 * 
	 * @param string $id
	 * @param string $parentOrg
	 */
	public function __construct($id = NULL, $parentOrg = NULL) {
		$this->id = $id;		
		$this->parentOrg = $parentOrg;
		$this->setType('http://purl.imsglobal.org/caliper/v1/LISOrganization');
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
