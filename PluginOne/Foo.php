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
 * @package   Foo.php
 * @author    Mike Pretzlaw <pretzlaw@gmail.com>
 * @copyright 2013 Mike Pretzlaw
 * @license   http://github.com/sourcerer-mike/PHP-MCE/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link      http://github.com/sourcerer-mike/PHP-MCE
 * @since     $VERSION$
 */

namespace PluginOne;

/**
 * Class Foo.
 *
 * @category  PHP-MCE
 * @author    Mike Pretzlaw <pretzlaw@gmail.com>
 * @copyright 2013 Mike Pretzlaw
 * @license   http://github.com/sourcerer-mike/PHP-MCE/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link      http://github.com/sourcerer-mike/PHP-MCE
 * @since     $VERSION$
 */

$alias = \Registry::getLoader()->getClassAlias('Foo');
\Registry::getLoader()->loadClass($alias);
class_alias($alias, "PluginOne\\Base\\Foo");

class Foo extends \PluginOne\Base\Foo {
}
