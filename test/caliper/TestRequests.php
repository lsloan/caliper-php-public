<?php
class TestRequests {
    public static function makeEnvelope() {
        return (new Envelope())
            ->setSensor('http://learning-app.some-university.edu/sensor')
            ->setSendTime(new DateTime('2015-09-15T11:05:01.000Z'));
    }
}