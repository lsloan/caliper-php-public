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
        ABANDONED = "assignable.abandoned",
        ACTIVATED = "assignable.activated",
        COMPLETED = "assignable.completed",
        DEACTIVATED = "assignable.deactivated",
        HID = "assignable.hid",
        REVIEWED = "assignable.reviewed",
        SHOWED = "assignable.showed",
        STARTED = "assignable.started",
        SUBMITTED = "assignable.submitted",

        NAVIGATED_TO = "navigation.navigatedTo",
        VIEWED = "navigation.viewed";
}

