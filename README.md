<p align="center">
  <h1>Laravel Packer</h1>
</p>

<p align="center">

[![GitHub issues](https://img.shields.io/github/issues/sarthaksavvy/laravel-packer.svg)](https://github.com/sarthaksavvy/laravel-packer/issues)
[![Total Downloads](https://poser.pugx.org/bitfumes/laravel-packer/downloads)](https://packagist.org/packages/bitfumes/laravel-packer)
[![GitHub forks](https://img.shields.io/github/forks/sarthaksavvy/laravel-packer.svg)](https://github.com/sarthaksavvy/laravel-packer/network)
[![GitHub stars](https://img.shields.io/github/stars/sarthaksavvy/laravel-packer.svg)](https://github.com/sarthaksavvy/laravel-packer/stargazers)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/sarthaksavvy/laravel-packer.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Fsarthaksavvy%2Flaravel-packer)

</p>

Laravel Packer was created by, and is maintained by [Sarthak Shrivastava](https://github.com/sarthaksavvy), and it is a Command Line Tool which is going to help you in creating package.

-   Built on with [Laravel-zero](http://laravel-zero.com).

## Installation

Install via composer.

```bash
composer global require bitfumes/laravel-packer --prefer-dist
```

## Creating new Package Scaffolding

```bash
packer new your-package-name {vendor} {author} {author_email}
```

![new](https://user-images.githubusercontent.com/41295276/46673797-38331580-cbf8-11e8-88e6-5d6b0dc18b93.gif)

With the above command it will create package scaffoldig for you.

Optional fields like 'vendor', 'author' and 'author_email' can also be given via command line interface if you are not willing to provide on command.

## Same as Artisan commands

With this CLI, you will have access to all artisan commands you are familier on Laravel.

You can create controller just like you do with `php artisan`

```bash
packer make:controller controller_name
```

![make](https://user-images.githubusercontent.com/41295276/46673800-38cbac00-cbf8-11e8-9a1b-c02e91da8563.gif)

Explore all commands, just run `packer` on your command line.
