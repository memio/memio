# Medio

A highly opinionated PHP code generator library.

Medio provides a model reflecting the code structure (`Argument`, `Method`, etc)
and uses [Twig templates](http://twig.sensiolabs.org/) to generate the code.

Here's the features:

* [x] generate an argument (type hint when needed)
* [x] generate a collection of arguments (inline if length < 120 characters)
* [ ] remove legacy code
* [ ] generate a method
* [ ] generate a method's PHPdoc
* [ ] generate a collection of methods
* [ ] generate a file (namespace and class)
* [ ] generate a property
* [ ] generate a property's PHPdoc
* [ ] generate a collection of properties
* [ ] generate a constant
* [ ] generate a collection of constants
* [ ] generate a use statement
* [ ] generate a collection of use statements
* [ ] generate a license header

![Logo: an elephant, a tree and some twigs](https://raw.githubusercontent.com/gnugat/medio/master/logo.jpg)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592/mini.png)](https://insight.sensiolabs.com/projects/87bf291f-affa-4383-b281-c0dc5aa7d592)
[![Travis CI](https://travis-ci.org/gnugat/medio.png)](https://travis-ci.org/gnugat/medio)

## Installation

Use [Composer](https://getcomposer.org/download):

    composer require gnugat/medio:~1.0.0-alpha1

## Usage

Here's how to generate a collection of arguments:

```php
$argumentCollection = new ArgumentCollection();
$argumentCollection->add(new Argument(new Type('Vendor\\Package\\Service'), 'service'));
$argumentCollection->add(new Argument(new Type('array'), 'config'));
$argumentCollection->add(new Argument(new Type('string'), 'parameter'));

echo $prettyPrinter->generateCode($argumentCollection);
```

It should print the following generated code:

```
\Vendor\Package\Service $service, array $config, $parameter
```

## Further documentation

Discover more by reading the docs:

* [Model](doc/01-model.md)
* [Templates](doc/02-templates.md)
* [Examples](doc/03-examples.md)

You can see the current and past versions using one of the following:

* the `git tag` command
* the [releases page on Github](https://github.com/gnugat/medio/releases)
* the file listing the [changes between versions](CHANGELOG.md)

And finally some meta documentation:

* [copyright and MIT license](LICENSE)
* [versioning and branching models](VERSIONING.md)
* [contribution instructions](CONTRIBUTING.md)
