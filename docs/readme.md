---
home: true
heroText: Laravel Packer
description: A Command Line Tool which is going to help you in creating package and making CRUD with tests in laravel.
actionText: Get Started
actionLink: /installation
sidebar: true
features:
  - title: Artisan Command for Package
    details: You can use all artisan commands while creating laravel package.
  - title: CRUD Generator
    details: Packr is usefull to create CRUD for any model with tests in laravel.
  - title: Smart Clone
    details: Reduce 4 steps to clone laravel repo into 1 by using smart clone.
    footer: MIT Licensed | Copyright © 2020 Bitfumes
---

# Quick start

Note: For windows user, first run `composer global update`

```bash{2,5}
# First, install:
composer global require bitfumes/laravel-packer

# Then, use it just like you use artisan commands:
packr make:model Student -mfc
```
