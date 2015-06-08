<?php
class TestRequests {
    public static function makeEnvelope() {
        return (new Envelope())
            ->setSensor('https://example.edu/sensor/001')
            ->setSendTime(new DateTime('2015-09-15T11:05:01.000Z'));
    }
}