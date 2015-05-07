<?php
require_once 'util/BasicEnum.php';

class CaliperEntityTypes extends BasicEnum {
    const
        __default = '',
        ACTIVITY_CONTEXT = 'http://purl.imsglobal.org/caliper/v1/ActivityContext',
        ATTEMPT = 'http://purl.imsglobal.org/caliper/v1/Attempt',
        CALIPER_AGENT = 'http://purl.imsglobal.org/caliper/v1/CaliperAgent',
        CALIPER_DIGITAL_RESOURCE = 'http://purl.imsglobal.org/caliper/v1/CaliperDigitalResource',
        CALIPER_ENTITY = 'http://purl.imsglobal.org/caliper/v1/CaliperEntity',
        FRAME = 'http://purl.imsglobal.org/caliper/v1/Frame',
        LEARNING_OBJECTIVE = 'http://purl.imsglobal.org/caliper/v1/LearningObjective',
        MEDIA_LOCATION = 'http://purl.imsglobal.org/caliper/v1/MediaLocation',
        RESULT = 'http://purl.imsglobal.org/caliper/v1/Result';
}

