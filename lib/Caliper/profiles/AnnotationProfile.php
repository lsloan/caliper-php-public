<?php
namespace profiles;
require 'Profile.php';
require_once '../../util/BasicEnum.php.php';

class AnnotationActions extends \BasicEnum {
    const
        __default = '',
        ATTACHED = 'annotation.attached',
        BOOKMARKED = 'annotation.bookmarked',
        CLASSIFIED = 'annotation.classified',
        COMMENTED = 'annotation.commented',
        DESCRIBED = 'annotation.described',
        HIGHLIGHTED = 'annotation.highlighted',
        IDENTIFIED = 'annotation.identified',
        LIKED = 'annotation.liked',
        LINKED = 'annotation.linked',
        RANKED = 'annotation.ranked',
        QUESTIONED = 'annotation.questioned',
        RECOMMENDED = 'annotation.recommended',
        REPLIED = 'annotation.replied',
        SHARED = 'annotation.shared',
        SUBSCRIBED = 'annotation.subscribed',
        TAGGED = 'annotation.tagged';
}

class AnnotationProfile extends Profile {
    
    /**
     * @param key
     * @return localized action string.
     */
    public static function getActionFromBundle($key) {
        if (AnnotationActions::hasKey($key) || Actions::hasKey($key)) {
            $actionStrings = parse_ini_file('actions_en_US.ini');
            return $actionStrings[$key];
        } else {
            throw new \UnexpectedValueException('Unrecognized key: ' . $key);
        }
    }

    /**
     * @param object
     * @return activityContext object.
     */
    /*
    public static function validateObject($object) {
        if (object instanceof Annotation) {
            //TODO CONSIDER ADDING REVERSE LOOKUP TO ENUM SO THAT ENUM CAN BE RETURNED FOR USE IN SWITCH STATEMENT
            $type = $object->getType();
            if (type == Annotation.Type.BOOKMARK_ANNOTATION.uri())) {
                // TODO CHECK REQUIRED PROPS
            } else if (type == Annotation.Type.HIGHLIGHT_ANNOTATION.uri())) {
                // TODO CHECK REQUIRED PROPS
            } else if (type == Annotation.Type.SHARED_ANNOTATION.uri())) {
                // TODO CHECK REQUIRED PROPS
            } else if (type == Annotation.Type.TAG_ANNOTATION.uri())) {
                // TODO CHECK REQUIRED PROPS
            } else {
                // TODO THROW ERROR UNRECOGNIZED URI
            }
            // TODO add additional checks

            return (Annotation) object;
        } else {
            throw new ClassCastException("Object must be of type Annotation.");
        }
    }
*/
    /**
     * @param object
     * @return target
     */
    public static function validateTarget($object) {
        if ($object instanceof DigitalResource) {
            // TODO add additional checks
            return $object;
        } else {
            throw new InvalidArgumentException('Object must be of type DigitalResource.');
        }
    }
}

echo (AnnotationActions::hasKey('annotation.tagged') ? 'true' : 'false') . PHP_EOL;

$x = new AnnotationProfile();
echo $x->getActionFromBundle(Actions::UPLOADED) . PHP_EOL;
echo AnnotationProfile::getActionFromBundle('annotation.liked') . PHP_EOL;

