PHP-MCE
=======

PHP Multi-Class-Extension Architecture

Take down the limits of `extends` for extend with multiple classes instead of only one.

For example you extend `\Foo` by two plugins:

```
.
├── Base
│   └── Foo
├── PluginOne
│   └── Foo
└── PluginTwo
    └── Foo
```

- PluginOne will make it `PluginOne\Foo` extending the default `\Base\Foo`.
- PluginTwo will make it `PluginTwo\Foo` extending the previous state (here: PluginOne).

Until now this is almost done like that:

```
/*
 * First extension
 */
require_once 'PluginOne/Foo.php';

// enable the following line to have \PluginOne\Foo instead of \Base\Foo
\Registry::getLoader()->setClassAlias('Foo', '\PluginOne\Foo');

/*
 * Second extension
 */
require_once 'PluginTwo/Foo.php';

// enable the next to even extend it twice and use \PluginTwo\Foo
\Registry::getLoader()->setClassAlias('Foo', '\PluginTwo\Foo');

$foo = new \Foo();
echo get_class($foo), PHP_EOL;
echo $foo->bar(), PHP_EOL;
``
