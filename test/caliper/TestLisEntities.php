<?php
require_once 'Caliper/entities/lis/CourseOffering.php';
require_once 'Caliper/entities/lis/Membership.php';
require_once 'Caliper/entities/lis/Role.php';

class TestLisEntities {
    public static function makeCourseOffering() {
        return (new CourseOffering('https://some-university.edu/politicalScience/2015/american-revolution-101'))
            ->setCourseNumber('POL101')
            ->setName('Political Science 101: The American Revolution')
            ->setAcademicSession('Fall-2015')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    public static function makeMembership() {
        return (new Membership('https://some-university.edu/politicalScience/2015/american-revolution-101/roster/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDescription('Roster entry')
            ->setMember(TestAgentEntities::makePerson()->getId())
            ->setName('American Revolution 101')
            ->setOrganization('https://some-university.edu/politicalScience/2015/american-revolution-101/section/001')
            ->setRoles(Role::LEARNER);
    }
}