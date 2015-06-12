<?php
require_once 'CourseOffering.php';
require_once 'Caliper/entities/EntityType.php';

class CourseSection extends CourseOffering {
    /** @var string */
    private $category;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new EntityType(EntityType::COURSE_SECTION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'category' => $this->getCategory(),
        ]);
    }

    /** @return string category */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param string $category
     * @return $this|CourseSection
     */
    public function setCategory($category) {
        if (!is_string($category)) {
            throw new InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->category = $category;
        return $this;
    }
}
