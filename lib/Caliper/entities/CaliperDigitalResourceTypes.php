<?php
require_once 'util/BasicEnum.php';

class CaliperDigitalResourceTypes extends BasicEnum {
    const
        __default = '',
        CALIPER_ASSIGNABLE_DIGITAL_RESOURCE = 'http://purl.imsglobal.org/caliper/v1/CaliperAssignableDigitalResource',
        CALIPER_MEDIA_OBJECT = 'http://purl.imsglobal.org/caliper/v1/CaliperMediaObject',
        EPUB_CHAPTER = 'http://www.idpf.org/epub/vocab/structure/#chapter',
        EPUB_PART = 'http://www.idpf.org/epub/vocab/structure/#part',
        EPUB_SUB_CHAPTER = 'http://www.idpf.org/epub/vocab/structure/#subchapter',
        EPUB_VOLUME = 'http://www.idpf.org/epub/vocab/structure/#volume',
        WEB_PAGE = 'http://purl.imsglobal.org/caliper/v1/WebPage';
}

