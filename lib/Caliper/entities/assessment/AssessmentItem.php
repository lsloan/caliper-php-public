<?php
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResource.php';
require_once dirname(__FILE__) . '/../assignable/AssignableDigitalResourceType.php';

class AssessmentItem extends AssignableDigitalResource {
    /** @var bool */
    private $isTimeDependent;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new AssignableDigitalResourceType(AssignableDigitalResourceType::ASSESSMENT_ITEM));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'isTimeDependent' => $this->getIsTimeDependent(),
        ]);
    }

    /** @return bool isTimeDependent */
    public function getIsTimeDependent() {
        return $this->isTimeDependent;
    }

    /**
     * @param bool $isTimeDependent
     * @return $this|AssessmentItem
     */
    public function setIsTimeDependent($isTimeDependent) {
        if (!is_bool($isTimeDependent)) {
            throw new InvalidArgumentException(__METHOD__ . ': bool expected');
        }

        $this->isTimeDependent = $isTimeDependent;
        return $this;
    }
}
