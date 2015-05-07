<?php
require_once 'util/BasicEnum.php';

class CaliperEventContexts extends \BasicEnum {

    const
        __default = "",
        ANNOTATION = "http://purl.imsglobal.org/ctx/caliper/v1/AnnotationEvent",
        ASSESSMENT = "http://purl.imsglobal.org/ctx/caliper/v1/AssessmentEvent",
        ASSESSMENT_ITEM = "http://purl.imsglobal.org/ctx/caliper/v1/AssessmentItemEvent",
        ASSIGNABLE = "http://purl.imsglobal.org/ctx/caliper/v1/AssignableEvent",
        CALIPER_EVENT = "http://purl.imsglobal.org/ctx/caliper/v1/CaliperEvent",
        MEDIA = "http://purl.imsglobal.org/ctx/caliper/v1/MediaEvent",
        NAVIGATION = "http://purl.imsglobal.org/ctx/caliper/v1/NavigationEvent",
        OUTCOME = "http://purl.imsglobal.org/ctx/caliper/v1/OutcomeEvent",
        SESSION = "http://purl.imsglobal.org/ctx/caliper/v1/SessionEvent",
        VIEWED = "http://purl.imsglobal.org/ctx/caliper/v1/ViewedEvent";
}

