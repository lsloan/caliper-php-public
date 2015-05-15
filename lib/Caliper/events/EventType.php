<?php
require_once 'util/BasicEnum.php';

class EventType extends \BasicEnum {

    const
        __default = "",
        ANNOTATION = "http://purl.imsglobal.org/caliper/v1/AnnotationEvent",
        ASSESSMENT = "http://purl.imsglobal.org/caliper/v1/AssessmentEvent",
        ASSESSMENT_ITEM = "http://purl.imsglobal.org/caliper/v1/AssessmentItemEvent",
        ASSIGNABLE = "http://purl.imsglobal.org/caliper/v1/AssignableEvent",
        EVENT = "http://purl.imsglobal.org/caliper/v1/Event",
        MEDIA = "http://purl.imsglobal.org/caliper/v1/MediaEvent",
        NAVIGATION = "http://purl.imsglobal.org/caliper/v1/NavigationEvent",
        OUTCOME = "http://purl.imsglobal.org/caliper/v1/OutcomeEvent",
        SESSION = "http://purl.imsglobal.org/caliper/v1/SessionEvent",
        VIEW = "http://purl.imsglobal.org/caliper/v1/ViewEvent";
}

