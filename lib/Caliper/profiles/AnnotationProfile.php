<?php
namespace profiles;
require 'Profile.php';

class AnnotationProfile extends Profile {
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
