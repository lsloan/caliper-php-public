<?php
require_once 'Caliper/entities/annotation/BookmarkAnnotation.php';
require_once 'Caliper/entities/annotation/HighlightAnnotation.php';
require_once 'Caliper/entities/annotation/SharedAnnotation.php';
require_once 'Caliper/entities/annotation/TagAnnotation.php';
require_once 'Caliper/entities/annotation/TextPositionSelector.php';

class TestAnnotationEntities {
    /** @return BookmarkAnnotation */
    public static function makeBookmarkAnnotation() {
        return (new BookmarkAnnotation('https://example.edu/bookmarks/00001'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame2())
            ->setBookmarkNotes('The Intolerable Acts (1774)--bad idea Lord North');
    }

    /** @return HighlightAnnotation */
    public static function makeHighlightAnnotation() {
        return (new HighlightAnnotation('https://example.edu/highlights/12345'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame1())
            ->setSelection((new TextPositionSelector())
                ->setStart('455')
                ->setEnd('489'))
            ->setSelectionText('Life, Liberty and the pursuit of Happiness');
    }

    /** @return SharedAnnotation */
    public static function makeSharedAnnotation() {
        return (new SharedAnnotation('https://example.edu/shared/9999'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame3())
            ->setWithAgents(TestAgentEntities::makeWithAgents());
    }

    /** @return TagAnnotation */
    public static function makeTagAnnotation() {
        return (new TagAnnotation('https://example.edu/tags/7654'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame4())
            ->setTags(["to-read", "1765", "shared-with-project-team"]);
    }
}