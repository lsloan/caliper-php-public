<?php
require_once 'Caliper/entities/w3c/Status.php';
require_once 'util/BasicEnum.php';

class Status extends BasicEnum implements w3c\Status {
    const
        __default = '',
        ACTIVE = 'http://purl.imsglobal.org/vocab/lis/v2/status#Active',
        DELETED = 'http://purl.imsglobal.org/vocab/lis/v2/status#Deleted',
        INACTIVE = 'http://purl.imsglobal.org/vocab/lis/v2/status#Inactive';
}
