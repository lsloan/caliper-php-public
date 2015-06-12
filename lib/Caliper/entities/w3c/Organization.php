<?php
namespace w3c {
    interface Organization {
        /** @return string */
        function getId();

        /** @return Organization */
        function getSubOrganizationOf();
    }
}