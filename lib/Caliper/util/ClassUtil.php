<?php
/**
 * Class ClassUtil
 *
 * Provide useful methods to overcome OOP shortcomings in some versions of PHP.
 */
class ClassUtil {
    /**
     * The "::class" notation isn't available until PHP 5.5.  This method is a workaround for
     * older versions of PHP.
     *
     * @return string Name of this class
     */
    static public function className() {
        return get_called_class();
    }
}