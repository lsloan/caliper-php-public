<?php
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'Caliper/entities/CaliperEntity.php';

class LISOrganization extends CaliperEntity implements JsonSerializable{
	/**
	 * 
	 * @param string $id
	 * @param string $parentOrg
	 */
	public function __construct($id=NULL,$parentOrg=NULL){
		$this->id=$id;		
		$this->parentOrg = $parentOrg;
		$this->setType("http://purl.imsglobal.org/caliper/v1/LISOrganization");
	}
	
	private $title;
	private $parentOrg;

	/**
	 * @return the title
	 */
	public function  getTitle() {
		return $this->title;
	}

	/**
	 * @param title
	 *            the title to set
	 */
	public function  setTitle($title) {
		$this->title = $title;
	}
	
	public function  getParentOrg() {
		return $this->parentOrg;
	}

	public function  setParentOrg($parentOrg) {
		$this->parentOrg = $parentOrg;
	}
	
	public  function jsonSerialize()
	{
		return ['@id'=>$this->getId(),
				'@type'=>$this->getType(),
				'lastModifiedTime'=>$this->getLastModifiedAt(),
				'properties'=>(object) $this->getProperties(),
				'title'=>$this->getTitle()
				];
	
	}
}
