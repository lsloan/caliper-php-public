<?php
require_once 'util/BasicEnum.php';

class MediaActions extends \BasicEnum {
    const
        __default = '',
        ENABLEDCLOSECAPTIONING = 'http://purl.imsglobal.org/vocab/caliper/v1/action#EnabledCloseCaptioning',
        DISABLEDCLOSEDCAPTIONING = 'http://purl.imsglobal.org/vocab/caliper/v1/action#DisabledCloseCaptioning',

        CHANGEDVOLUME = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ChangedVolume',
        MUTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Muted',
        UNMUTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Unmuted',

        CHANGEDSPEED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ChangedSpeed',
        ENDED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Ended',
        JUMPEDTO = 'http://purl.imsglobal.org/vocab/caliper/v1/action#JumpedTo',
        FORWARDEDTO = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ForwardedTo',
        PAUSED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Paused',
        RESUMED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Resumed',
        REWINDED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#RewindedTo',
        STARTED = 'http://purl.imsglobal.org/vocab/caliper/v1/action#Started',

        CHANGEDRESOLUTION = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ChangedResolution',
        CHANGEDVIEWERSIZE = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ChangedViewerSize',
        CLOSEDPOPOUT = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ClosedPopout',
        ENTEREDFULLSCREEN = 'http://purl.imsglobal.org/vocab/caliper/v1/action#EnteredFullScreen',
        EXITEDFULLSCREEN = 'http://purl.imsglobal.org/vocab/caliper/v1/action#ExitedFullScreen',
        OPENEDPOPOUT = 'http://purl.imsglobal.org/vocab/caliper/v1/action#OpenedPopout';
}
