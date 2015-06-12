<?php
namespace foaf {
    require_once 'Caliper/entities/Type.php';

    /**
     *         From http://xmlns.com/foaf/spec/#term_Agent An agent (eg. person,
     *         group, software or physical artifact)
     */
    interface Agent {
        /** @return string */
        function getId();

        /** @return \Type */
        function getType();
    }
}