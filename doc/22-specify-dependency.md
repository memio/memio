# Specify dependencies

Specify the dependency of a class, for [phpspec](http://phpspec.org).

* [Synopsis](#synopsis)
* [Example](#example)

## Synopsis

    medio d:s fully_qualified_classname filename

    Arguments:

        * fully_qualified_classname: the full namespace with the classname of the dependency to spec
        * filename: the path to the spec's file where the dependency should be specified

## Example

Consider the following spec:

```php
<?php
// File: fixture/Gnugat/Medio/ServiceSpec.php

namespace fixture\Gnugat\Medio;

use PhpSpec\ObjectBehavior;

class ServiceSpec extends ObjectBehavior
{
}
```

Medio provides an easy way to specify its first dependency:

    medio d:s 'fixture\Gnugat\Medio\SubDir\Dependency' ./fixture/Gnugat/Medio/ServiceSpec.php

It will edit the class and leave it as follows:

```php
<?php
// File: fixture/Gnugat/Medio/ServiceSpec.php

namespace fixture\Gnugat\Medio;

use PhpSpec\ObjectBehavior;
use fixture\Gnugat\Medio\SubDir\Dependency;

class ServiceSpec
{
    function let(Dependency $dependency)
    {
        $this->beConstructedWith($dependency);
    }
}
```

Medio can also specify dependencies when existing ones are already present:

    medio d:i 'fixture\Gnugat\Medio\OtherDependency' ./fixture/Gnugat/Medio/ServiceSpec.php

```php
<?php
// File: fixture/Gnugat/Medio/ServiceSpec.php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;

class ServiceSpec
{
    function let(Dependency $dependency, OtherDependency $otherDependency)
    {
        $this->beConstructedWith($dependency, $otherDependency);
    }
}
```
