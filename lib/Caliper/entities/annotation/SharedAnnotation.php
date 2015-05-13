<?php
require_once 'Annotation.php';

class SharedAnnotation extends Annotation implements JsonSerializable {

    // TODO - this should be a list of LISGroup or LISPerson/s
    public $withAgents = array();

    public function __construct($id) {
        parent::__construct($id);
        $this->setType('http://purl.imsglobal.org/caliper/v1/SharedAnnotation');
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
