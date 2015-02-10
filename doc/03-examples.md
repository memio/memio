# Examples

Medio doesn't have traditional tests. It has executable examples!

Have a look in the `examples` directory, each file contains a feature with many
scenarii.

> **Note**: Here, the word feature is used instead of "PHPUnit Test Class", and
> the word scenario is used instead of "test method".

> **Note**: Please ignore the `examples/PrettyPrinterTestCase.php` file.

Each scenario is composed of 3 kind of step:

1. creation of the model
2. generation of the code, using the built model
3. comparison with expected code

The expected code can be quite lengthy, in those cases it's been put in a fixture
file. But don't panic! You can find them in the `fixtures` directory, they are
put in a folder named after the feature, and then in a file named after the scenario.

To make sure each modification added to Medio doesn't break anything, those
examples are executed using [phpunit](http://phpunit.de).
