# CHANGELOG

# 2.0.0-alpha3: Return type hints

* added return type hints

## 2.0.0-alpha1, 2.0.0-alpha2: PHP 7

Dropped support for PHP < 7.

This means we now can use:

* scalar type hints
* return type hints
* callable type hint, without having to check PHP version

All `make` static constructor were created for PHP < 5.6, they're
now deprecated. Here's an example of what to use instead:

```
(new Method('sayHello'))
    ->addArgument(new Argument('string', 'name')))
;
```

### BC breaks:

* changed maximum method argument line length from 120 to 80
* changed opening curly brace to be on the same line as the method closing
  parenthesis, when arguments are on many lines
* changed properties to not have empty lines between them,
  except if they have PHPdoc

## 1.1.1: Updated dependencies

* added support for PHP 7

## 1.1.0: @return and @throws PHPdoc tags

* added abstract class generation
* added `return` PHPdoc tag generation
* added `throws` PHPdoc tag generation

## 1.0.1: Package Documentation

* added documentation for packages

## 1.0.0: Stabilised

* fixed TwigTemplateEngine\Config\Locate

## 1.0.0-rc14: TwigTemplateEngine extraction

* extracted TwigTemplateEngine in its own package

## 1.0.0-rc13: Template documentation

* updated Template documentation for `pretty-printer` 1.0.0-rc5

## 1.0.0-rc12: PrettyPrinter with TemplateEngine

* updated `Build` for new `PrettyPrinter` constructor

## 1.0.0-rc11: PrettyPrinter extraction

* extracted PrettyPrinter in its own package

> **BC breaks**:
>
> * removed `Memio\Memio\PrettyPrinter` namespace, use `Memio\PrettyPrinter` instead.

## 1.0.0-rc10: Linter extraction

* extracted Linter in its own package

> **BC breaks**:
>
> * removed `Memio\Validator\Constraint` namespace, use `Memio\Linter` instead.

## 1.0.0-rc9: Validator extraction

* extracted Validators to their own package

> **BC breaks**:
>
> * removed `Memio\Memio\Validator` namespace, use `Memio\Validator` instead.

## 1.0.0-rc8: Model extraction

* extracted Models to their own package

> **BC breaks**:
>
> * removed `Memio\Memio\Model` namespace, use `Memio\Model` instead.

## 1.0.0-rc7: Memio and Documentation

* renamed gnugat/medio into memio/memio
* completed documentation

> **BC breaks**:
>
> * removed `Gnugat\Medio` namespace, use `Memio\Memio` instead.

## 1.0.0-rc6: Argument Validator

* added ObjectArgumentCanOnlyDefaultToNull constraint

## 1.0.0-rc5: Collection Validator and Deep Validation

* added deep validation
* added CollectionCannotHaveNameDuplicates constraint

> **Note**: Validator now validates the structure in a file, constants/methods/properties
> in a structure and arguments in a method.

## 1.0.0-rc4: Contract Validator

* added ContractMethodsCanOnlyBePublic constraint
* added ContractMethodsCannotBeFinal constraint
* added ContractMethodsCannotBeStatic constraint
* added ContractMethodsCannotHaveBody constraint

## 1.0.0-rc3: Method Validator

* fixed autoloading
* added MethodCannotBeAbstractAndHaveBody constraint
* added MethodCannotBeBothAbstractAndPrivate constraint

## 1.0.0-rc2: Validator

* added Validator
* added MethodCannotBeBothAbstractAndFinal constraint

## 1.0.0-rc1: Path

* added default Path

> **Note**: use `Gnugat\Medio\Config\Path::templates()` to get the templates default path.

## 1.0.0-beta4: Method PHPdoc

* added Method PHPdoc generation

> **BC breaks**:
>
> * removed `Gnugat\Medio\Model\MethodPhpdoc`, use `Gnugat\Medio\Model\Phpdoc\MethodPhpdoc` instead.

## 1.0.0-beta3: Fixing Structure PHPdoc

* fixed Structure PHPdoc generation

