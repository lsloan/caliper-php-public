<?php
require_once 'Caliper/entities/lis/Course.php';
require_once 'Caliper/entities/EntityType.php';

class CourseOffering extends Entity implements Course {
    /** @var string */
    private $courseNumber;
    /** @var string */
    private $academicSession;
    /** @var \w3c\Organization */
    private $subOrganizationOf;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::COURSE_OFFERING));
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
        if (!is_string($courseNumber)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

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
        if (!is_string($academicSession)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->academicSession = $academicSession;
        return $this;
    }

    /** @return \w3c\Organization subOrganizationOf */
    public function getSubOrganizationOf() {
        return $this->subOrganizationOf;
    }

    /**
     * @param \w3c\Organization $subOrganizationOf
     * @return $this|CourseOffering
     */
    public function setSubOrganizationOf(\w3c\Organization $subOrganizationOf) {
        $this->subOrganizationOf = $subOrganizationOf;
        return $this;
    }
}
