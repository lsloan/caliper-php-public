<?php
require_once 'util/BasicEnum.php';

class CaliperAgentTypes extends BasicEnum {
    const
        __default = '',
        LIS_PERSON = 'http://purl.imsglobal.org/caliper/v1/lis/Person',
        LIS_ORGANIZATION = 'http://purl.imsglobal.org/caliper/v1/LISOrganization',
        SOFTWARE_APPLICATION = 'http://purl.imsglobal.org/caliper/v1/SoftwareApplication';
}

