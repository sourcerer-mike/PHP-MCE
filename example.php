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
 * @package   example.php
 * @author    Mike Pretzlaw <pretzlaw@gmail.com>
 * @copyright 2013 Mike Pretzlaw
 * @license   http://github.com/sourcerer-mike/PHP-MCE/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link      http://github.com/sourcerer-mike/PHP-MCE
 * @since     $VERSION$
 */ 

require_once 'Loader.php';
require_once 'Registry.php';

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);

/*
 * First extension
 */
require_once 'PluginOne/Foo.php';

// enable the following line to have \PluginOne\Foo instead of \Base\Foo
// \Registry::getLoader()->setClassAlias('Foo', '\PluginOne\Foo');

/*
 * Second extension
 */
require_once 'PluginTwo/Foo.php';

// enable the next to even extend it twice and use \PluginTwo\Foo
// \Registry::getLoader()->setClassAlias('Foo', '\PluginTwo\Foo');

$foo = new \Foo();
echo get_class($foo), PHP_EOL;
echo $foo->bar(), PHP_EOL;

