# How to contribute

Everybody should be able to help. Here's how you can make this project more
awesome:

1. [Fork it](https://github.com/memio/memio/fork_select)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

Here's some tips to make you the best contributor ever:

* [Getting started](#getting-started)
* [Standard code](#standard-code)
* [Tests](#tests)
* [Full QA check](#full-qa-check)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)

## Getting started

First, set up your local environment:

```console
make lib-init
```

> **Note**: Run `make` or `make help` to see all available commands.

## Standard code

Use [PHP CS fixer](http://cs.sensiolabs.org/) to make your code compliant with
Memio's coding standards:

```console
make cs-fix
```

## Tests

Memio uses [PHPUnit](https://phpunit.de/) for testing.

Run the tests:

```console
make phpunit
```

Results should be green!

## Full QA check

Before submitting your pull request, run the full QA pipeline:

```console
make lib-qa
```

## Keeping your fork up-to-date

To keep your fork up-to-date, you should track the upstream (original) one
using the following command:

```console
$ git remote add upstream https://github.com/memio/memio.git
```

Then get the upstream changes:

```console
git checkout main
git pull --rebase origin main
git pull --rebase upstream main
git checkout <your-branch>
git rebase main
```

Finally, publish your changes:

```console
$ git push -f origin <your-branch>
```

Your pull request will be automatically updated.
