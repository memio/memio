# Validation Tutorial

Memio provides a `Validator` component that allows us to define Model constraints.
It also provides a `Linter` package, which is a collection of constraints that aims
at checking syntax errors and the like:

* Collection cannot have name duplicates
* Concrete Object Methods cannot be abstract
* Contract Methods can only be public
* Contract Methods cannot be final
* Contract Methods cannot be static
* Contract Methods cannot have a body
* Method cannot be abstract and have a body
* Method cannot be both abstract and final
* Method cannot be both abstract and private
* Method cannot be both abstract and static
* Object Argument can only default to null

Here's how to ue the linter:

```php
use Memio\Memio\Config\Build;
use Memio\Model\Method;

(new Method('myMethod'))
    ->makeAbstract()
    ->makeFinal()
;

$linter = Build::linter();
$linter->validate($method); // @throws Memio\Validator\Exception\InvalidModelException
```

![UML class diagram](http://yuml.me/b6df7b4a)

## Providing new Constraints

To add new rules to the validator, we first need to create a new `Constraint`:

```php
<?php

namespace Vendor\Project\Validator\Constraint;

use Memio\Validator\Constraint;
use Memio\Validator\Violation\NoneViolation;
use Memio\Validator\Violation\SomeViolation;

class ArgumentCannotBeScalar implements Constraint
{
    public function validate($model)
    {
        if (!$model->isObject()) {
            return new SomeViolation(sprintf('Argument "%s" cannot be scalar', $model->getName()));
        }

        return new NoneViolation();
    }
}
```

> **Note**: We've named the constraint after its error message.
> This isn't mandatory, but this way it clearly express its purpose.

We then need to register our rule in an `ArgumentValidator`:

```php
// ...

use Memio\Validator\ModelValidator\ArgumentValidator;

$argumentValidator = new ArgumentValidator();
$argumentValidator->add(new ArgumentCannotBeScalar());
```

For each model Memio provides a `ModelValidator`. When providing `Validator` with
an `Argument`, it will call `ArgumentValidator`.

This isn't enough: if we provide a `Method` to `Validator`, we'd like it to also
check its `Arguments`. To do so, we need to assemble `ModelValidators` as follow:

```php
// ...

use Memio\Validator\ModelValidator\CollectionValidator;
use Memio\Validator\ModelValidator\MethodValidator;
use Memio\Validator\ModelValidator\ContractValidator;
use Memio\Validator\ModelValidator\ObjectValidator;
use Memio\Validator\ModelValidator\FileValidator;

$collectionValidator = new CollectionValidator();
$methodValidator = new MethodValidator($argumentValidator, $collectionValidator);
$contractValidator = new ContractValidator($collectionValidator, $methodValidator);
$objectValidator = new ObjectValidator($collectionValidator, $methodValidator);
$fileValidator = new FileValidator($contractValidator, $objectValidator);
```

Finally, we need to create a validator and register our `ModelValidators` in it:

```php
// ...
//
$myValidator = new Validator();
$myValidator->add($argumentValidator);
$myValidator->add($collectionValidator);
$myValidator->add($methodValidator);
$myValidator->add($contractValidator);
$myValidator->add($objectValidator);
$myValidator->add($fileValidator);
```

We'll be able to use it like this:

```php
$myValidator->validate($myModel);
```

## Next readings

* [Examples](04-examples.md)
* [Templates](05-templates.md)
* [Packages](06-packages.md)

Previous pages:

* [PHPdoc Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
