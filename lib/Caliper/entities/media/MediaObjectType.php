<?php
require_once 'CaliperSensor.php';
require_once 'Caliper/entities/Type.php';
require_once 'Caliper/util/BasicEnum.php';

class MediaObjectType extends BasicEnum implements Type {
    const
        __default = '',
        AUDIO_OBJECT = 'http://purl.imsglobal.org/caliper/v1/AudioObject',
        IMAGE_OBJECT = 'http://purl.imsglobal.org/caliper/v1/ImageObject',
        VIDEO_OBJECT = 'http://purl.imsglobal.org/caliper/v1/VideoObject',
        MEDIA_LOCATION = 'http://purl.imsglobal.org/caliper/v1/MediaLocation';
}
