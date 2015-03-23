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

## Under the hood

`Validator` throws an exception containing all the error messages (one per line).
It collects them from `ModelValidator`, a validator specialised in a specific model.
`ModelValidators` also collect the error messages, from `Constraints`: a class representing
a single rule.

## Default Constraints

Out of the box, `Validator` provides the following `Constraints`:

* Contract Methods cannot be static
* Contract Methods can only be public
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

## Next readings

* [Examples](04-examples.md)
* [Extending](05-extending.md)

Previous pages:

* [Model Tutorial](02-phpdoc-tutorial.md)
* [Model Tutorial](01-model-tutorial.md)
* [README](../README.md)
