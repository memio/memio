# CHANGELOG

## 1.0.0-alpha4: Method

* added method template
* tagged Method as part of public API:
    * __construct
    * addArgument
* tagged more Type methods as part of public API:
    * getName
    * isObject
* removed Factory directory (legacy code):
    * removed VariableArgumentCollectionFactory [**BC break**]

## 1.0.0-alpha3: Puli

* added `/gnugat/medio/templates` Puli's path

## 1.0.0-alpha2: Twig tempates parameters

* added parameters argument to PrettyPrinter#generateCode
* removed PrettyPrinter directory (legacy code):
    * removed MultilineArgumentCollectionPrinter [**BC break**]
    * removed InlineArgumentCollectionPrinter [**BC break**]

## 1.0.0-alpha1: Twig templates

* tagged ArgumentCollection as part of public API:
    * add
* tagged Argument as part of public API:
    * __construct
* tagged Type as part of public API:
    * __construct
* tagged PrettyPrinter as part of public API:
    * __construct
    * generateCode
* added argument_collection template
* added argument template
* added PrettyPrinter

## 0.4.0: Refactoring

* removed ArgumentCollection from Method#__construct arguments
* removed method visibility
* added Type
* added examples as tests
* tagged MultilineArgumentCollectionPrinter as part of public API
* tagged InlineArgumentCollectionPrinter as part of public API
* tagged VariableArgumentCollectionFactory as part of public API

## 0.3.0: Green field

* added generation of method with phpdoc and typehinted arguments
* removed everything

## 0.2.0

* added insertion of missing constructor in dependency injection command
* added insertion of method
* added detection of empty class
* added detection of method presence
* added selection of class ending
* added selection of next constant
* added detection of next constant
* added detection of previous constant

## 0.1.0

* added selection of method
* added selection of next property
* added selection of namespace
* added selection of next line
* added selection of class opening
* added selection of method closing
* added detection of use statement need
* added detection of next use statement presence
* added detection of previous property presence
* added detection of next property presence
* added detection of method's argument presence
* added detection of inline method arguments
* added detection of next multiline argument
* added insertion of multiline argument
* added insertion of use statement
* added insertion of property
* added insertion of inline argument
* added insertion of property initialization
* added dependency injection command
