<?php
/**
 *
 */

require_once (dirname(dirname(__FILE__)).'/CaliperEntity.php');



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
	
	public  function jsonSerialize()
	{
		$parentProperties =parent::jsonSerialize();
		$lisorganizationProperties =['title'=>$this->getTitle()];
		 return array_merge($parentProperties,$lisorganizationProperties);
	}
}
