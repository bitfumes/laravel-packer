<p align="center">
  <h1>Laravel Packer</h1>
</p>

<p align="center">

[![GitHub issues](https://img.shields.io/github/issues/bitfumes/laravel-packer.svg)](https://github.com/bitfumes/laravel-packer/issues)
[![Latest Stable Version](https://poser.pugx.org/bitfumes/laravel-packer/v/stable)](https://packagist.org/packages/bitfumes/laravel-packer)
[![Total Downloads](https://poser.pugx.org/bitfumes/laravel-packer/downloads)](https://packagist.org/packages/bitfumes/laravel-packer)
[![GitHub stars](https://img.shields.io/github/stars/bitfumes/laravel-packer.svg)](https://github.com/bitfumes/laravel-packer/stargazers)
[![License](https://poser.pugx.org/bitfumes/laravel-packer/license)](https://packagist.org/packages/bitfumes/laravel-packer)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/bitfumes/laravel-packer.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Fsarthaksavvy%2Flaravel-packer)

</p>

Laravel Packer was created by, and is maintained by [Sarthak](https://github.com/sarthaksavvy), and it is a Command Line Tool which is going to help you in creating package.

-   Built on with [Laravel-zero](http://laravel-zero.com).

## Installation

Install via composer.

Note: For windows user, first run `composer global update`

```bash
composer global require bitfumes/laravel-packer
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

_Now you can create Migrations and Factories also_

## Smart Clone

With `packer clone` command you can do 3 steps in just one.

```bash
packer clone {repositoryname}
```

This not only clone repository but also install composer and if that repository type is project, then it will generate key for project also.

#### Specify directory to clone

Just like git, you can clone repository to any directory, just give `--dir=` option for above command

```bash
packer clone {repositoryname} --dir={custom_directory_name}
```

#### Specify branch to clone

Just like git, you can clone any branch of given repository.

```bash
packer clone {repositoryname} --branch={branch_name}
```

![clone](https://user-images.githubusercontent.com/41295276/46906649-7eec7c80-cf24-11e8-9f18-7dd7fbfe1695.gif)

## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced
software licensed under the [MIT license](http://opensource.org/licenses/MIT)
