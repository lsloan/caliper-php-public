<?php
require_once 'Caliper/entities/w3c/Membership.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/lis/Status.php';

class Membership extends Entity implements w3c\Membership {
    private $member;
    private $organization;
    private $roles = [];
    private $status = Status::ACTIVE;

    public function __construct($id) {
        $this->setId($id);
        $this->setType(EntityType::MEMBERSHIP);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'member' => $this->getMember(),
            'organization' => $this->getOrganization(),
            'roles' => $this->getRoles(),
            'status' => $this->getStatus(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getMember() {
        return $this->member;
    }

    /**
     * @param mixed $member
     */
    public function setMember($member) {
        $this->member = $member;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganization() {
        return $this->organization;
    }

    /**
     * @param mixed $organization
     */
    public function setOrganization($organization) {
        $this->organization = $organization;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles) {
        if (! is_array($roles)) {
            $roles = [$roles];
        }

        $this->roles = $roles;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
}
