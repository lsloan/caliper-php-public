<?php
/**
 *
 */
require_once 'Annotation.php';





/**
 *
 *
 */
class SharedAnnotation extends Annotation {

	// TODO - this should be a list of LISGroup or LISPerson/s
    public 	$withAgents =array();

	public function __construct($id){
		parent::__construct($id);
		$this->setType("http://purl.imsglobal.org/caliper/v1/SharedAnnotation");
	}

	/**
	 * @return the users
	 */
	public function  getUsers() {
		return $this->withAgents;
	}

	/**
	 * @param users
	 *            the users to set
	 */
	public function  setUsers($users) {
		$this->withAgents = $users;
	}
}
