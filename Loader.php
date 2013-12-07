<?php
/**
 * Class Psr0.
 *
 * PHP version 5
 *
 * Copyright (c) 2013, Mike Pretzlaw
 * All rights reserved.
 *
 * @category PHP-MCE
 * @package  Pat\Environment\Autoloader
 * @author   Mike Pretzlaw <pretzlaw@gmail.com>
 * @license  http://github.com/sourcerer-mike/php-application-toolkit/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link     http://github.com/sourcerer-mike/php-application-toolkit
 */

/**
 * Class Loader.
 *
 * @category Pat
 * @package  Pat\Environment\Autoloader
 * @author   Mike Pretzlaw <pretzlaw@gmail.com>
 * @license  http://github.com/sourcerer-mike/php-application-toolkit/blob/master/License.md BSD 3-Clause ("BSD New")
 * @link     http://github.com/sourcerer-mike/php-application-toolkit
 */
class Loader
{

    /** @var string Extension for class files. */
    public $extension = '.php';

    protected $_classAlias = array();


    public function getClassAlias($className)
    {
        if (!self::hasClassAlias($className))
        {
            $realClassName = '\\Base\\' . ltrim($className, '\\');
            $this->setClassAlias($className, $realClassName);
        }

        return $this->_classAlias[$className];
    }


    /**
     * Make filename by class name.
     *
     * @param string $className Identifier of a class.
     *
     * @return string
     */
    public function getFilename($className)
    {
        // Trim prefix of namespaces for relative path.
        $classPath = \ltrim($className, '\\');
        $fileName  = '';

        $lastNsPos = \strripos($classPath, '\\');
        if (false !== $lastNsPos)
        {
            // Has namespace: transform filename!
            $namespace = \substr($classPath, 0, $lastNsPos);
            $classPath = \substr($classPath, ($lastNsPos + 1));
            $fileName  = \str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= \str_replace('_', DIRECTORY_SEPARATOR, $classPath) . $this->extension;

        return $fileName;
    }


    /**
     * Include a class that uses namespaces.
     *
     * See interface:
     * {@inheritdoc}
     *
     * E.g. there is \Pat\Persistence\Cache then it will
     * look in every include path for /Pat/Persistence/Cache.php
     * and require it once.
     *
     * @param string $className Identifier for the class.
     *
     * @return boolean
     */
    public function loadClass($className)
    {
        $realClassName = $this->getClassAlias($className);


        if (class_exists($realClassName, false))
        {
            class_alias($realClassName, $className);
            return class_exists($className, false);
        }

        if (!$this->_loadClass($className))
        {
            return false;
        }

        class_alias($realClassName, $className);
        return class_exists($className, false);
    }


    protected function _loadClass($className)
    {
        // PSR-0 method for resolving class names
        // as described on http://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md .
        $fileName     = $this->getFilename($className);
        $requiredFile = \stream_resolve_include_path($fileName);
        if (false !== $requiredFile)
        {
            // Exists in at least one include-path: require it!
            include_once $requiredFile;
        }

        if (!class_exists($className, false))
        {
            return false;
        }
    }


    /**
     * Register this autoloader (with Spl methods).
     *
     * @param boolean $prepend Put this autoloader in front of others (default: false).
     *
     * @return boolean
     * @throws \ErrorException When autoload could not be added.
     */
    public function registerSpl($prepend = false)
    {
        try
        {
            $success = \spl_autoload_register(array($this, 'loadClass'), true, $prepend);
        } catch (\LogicException $e)
        {
            throw new \ErrorException('Could not provide __autoload stack: ' . $e->getMessage());
        }

        return $success;
    }


    /**
     * .
     *
     * @param $className
     *
     * @return bool
     */
    public function hasClassAlias($className)
    {
        return isset($this->_classAlias[$className]);
    }


    /**
     * .
     *
     * @param $className
     *
     * @return void
     */
    public function setClassAlias($className, $alias)
    {
        $this->_classAlias[$className] = $alias;
    }
}
