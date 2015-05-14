<?php
require_once 'util/BasicEnum.php';

class AnnotationType extends BasicEnum {
    const
        __default = '',
        BOOKMARK_ANNOTATION = 'http://purl.imsglobal.org/caliper/v1/BookmarkAnnotation',
        HIGHLIGHT_ANNOTATION = 'http://purl.imsglobal.org/caliper/v1/HighlightAnnotation',
        SHARED_ANNOTATION = 'http://purl.imsglobal.org/caliper/v1/SharedAnnotation',
        TAG_ANNOTATION = 'http://purl.imsglobal.org/caliper/v1/TagAnnotation';
}

