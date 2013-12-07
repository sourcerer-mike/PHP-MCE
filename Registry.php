<?php
/**
 * Contains class.
 *
 * PHP version 5
 *
 * Copyright (c) 2013, Mike Pretzlaw
 * All rights reserved.
 *
 * @category  PHP-MCE
 * @package   Registry.php
 * @author    Mike Pretzlaw <pretzlaw@gmail.com>
 * @copyright 2013 Mike Pretzlaw
 * @license   http://github.com/sourcerer-mike/PHP-MCE/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link      http://github.com/sourcerer-mike/PHP-MCE
 * @since     $VERSION$
 */

/**
 * Class Registry.
 *
 * @category  PHP-MCE
 * @author    Mike Pretzlaw <pretzlaw@gmail.com>
 * @copyright 2013 Mike Pretzlaw
 * @license   http://github.com/sourcerer-mike/PHP-MCE/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link      http://github.com/sourcerer-mike/PHP-MCE
 * @since     $VERSION$
 */
class Registry {
    protected static $_data;


    /**
     * .
     *
     * @return \Loader
     */
    public static function getLoader()
    {
        $fieldPath = 'loader';

        if (!self::hasProperty($fieldPath))
        {
            $loader = new \Loader();
            $loader->registerSpl();

            self::$_data[$fieldPath] = $loader;
        }

        return self::$_data[$fieldPath];
    }


    /**
     * .
     *
     * @return bool
     */
    protected static function hasProperty($field)
    {
        return isset(self::$_data[$field]);
    }
} 
