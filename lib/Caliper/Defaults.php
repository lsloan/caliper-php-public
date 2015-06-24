<?php
require_once 'Caliper/util/BasicEnum.php';

class Defaults extends BasicEnum {
    const
        __default = '',
        HOST = 'http://example.org/',
        CONNECTION_REQUEST_TIMEOUT = 10000,
        CONNECTION_TIMEOUT = 10000,
        SOCKET_TIMEOUT = 10000,
        JSON_ENCODE_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        DEBUG = false;
}