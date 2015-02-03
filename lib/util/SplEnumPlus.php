<?php
class SplEnumPlus extends \SplEnum {
    static function hasKey($key) {
        $foundKey = false;
        
        try {
            $enumClassName = get_called_class();
            new $enumClassName($key);
            $foundKey = true;
        } finally {
            return $foundKey;
        }
    }
}
