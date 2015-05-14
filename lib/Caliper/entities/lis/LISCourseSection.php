<?php
require_once 'CaliperSensor.php';
require_once 'CourseOffering.php';

class LISCourseSection extends CourseOffering {
    private $category;
    private $academicSession;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/lis/CourseSection');
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'academicSession' => $this->getAcademicSession(),
            'category' => $this->getCategory(),
        ]);
    }

    /**
     * @return string the academicSession
     */
    public function getAcademicSession() {
        return $this->academicSession;
    }

    /**
     * @param academicSession string
     *            the academicSession to set
     */
    public function setAcademicSession($academicSession) {
        $this->academicSession = $academicSession;
        return $this;
    }

    /**
     * @return string the category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param category string
     *            the category to set
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

}

