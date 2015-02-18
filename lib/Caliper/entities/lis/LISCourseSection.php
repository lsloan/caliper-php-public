<?php
require_once 'CaliperSensor.php';
require_once 'LISOrganization.php';

class LISCourseSection extends LISOrganization {

	private $label;
	private $courseNumber;
	private $semester; // TODO - check agains LIS LISOrganization

	
	/**
	 * @param id
	 * @param parentOrg	
	 */
	public function __construct($id = NULL, $parentOrg = NULL) {
		parent::__construct($id, $parentOrg);
		$this->setType('http://purl.imsglobal.org/caliper/v1/lis/CourseSection');
	}
	
	/**
	 * @return the label
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param label
	 *            the label to set
	 */
	public function setLabel($label) {
		$this->label = $label;
	}

	/**
	 * @return the courseNumber
	 */
	public function getCourseNumber() {
		return $this->courseNumber;
	}

	/**
	 * @param courseNumber
	 *            the courseNumber to set
	 */
	public function setCourseNumber($courseNumber) {
		$this->courseNumber = $courseNumber;
	}

	/**
	 * @return the semester
	 */
	public function getSemester() {
		return $this->semester;
	}

	/**
	 * @param semester
	 *            the semester to set
	 */
	public function setSemester($semester) {
		$this->semester = $semester;
	}
	
	public function jsonSerialize(){
		return [
			'@id'=>$this->getId(),
			'@type'=>$this->getType(),
			'semester'=>$this->getSemester(),
			'courseNumber' => $this->getCourseNumber(),
			'label'=>$this->getLabel(),
			'name'=>$this->getName(),
			'description' => $this->getDescription(),
			'parentOrg'=>$this->getParentOrg(),
			'properties' => (object) $this->getProperties(),
			'dateCreated' => $this->getDateCreated(),
			'dateModified' => $this->getDateModified(),
		];
	}
}

