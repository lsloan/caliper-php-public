<?php
require_once 'Caliper/entities/reading/EPubVolume.php';
require_once 'Caliper/entities/reading/Frame.php';
require_once 'Caliper/entities/reading/WebPage.php';

class TestReadingEntities {
    public static function makeEPubVolume() {
        return (new EPubVolume('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3)'))
            ->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setVersion('2nd ed.');
    }

    public static function makeFrame() {
        return (new Frame('https://github.com/readium/readium-js-viewer/book/34843#epubcfi(/4/3/1)'))
            ->setName('Key Figures: George Washington')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setIsPartOf(TestReadingEntities::makeEPubVolume())
            ->setVersion('2nd ed.')
            ->setIndex(1);
    }

    public static function makeWebPage() {
        return (new WebPage('https://some-university.edu/politicalScience/2015/american-revolution-101/index.html'))
            ->setName('American Revolution 101 Landing Page')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setVersion('1.0');
    }
}