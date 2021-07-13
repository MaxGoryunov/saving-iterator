[![EO principles respected here](https://www.elegantobjects.org/badge.svg)](https://www.elegantobjects.org)

![PHP-Composer-Build](https://github.com/MaxGoryunov/saving-iterator/actions/workflows/php.yml/badge.svg)
[![Latest Stable Version](http://poser.pugx.org/maxgoryunov/saving-iterator/v)](https://packagist.org/packages/maxgoryunov/saving-iterator)
[![Maintainability](https://api.codeclimate.com/v1/badges/d721a5fca4901010520e/maintainability)](https://codeclimate.com/github/MaxGoryunov/saving-iterator/maintainability)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MaxGoryunov/saving-iterator/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/MaxGoryunov/saving-iterator/?branch=main)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://github.com/MaxGoryunov/saving-iterator/blob/main/LICENSE)

[![Hits-of-Code](https://hitsofcode.com/github/MaxGoryunov/saving-iterator?branch=main)](https://hitsofcode.com/github/MaxGoryunov/saving-iterator/view)
![Lines-of-Code](https://tokei.rs/b1/github/MaxGoryunov/saving-iterator?branch=main)

**Saving Iterator** is a true caching iterator for PHP. It aims to solve the same problems as PHP's [Caching Iterator](https://www.php.net/manual/ru/class.cachingiterator.php) but with a [better encapsulation of data](https://www.yegor256.com/2016/11/21/naked-data.html) in mind. It has properties of both `Iterator` and `array`.

## How to use

Require it with Composer:

```bash
composer require maxgoryunov/saving-iterator
```

Then include this in your `index.php` or any other main file:

```PHP
require __DIR__ . "./vendor/autoload.php";
```

If you have any questions, ask them at [Discussions](https://github.com/MaxGoryunov/saving-iterator/discussions).

## Decorating Iterators

Any object with `Iterator` interface is suitable:

```PHP
$squares = new SavingIterator(
    new SquaringIterator(
        [1, 2, 3, 4, 5, 6]
    )
);
```

If the origin object is not an `Iterator` then wrap it in `TransparentIterator`:

```PHP
$wrapped = new SavingIterator(
    new TransparentIterator($origin)
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

$numerals = new SavingIterator(numerals());
```

## How to contribute

Fork this repository, then create a folder for it and install [Composer](https://getcomposer.org/download/) if you do not have it.

Clone this repository:

```git
git clone https://github.com/MaxGoryunov/saving-iterator
```

Then run:

```bash
composer install
```

This command will install all dependencies required for development. Make changes and open a pull request. Your PR will be reviewed and accepted if it does not fail our build.
