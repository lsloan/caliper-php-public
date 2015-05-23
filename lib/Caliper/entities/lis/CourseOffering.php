<?php
require_once 'Caliper/entities/lis/Course.php';
require_once 'Caliper/entities/EntityType.php';

class CourseOffering extends Entity implements Course {
    /** @var string */
    private $courseNumber;
    /** @var string */
    private $academicSession;
    /** @var Organization */
    private $subOrganizationOf;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(EntityType::COURSE_OFFERING);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'courseNumber' => $this->getCourseNumber(),
            'academicSession' => $this->getAcademicSession(),
            'subOrganizationOf' => $this->getSubOrganizationOf(),
        ]);
    }

    /** @return string courseNumber */
    public function getCourseNumber() {
        return $this->courseNumber;
    }

    /**
     * @param string $courseNumber
     * @return $this|CourseOffering
     */
    public function setCourseNumber($courseNumber) {
        $this->courseNumber = $courseNumber;
        return $this;
    }

    /** @return string academicSession */
    public function getAcademicSession() {
        return $this->academicSession;
    }

    /**
     * @param string $academicSession
     * @return $this|CourseOffering
     */
    public function setAcademicSession($academicSession) {
        $this->academicSession = $academicSession;
        return $this;
    }

    /** @return Organization subOrganizationOf */
    public function getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param Organization $subOrganizationOf
     * @return $this|CourseOffering
     */
    public function setSubOrganizationOf($subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }
}
