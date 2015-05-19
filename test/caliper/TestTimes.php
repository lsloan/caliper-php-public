<?php

class TestTimes {
    public static function createdTime() {
        return new DateTime('2015-08-01T06:00:00.000Z');
    }

    public static function modifiedTime() {
        return new DateTime('2015-09-02T11:30:00.000Z');
    }

    public static function navigationStartTime() {
        return new DateTime('2015-09-15T10:15:00.000Z');
    }

    public static function sendTime() {
        return new DateTime('2015-09-15T11:05:01.000Z');
    }
}