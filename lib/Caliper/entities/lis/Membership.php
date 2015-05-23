<?php
require_once 'Caliper/entities/w3c/Membership.php';
require_once 'Caliper/entities/EntityType.php';
require_once 'Caliper/entities/lis/Status.php';

class Membership extends Entity implements w3c\Membership {
    /** @var Person */
    private $member;
    /** @var Organization */
    private $organization;
    /** @var \w3c\Role[] */
    private $roles = [];
    /** @var \w3c\Status */
    private $status;

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

    /** @return Person member */
    public function getMember() {
        return $this->member;
    }

    /**
     * @param Person $member
     * @return $this|Membership
     */
    public function setMember($member) {
        $this->member = $member;
        return $this;
    }

    /** @return Organization organization */
    public function getOrganization() {
        return $this->organization;
    }

    /**
     * @param Organization $organization
     * @return $this|Membership
     */
    public function setOrganization($organization) {
        $this->organization = $organization;
        return $this;
    }

    /** @return \w3c\Role[] roles */
    public function getRoles() {
        return $this->roles;
    }

    /**
     * @param \w3c\Role[] $roles
     * @return $this|Membership
     */
    public function setRoles($roles) {
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $this->roles = $roles;
        return $this;
    }

    /** @return \w3c\Status status */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param \w3c\Status $status
     * @return $this|Membership
     */
    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
}
