<?php
require_once 'Caliper/entities/media/MediaLocation.php';
require_once 'Caliper/entities/media/VideoObject.php';

class TestMediaEntities {
    public static function makeMediaLocation() {
        return (new MediaLocation('https://com.sat/super-media-tool/video/video1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setCurrentTime(710)
            ->setVersion('1.0');
    }

    public static function makeVideoObject() {
        return (new VideoObject('https://com.sat/super-media-tool/video/video1'))
            ->setName('American Revolution - Key Figures Video')
            ->setAlignedLearningObjectives(TestEntities::makeLearningObjective())
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setDuration(1420)
            ->setVersion('1.0');
    }
}