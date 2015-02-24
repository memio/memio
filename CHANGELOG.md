# CHANGELOG

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
