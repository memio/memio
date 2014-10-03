# Inject dependencies

* [Synopsis](#synopsis)
* [Example](#example)

## Synopsis

    medio dependency:injection fully_qualified_classname filename

    Shortcuts:

        * d:i

    Arguments:

        * fully_qualified_classname: the full namespace with the classname of the dependency to inject
        * filename: the path to the service's file where the dependency should be injected

## Example

Consider the following class:

```php
<?php
// File: fixture/Gnugat/Medio/Service.php

namespace fixture\Gnugat\Medio;

class Service
{
    public function __construct()
    {
    }
}
```

Medio provides an easy way to inject its first dependency:

    medio dependency:inject 'fixture\Gnugat\Medio\SubDir\Dependency' ./fixture/Gnugat/Medio/Service.php

> Note: the shortcut `d:i` an be used instead of `dependency:inject`.

It will edit the class and leave it as follows:

```php
<?php
// File: fixture/Gnugat/Medio/Service.php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;

class Service
{
    private $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }
}
```

Medio can also inject dependencies when existing ones are already present:

    medio d:i 'fixture\Gnugat\Medio\OtherDependency' ./fixture/Gnugat/Medio/Service.php

> Note: `OtherDependency` is located in the same directory as `Service`, Medio
> will detect it and won't insert its unnecessary use statement.

```php
<?php
// File: fixture/Gnugat/Medio/Service.php

namespace fixture\Gnugat\Medio;

use fixture\Gnugat\Medio\SubDir\Dependency;

class Service
{
    private $dependency;

    private $otherDependency;

    public function __construct(Dependency $dependency, OtherDependency $otherDependency)
    {
        $this->dependency = $dependency;
        $this->otherDependency = $otherDependency;
    }
}
```
