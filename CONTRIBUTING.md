# How to contribute

Everybody should be able to help. Here's how you can make this project more
awesome:

1. [Fork it](https://github.com/memio/memio/fork_select)
2. improve it
3. submit a [pull request](https://help.github.com/articles/creating-a-pull-request)

Your work will then be reviewed as soon as possible (suggestions about some
changes, improvements or alternatives may be given).

Here's some tips to make you the best contributor ever:

* [Standard code](#standard-code)
* [Specifications](#specifications)
* [Keeping your fork up-to-date](#keeping-your-fork-up-to-date)

## Standard code

Use [PHP CS fixer](http://cs.sensiolabs.org/) to make your code compliant with
Memio's coding standards:

```console
$ ./vendor/bin/php-cs-fixer fix .
```

## Specifications

Memio drives its development using [phpspec](http://www.phpspec.net/).

First bootstrap the code for the Specification:

```console
$ phpspec describe 'Memio\Memio\MyNewUseCase'
```

Next, write the actual code of the Specification:

```console
$ $EDITOR spec/Memio/Memio/MyNewUseCase.php
```

Then bootstrap the code for the corresponding Use Case:

```console
$ phpspec run
```

Follow that by writing the actual code of the Use Case:

```console
$ $EDITOR src/Memio/Memio/MyNewUseCase.php
```

Finally run the specification:

```console
$ phpspec run
```

Results should be green!

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
