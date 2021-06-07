# CKeditor with Elfinder for Laravel

## About

This is a solution to integrate a content editor into your project with a built-in file manager (using CKeditor in combination with Elfinder)


## Features

* Use CKeditor to create a content editor
* Integrated Elfinder for image management
* Generate multiple sizes (thumbnail, medium, original) every time you upload an image file. (similar to wordpress)
* Upload files and integrate with Amazon S3

## Installation

Require the `ktran/ckeditor-elfinder` package in your `composer.json` and update your dependencies:
```sh
composer require ktran/ckeditor-elfinder
```

## Configuration

The defaults are set in `config/ckeditor_elfinder.php`. Publish the config to copy the file to your own config:
```sh
php artisan vendor:publish --provider="Ktran\ckeditor-elfinder\CEServiceProvider"
```

## Reference

This package is customized from CKeditor library [https://ckeditor.com/] and Elfinder Laravel package [https://github.com/barryvdh/laravel-elfinder]

## Document

Contributing...

## Author

> Kevin Tran [<tranthai@enjoyworks.co.kr>] [www.ktranblog.com]