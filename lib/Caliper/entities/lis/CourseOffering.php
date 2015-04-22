<?php
require_once 'Caliper/entities/lis/Course.php';

class CourseOffering extends CaliperEntity implements Course {
    private $courseNumber;
    private $academicSession;
    private $membership = [];
    private $subOrganizationOf;

    public function __construct($id){
        parent::__construct();
        $this->setId($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/lis/CourseOffering');
    }

    public function jsonSerialize(){
        return array_merge(parent::jsonSerialize(), [
            'courseNumber' => $this->getCourseNumber(),
            'academicSession' => $this->getAcademicSession(),
            'membership' => $this->getMembership(),
            'subOrganizationOf' => $this->getSubOrganizationOf(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getCourseNumber() {
        return $this->courseNumber;
    }

    /**
     * @param mixed $courseNumber
     */
    public function setCourseNumber($courseNumber) {
        $this->courseNumber = $courseNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAcademicSession() {
        return $this->academicSession;
    }

    /**
     * @param mixed $academicSession
     */
    public function setAcademicSession($academicSession) {
        $this->academicSession = $academicSession;
        return $this;
    }

    /**
     * @return array
     */
    public function getMembership() {
        return $this->membership;
    }

    /**
     * @param array $membership
     */
    public function setMembership($membership) {
        $this->membership = $membership;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param mixed $subOrganizationOf
     */
    public function setSubOrganizationOf($subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }
}