## 1.0.0-beta2: Property PHPdoc

* added Property PHPdoc generation
* added Argument default value generation

> **Note**: Type#getName now returns the unqualified name. To get the fully qualified
> name, use Type#getFullyQualifiedName.

## 1.0.0-beta1: License header, Structure PHPdoc

* added Structure PHPdoc generation
* added License header generation

## 1.0.0-alpha18: Final method

* added final method generation

## 1.0.0-alpha17: Abstract method

* added abstract method generation
* added tutorial documentation

> **BC breaks**:
>
> * moved structure from File constructor to setter

## 1.0.0-alpha16: Final class

* added final class generation
* added property default value generation
* fixed FullyQualifiedName

## 1.0.0-alpha15: Fixed File

* fixed File constructor

## 1.0.0-alpha14: Parents

* added interface parents generation
* added class interfaces generation
* added class parent generation
* refactored FullyQualifiedName
* refactored PrettyPrinter

> **BC breaks**:
>
> * replaced Import by FullyQualifiedName

> **Note**: PrettyPrinter now builds the TwigExtension (makes instanciation easier).

## 1.0.0-alpha13: Contract, Object

* added interface generation
* added class (standalone) generation
* refactored need_after_line
* refactored Type

> **BC break**:
>
> * added Structure argument to File constructor
> * renamed getCollection methods into all (e.g getArgumentCollection becomes allArguments)
> * renamed FullyQualifiedClassname into FullyQualifiedName
> * removed Type from Argument constructor parameters (give directly the type as a string)

## 1.0.0-alpha12: Collection, FullyQualifiedClassname

* refactored fully qualified classname management
* refactored collection management

> **BC break**:
>
> * removed Argument, Constant, Import, Method and Property collections

## 1.0.0-alpha11: Imports, Method body and doc

* added Imports (use statement) generation
* added Method's body generation
* improved documentation (introduction, installation, usage, cheat sheet and extending)

## 1.0.0-alpha10: License, visibility and staticness

* added License header generation
* added Method and Property visibility
* added Method and Property staticness

## 1.0.0-alpha9: Constants

* added Constants generation

## 1.0.0-alpha8: Properties

* added Properties generation

## 1.0.0-alpha7: Method's PHPdoc, static constructors

* added Method's PHPdoc generation
* added static constructors to all Models

## 1.0.0-alpha6: File

* added File (namespace, class, etc) generation

## 1.0.0-alpha5: Methods, fixtures refactoring

* added Methods generation
* moved fixtures in `examples/fixtures`

## 1.0.0-alpha4: Method

* added Method generation

> **BC break**:
>
> * removed VariableArgumentCollectionFactory

## 1.0.0-alpha3: Puli

* added `/gnugat/medio/templates` Puli's path

## 1.0.0-alpha2: PrettyPrinter parameters

* added parameters argument to PrettyPrinter#generateCode

> **BC break**:
>
> * removed MultilineArgumentCollectionPrinter
> * removed InlineArgumentCollectionPrinter

## 1.0.0-alpha1: PrettyPrinter, Twig templates and Arguments

* added PrettyPrinter
* added Arguments generation

> **Note**: Usage of single pretty printer (Model specific generation is done in Twig templates)

## 0.4.0: Type, Method refactoring, executable examples

* added Type construction from variable
* added executable examples
* refactored Method (removed visibility, Arguments from constructor parameters)

## 0.3.0: Method, typehints and PHPdoc generation

* added Method generation
* added Method's PHPDoc generation
* added Arguments type hint generation
* added inline/multiline Arguments generation

> **BC Break**:
>
> * removed _everything_

> **Note**: Usage of specialized pretty printers (each Model has its own generator)

## 0.2.0: Missing Constructor generation

* added Missing Constructor generation

## 0.1.0: DependencyInjectionCommand

* added DependencyInjectionCommand:
    * Import generation
    * Property with PHPdoc generation
    * Constructor argument with PHPdoc generation
    * Property initialization in constructor generation

> **Note**: Usage of Redaktilo + regex to edit existing code
