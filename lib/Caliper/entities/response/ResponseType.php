<?php
require_once 'Caliper/entities/Type.php';
require_once 'Caliper/util/BasicEnum.php';

class ResponseType extends BasicEnum implements Type{
    const
        FILLINBLANK = 'http://purl.imsglobal.org/caliper/v1/FillinBlankResponse',
        MULTIPLECHOICE = 'http://purl.imsglobal.org/caliper/v1/MultipleChoiceResponse',
        MULTIPLERESPONSE = 'http://purl.imsglobal.org/caliper/v1/MultipleResponseResponse',
        SELECTTEXT = 'http://purl.imsglobal.org/caliper/v1/SelectTextResponse',
        TRUEFALSE = 'http://purl.imsglobal.org/caliper/v1/TrueFalseResponse';
}