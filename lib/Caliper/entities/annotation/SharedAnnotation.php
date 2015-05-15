<?php
require_once 'Annotation.php';
require_once 'AnnotationType.php';

class SharedAnnotation extends Annotation implements JsonSerializable {

    // TODO - this should be a list of LISGroup or Person/s
    public $withAgents = array();

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(AnnotationType::SHARED_ANNOTATION);
    }

    /**
     * @param users
     *            the users to set
     */
    public function setUsers($users) {
        $this->withAgents = $users;
        return $this;
    }

    public function jsonSerialize() {
        return [
            '@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getDateModified(),
            'properties' => (object) $this->getExtensions(),
            'target' => $this->getTarget(),
            'users' => $this->getUsers(),
        ];
    }

    /**
     * @return the users
     */
    public function getUsers() {
        return $this->withAgents;
    }

}
