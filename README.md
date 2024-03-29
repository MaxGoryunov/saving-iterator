[![EO principles respected here](https://www.elegantobjects.org/badge.svg)](https://www.elegantobjects.org)
[![DevOps By Rultor.com](http://www.rultor.com/b/MaxGoryunov/saving-iterator)](http://www.rultor.com/p/MaxGoryunov/saving-iterator)

![PHP-Composer-Build](https://github.com/MaxGoryunov/saving-iterator/actions/workflows/php.yml/badge.svg)
[![Build Status](https://app.travis-ci.com/MaxGoryunov/saving-iterator.svg?branch=master)](https://app.travis-ci.com/MaxGoryunov/saving-iterator)
[![Build status](https://ci.appveyor.com/api/projects/status/n4g8288u7u1xkj05/branch/master?svg=true)](https://ci.appveyor.com/project/MaxGoryunov/saving-iterator/branch/master)
[![wercker status](https://app.wercker.com/status/f43bcadc6b1557a83b4ed20041478135/s/master "wercker status")](https://app.wercker.com/project/byKey/f43bcadc6b1557a83b4ed20041478135)
[![MaxGoryunov](https://circleci.com/gh/MaxGoryunov/saving-iterator.svg?style=svg)](https://app.circleci.com/pipelines/github/MaxGoryunov/saving-iterator)

[![PDD status](https://www.0pdd.com/svg?name=MaxGoryunov/saving-iterator)](https://www.0pdd.com/p?name=MaxGoryunov/saving-iterator)
[![codecov](https://codecov.io/gh/MaxGoryunov/saving-iterator/branch/master/graph/badge.svg?token=KYRZ0UK8E8)](https://codecov.io/gh/MaxGoryunov/saving-iterator)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FMaxGoryunov%2Fsaving-iterator%2Fmaster)](https://infection.github.io)
[![Latest Stable Version](http://poser.pugx.org/maxgoryunov/saving-iterator/v)](https://packagist.org/packages/maxgoryunov/saving-iterator)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://github.com/MaxGoryunov/saving-iterator/blob/master/LICENSE)

[![Maintainability](https://api.codeclimate.com/v1/badges/d721a5fca4901010520e/maintainability)](https://codeclimate.com/github/MaxGoryunov/saving-iterator/maintainability)
[![codebeat badge](https://codebeat.co/badges/b95d6d2e-f46c-4270-a474-21d3ba562e31)](https://codebeat.co/projects/github-com-maxgoryunov-saving-iterator-master)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/993e91480dfa4239a780d5d7af528d30)](https://www.codacy.com/gh/MaxGoryunov/saving-iterator/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=MaxGoryunov/saving-iterator&amp;utm_campaign=Badge_Grade)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=MaxGoryunov_saving-iterator&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=MaxGoryunov_saving-iterator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MaxGoryunov/saving-iterator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MaxGoryunov/saving-iterator/?branch=master)
[![CodeFactor](https://www.codefactor.io/repository/github/maxgoryunov/saving-iterator/badge)](https://www.codefactor.io/repository/github/maxgoryunov/saving-iterator)

[![Hits-of-Code](https://hitsofcode.com/github/MaxGoryunov/saving-iterator?branch=master)](https://hitsofcode.com/github/MaxGoryunov/saving-iterator/view)
![Lines-of-Code](https://tokei.rs/b1/github/MaxGoryunov/saving-iterator?branch=master)
![PHP Version](https://img.shields.io/packagist/php-v/MaxGoryunov/saving-iterator)

**Saving Iterator** is a true caching iterator for PHP. It aims to solve the same problems as PHP's [Caching Iterator](https://www.php.net/manual/ru/class.cachingiterator.php) but with a [better encapsulation of data](https://www.yegor256.com/2016/11/21/naked-data.html) in mind. It has properties of both `Iterator` and `array`.

## How to use

Require it with [Composer](https://getcomposer.org/download/):

```bash
composer require maxgoryunov/saving-iterator
```

Then include this in your `index.php` or any other main file:

```PHP
require __DIR__ . "./vendor/autoload.php";
```

If you have any questions, ask them at [Discussions](https://github.com/MaxGoryunov/saving-iterator/discussions).

## Decorating Iterators

In order to use `SavingIterator` you need to provide a source and a target. Any object with `Iterator` interface is a suitable source. Target needs to be an `AddingIterator`(usually `ArrayAddingIterator` is enough):

```PHP
$squares = new SavingIterator(
    new SquaringIterator(
        [1, 2, 3, 4, 5, 6]
    ),
    new ArrayAddingIterator()
);
```

If the origin object is not an `Iterator` then wrap it in `TransparentIterator`:

```PHP
$wrapped = new SavingIterator(
    new TransparentIterator($origin),
    new ArrayAddingIterator()
);
```

If you do not want to store nulls in your `AddingIterator` then use `ValidAddingIterator`:

```PHP
$valid = new ValidAddingIterator(
    new ArrayAddingIterator()
);
```

## Decorating Generators

You can also use it with `Generators`. If the iterator is called twice, rewind exception will **not** be thrown.

**Attention**: it is not (currently) possible to pass callable as a parameter. You have to manually invoke `Generator` function:

```PHP
function numerals(): Generator {
    for ($i = 0; $i < 10; $i++) {
        yield $i;
    }
}

$numerals = new SavingIterator(
    numerals(),
    new ArrayAddingIterator()
);
```

## How to contribute

[Fork this repository](https://docs.github.com/en/get-started/quickstart/fork-a-repo), then create a folder for it and install [Composer](https://getcomposer.org/download/) if you do not have it.

Clone this repository:

```git
git clone https://github.com/MaxGoryunov/saving-iterator
```

Then run:

```bash
composer install
```

This command will install all dependencies required for development. Make changes and [open a pull request](https://github.com/MaxGoryunov/saving-iterator/pulls). Your PR will be reviewed and accepted if it does not fail our build.
