<?php
namespace w3c {
    use foaf\Agent;

    require_once 'Caliper/entities/foaf/Agent.php';
    require_once 'Caliper/entities/w3c/Organization.php';
    require_once 'Caliper/entities/w3c/Role.php';
    require_once 'Caliper/entities/w3c/Status.php';

    interface Membership {
        /** @return Agent */
        function getMember();

        /** @return Organization */
        function getOrganization();

        /** @return Role[] */
        function getRoles();

        /** @return Status */
        function getStatus();
    }
}