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
        ENABLEDCLOSECAPTIONING = "media.accessibility.enabledCloseCaptioning",
        DISABLEDCLOSEDCAPTIONING = "media.accessibility.disabledCloseCaptioning",

        CHANGEDVOLUME = "media.audio.changedVolume",
        MUTED = "media.audio.muted",
        UNMUTED = "media.audio.unmuted",

        CHANGEDSPEED = "media.playback.changedSpeed",
        ENDED = "media.playback.ended",
        JUMPEDTO = "media.playback.jumpedTo",
        FORWARDEDTO = "media.playback.forwardedTo",
        PAUSED = "media.playback.paused",
        RESUMED = "media.playback.resumed",
        REWINDED = "media.playback.rewindedTo",
        STARTED = "media.playback.started",

        CHANGEDRESOLUTION = "media.viewer.changedResolution",
        CHANGEDVIEWERSIZE = "media.viewer.changedViewerSize",
        CLOSEDPOPOUT = "media.viewer.closedPopout",
        ENTEREDFULLSCREEN = "media.viewer.enteredFullScreen",
        EXITEDFULLSCREEN = "media.viewer.exitedFullScreen",
        OPENEDPOPOUT = "media.viewer.openedPopout",

        NAVIGATED_TO = "navigation.navigatedTo",
        VIEWED = "navigation.viewed";
}

