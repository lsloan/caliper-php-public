<?php

/**
 * Created by PhpStorm.
 * User: pnayak
 * Date: 10/21/14
 * Time: 1:28 PM
 */
class CaliperEventTypes extends SplEnum {

    const
        __default = "",
        ANNOTATION = "http://purl.imsglobal.org/caliper/v1/AnnotationEvent",
        ASSESSMENT = "http://purl.imsglobal.org/caliper/v1/AssessmentEvent",
        ASSESSMENT_ITEM = "http://purl.imsglobal.org/caliper/v1/AssessmentItemEvent",
        ASSIGNABLE = "http://purl.imsglobal.org/caliper/v1/AssignableEvent",
        CALIPER_EVENT = "http://purl.imsglobal.org/caliper/v1/CaliperEvent",
        MEDIA = "http://purl.imsglobal.org/caliper/v1/MediaEvent",
        NAVIGATION = "http://purl.imsglobal.org/caliper/v1/NavigationEvent",
        OUTCOME = "http://purl.imsglobal.org/caliper/v1/OutcomeEvent",
        VIEWED = "http://purl.imsglobal.org/caliper/v1/ViewedEvent";
}

