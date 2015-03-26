# Validation Tutorial

Programming languages follow rules, and PHP is no exception: defining a method
as being both abstract and final will result in a Fatal Error.

To avoid generating invalid code, Medio provides a `Validator`:

```php
use Gnugat\Medio\Validator;

Method::make('myMethod')
    ->makeAbstract()
    ->makeFinal()
;

$validator = new Validator();
$validator->validate($method); // @throws Gnugat\Medio\Exception\InvalidModelException
```

## Default Constraints

Out of the box, `Validator` provides the following `Constraints`:

* Collection cannot have name duplicates
* Concrete Object Methods cannot be abstract
* Contract Methods can only be public
* Contract Methods cannot be final
* Contract Methods cannot be static
* Contract Methods cannot have a body
* Method cannot be abstract and have a body
* Method cannot be both abstract and final
* Method cannot be both abstract and private

## Providing new Constraints

To add new rules to the validator, we first need to create a new `Constraint`:

```php
<?php

namespace Vendor\Project\Validator\Constraint;

use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;

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

> **Note**: In Medio all `Constraints` are named after their error message, but
> this is not mandatory.

We then need to create a `ModelValidator` specialized in `Arguments`:

```php
<?php

namespace Vendor\Project\Validator;

use Gnugat\Medio\Model\Argument;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\ConstraintValidator;
use Gnugat\Medio\Validator\ModelValidator;
use Vendor\Project\Validator\Constraint\ArgumentCannotBeScalar;

class ArgumentValidator implements ModelValidator
{
    private $constraints;
    private $constraintValidator;

    public function __construct()
    {
        $this->constraintValidator = new ConstraintValidator();
        $this->constraintValidator->add(new ArgumentCannotBeScalar());
    }

    public function add(Constraint $constraint)
    {
        $this->constraintValidator->add($constraint);
    }

    public function supports($model)
    {
        return $model instanceof Argument;
    }

    public function validate($model)
    {
        return $this->constraintValidator->validate($model);
    }
}
```

> **Note**: `ConstraintValidator` takes care of executing all the constraints and
> aggregating all error messages.

Finally we can register everything in the `Validator`:

```php
use Vendor\Project\Validator\ArgumentValidator;

$validator->add(new ArgumentValidator());

$validator->validate(new Argument('string', 'scalar')); // @throws Gnugat\Medio\Exception\InvalidModelException
```

## Under the hood

`Validator`'s role is to find a `ModelValidator` that supports the given model.
`ModelValidators` own many `Constraints`, it applies all of them to the given model.
A `Constraint` returns `NoneViolation` if everything is fine, or esle a `SomeViolation`
containing a message. `ModelValidator` adds those `Violations` to a `ViolationCollection`
and returns it to `Validator`. Finally, `Validator` throws an `InvalidModelException` if the
returned `ViolationCollection` contains at least one violation.

The `InvalidModelException`'s message is composed of the `ViolationCollection` messages
(it separates those by a line break).

## Next readings

* [Examples](04-examples.md)
* [Extending](05-extending.md)

Previous pages:

* [Model Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
