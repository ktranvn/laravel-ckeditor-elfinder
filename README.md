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
php artisan vendor:publish --provider="Ktran\CE\CEServiceProvider"
```

## Reference

This package is customized from CKeditor library [https://ckeditor.com/] and Elfinder Laravel package [https://github.com/barryvdh/laravel-elfinder]

## How to use

1. Add the script and style to the blade view where you want to display the editor
```html
@include("ce::scripts")
@include("ce::styles")
```
2. Create a textarea element to use as an RTE
```html
<textarea id="editor" name="content"></textarea>
```
3. Add script config ckeditor
```html
<script>
    if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
        CKEDITOR.tools.enableHtml5Elements( document );

    CKEDITOR.config.height = 150;
    CKEDITOR.config.width = 'auto';
    CKEDITOR.config.filebrowserBrowseUrl = '/file-manager/ckeditor';

    var initSample = ( function() {
        var wysiwygareaAvailable = isWysiwygareaAvailable(),
            isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );

        return function() {
            var editorElement = CKEDITOR.document.getById( 'editor' );

            if ( wysiwygareaAvailable ) {
                CKEDITOR.replace( 'editor' );
            } else {
                editorElement.setAttribute( 'contenteditable', 'true' );
                CKEDITOR.inline( 'editor' );
            }
        };

        function isWysiwygareaAvailable() {
            if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
                return true;
            }
            return !!CKEDITOR.plugins.get( 'wysiwygarea' );
        }
    } )();

    initSample();
</script>
```

4. enjoy your result

## Author

> Kevin Tran [<tranthai@enjoyworks.co.kr>] [www.ktranblog.com]
