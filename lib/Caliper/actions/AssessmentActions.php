<?php

/**
 * Created by PhpStorm.
 * User: pnayak
 * Date: 10/21/14
 * Time: 1:28 PM
 */
class AnnotationActions extends SplEnum {

    const
        __default = "",
        STARTED = "assessment.started",
        PAUSED = "assessment.paused",
        RESTARTED = "assessment.restarted",
        SUBMITTED = "assessment.submitted",

        NAVIGATED_TO = "navigation.navigatedTo",
        VIEWED = "navigation.viewed";
}

