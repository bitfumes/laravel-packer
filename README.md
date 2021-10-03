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

- Built on with [Laravel-zero](http://laravel-zero.com).
- Detailed tutorials found on [Youtube playlist](https://www.youtube.com/playlist?list=PLe30vg_FG4OR9xvBpNW-SkK3T1IiLVM98)

## Features

- [Features](#features)
- [Installation](#installation)
- [Creating new Package Scaffolding](#creating-new-package-scaffolding)
- [Same as Artisan commands](#same-as-artisan-commands)
- [Smart Clone](#smart-clone)
    - [Specify directory to clone](#specify-directory-to-clone)
    - [Specify branch to clone](#specify-branch-to-clone)
- [CRUD Generator](#crud-generator)
  - [step 1](#step-1)
  - [step 2](#step-2)
  - [Todo](#todo)
- [License](#license)

## Installation

Install via composer.

Note: For windows user, first run `composer global update`

```bash
composer global require bitfumes/laravel-packer
```

## Creating new Package Scaffolding

```bash
packr new your-package-name {vendor} {author} {author_email}
```

![new](https://user-images.githubusercontent.com/41295276/46673797-38331580-cbf8-11e8-88e6-5d6b0dc18b93.gif)

With the above command it will create package scaffolding for you.

Optional fields like 'vendor', 'author' and 'author_email' can also be given via command line interface if you are not willing to provide on command.

## Same as Artisan commands

With this CLI, you will have access to all artisan commands you are familiar on Laravel.

You can create controller just like you do with `php artisan`

```bash
packr make:controller controller_name
```

![make](https://user-images.githubusercontent.com/41295276/46673800-38cbac00-cbf8-11e8-9a1b-c02e91da8563.gif)

Explore all commands, just run `packr` on your command line.

_Now you can create Migrations and Factories also_

## Smart Clone

With `packr clone` command you can do 3 steps in just one.

```bash
packr clone {repositoryname}
```

This not only clone repository but also install composer and if that repository type is project, then it will generate key for project also.

#### Specify directory to clone

Just like git, you can clone repository to any directory, just give `--dir=` option for above command

```bash
packr clone {repositoryname} --dir={custom_directory_name}
```

#### Specify branch to clone

Just like git, you can clone any branch of given repository.

```bash
packr clone {repositoryname} --branch={branch_name}
```

Above command will create various files like

- Model with relationships
- Controller with all crud functions
- Routes based on web or api file
- factory
- migration
- unit test (if relationship is described in json)
- Feature test for all crud part

This not only clone repository but also install composer and if that repository type is project, then it will generate key for project also.

![clone](https://user-images.githubusercontent.com/41295276/46906649-7eec7c80-cf24-11e8-9f18-7dd7fbfe1695.gif)

## CRUD Generator

With `packr crud` command you can create crud for laravel appication with fully green tests

### step 1

First we need to create a json structure for our migration of any model/table
To do so run this command

```bash
packr crud:json {exactModelName}
```

### step 2

Now you have json file, you can describe how your migration/schema is going to look.
After giving all details you can now run command to actually create full crud for the model

```bash
packr crud:make {relativePathOfThatJsonFile}
```

### Todo
- [ ] Add resource in controller for CRUD maker
- [ ] Add form request in controller for CRUD maker

## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced
software licensed under the [MIT license](http://opensource.org/licenses/MIT)
