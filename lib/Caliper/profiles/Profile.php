<?php
namespace profiles;
if (!defined('CALIPER_LIB_PATH')) {
    throw new Exception('Please require CaliperSensor first.');
}

require_once 'util/SplEnumPlus.php';
require_once 'Caliper/entities/CaliperDigitalResource.php';
require_once 'Caliper/entities/schemadotorg/CreativeWork.php';

class Actions extends \SplEnumPlus {
    const
        __default = '',
        DOWNLOADED = 'item.downloaded',
        UPLOADED = 'item.uploaded',
        
        LOGGED_IN = 'session.loggedIn',
        LOGGED_OUT = 'session.loggedOut',
        
        NAVIGATED_TO = 'navigation.navigatedTo';
}

class Profile {
    /**
     * @param key
     * @return localized action string.
     */
    public static function getNavigatedToActionFromBundle($key) {
        if ($key == 'navigation.navigatedTo') {
            $actionStrings = parse_ini_file('actions_en_US.ini');
            return $actionStrings[$key];
        } else {
            throw new \UnexpectedValueException('Unrecognized key: ' . $key);
        }
    }

    /**
     * @param object
     * @return DigitalResource
     */
    public static function validateDigitalResource($object) {
        if ($object instanceof CaliperDigitalResource) { // TODO rename to DigitalResource
            // TODO add additional checks
            return $object;
        } else {
            throw new InvalidArgumentException('Object must be of type DigitalResource.');
        }
    }

    /**
     * @param target
     * @return digital resource
     */
    public static function validateTarget($target) {
        if ($target instanceof Frame) {
            // TODO add additional checks
            return $target;
        } else if ($target instanceof MediaLocation) {
            // TODO add additional checks
            return $target;
        } else {
            throw new InvalidArgumentException('Target must implement the Targetable interface.');
        }
    }
}
