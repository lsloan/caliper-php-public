<?php
require_once 'Caliper/entities/lis/CourseOffering.php';
require_once 'Caliper/entities/lis/CourseSection.php';
require_once 'Caliper/entities/lis/Group.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/lis/Role.php';
require_once 'Caliper/entities/lis/Status.php';

class TestLisEntities {
    public static function groupId() {
        return 'https://example.edu/politicalScience/2015/american-revolution-101/section/001/group/001';
    }

    public static function makeGroup() {
        return (new Group(TestLisEntities::groupId()))
            ->setName('Discussion Group 001')
            ->setSubOrganizationOf(TestLisEntities::makeCourseSection())
            ->setDateCreated(TestTimes::createdTime());
    }

    public static function makeGroupMembership() {
        return (new Membership('https://example.edu/membership/003'))
            ->setMember(TestAgentEntities::makePerson())
            ->setOrganization(TestLisEntities::groupId())
            ->setRoles(TestLisEntities::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());
    }

    public static function makeCourseSection() {
        return (new CourseSection(TestLisEntities::courseSectionId()))
            ->setCourseNumber('POL101')
            ->setName('American Revolution 101')
            ->setAcademicSession('Fall-2015')
            ->setSubOrganizationOf(TestLisEntities::makeCourseOffering())
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    public static function courseSectionId() {
        return 'https://example.edu/politicalScience/2015/american-revolution-101/section/001';
    }

    public static function makeSectionMembership() {
        return (new Membership('https://example.edu/membership/002'))
            ->setMember(TestAgentEntities::makePerson())
            ->setOrganization(TestLisEntities::courseSectionId())
            ->setRoles(TestLisEntities::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());

    }

    public static function makeMembership() {
        return (new Membership('https://example.edu/politicalScience/2015/american-revolution-101/roster/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDescription('Roster entry')
            ->setMember(TestAgentEntities::makePerson())
            ->setName('American Revolution 101')
            ->setOrganization(new Group('https://example.edu/politicalScience/2015/american-revolution-101/section/001'))
            ->setRoles(new Role(Role::LEARNER))
            ->setStatus(new Status(Status::ACTIVE));
    }

    public static function makeCourseOffering() {
        return (new CourseOffering('https://example.edu/politicalScience/2015/american-revolution-101'))
            ->setCourseNumber('POL101')
            ->setName('Political Science 101: The American Revolution')
            ->setAcademicSession('Fall-2015')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }
}