Styler
======

CSS Styler package for Laravel.
Compiles Less/SCSS on the fly and supports serving cached content.

I wrote this particular package because I wanted something stupidly simple, and didn't want to 'watch' directories while I'm coding. Just recompile if the css has changed thanks.

### Installing

To grab via composer, just add `darren-nolan/styler` on `dev-master` to your required packages.

    "require": {
        "darren-nolan/styler": "0.0.2"
    }

### Features

* SCSS and Less Compiling (Thanks to Leafo's [SCSS](https://github.com/leafo/scssphp) and [Less](https://github.com/leafo/lessphp) compilers.)
* Raw CSS
* Automatically switch between compilers based on file extension
* Adjustable route to deliver the CSS

### Setup

Firstly add the ServiceProvider to your `app.php` configuration

    'DarrenNolan\Styler\StylerServiceProvider',

Push the configuration into your application and edit as required (under app/config/packages/darren-nolan/styler/config.php)

    php artisan config:publish darren-nolan/styler

`base_route` defines the listening base URL. By default `<your-app>/styler/*.(css|less|scss)` is where you link for compiled styles.

`compiler` defines the compiler/driver to use to compile stylesheets with. By default `auto` will check against the file's extension and compile accordingly.

Compiler options

`serve_from` defines where this compiler should look for it's source files. By default `app_path() . '/css'` is used.

`cache_folder` defines where this compiler should store it's cached versions (if any). This folder should be created before use.  Can be set to `false` to disable.

Special Compiler Options

`less` has `format_option` which is what the output should be compiled as. `'lessjs'`, `'compressed'`, `'classic'` and `null` are valid. Check [documentation](http://leafo.net/lessphp/docs/#output_formatting)

`scss` has `format_option` which is what the output should be compiled as. `'scss_formatter'`, `'scss_formatter_nested'`, and `'scss_formatter_compressed'` are valid. Check [documentation](http://leafo.net/scssphp/docs/#output_formatting)

The configuration file is fairly self explanatory. However hang on for some better documentation.

### Coming at some point

* Tests. Because tests are important.
* Each compiler is handed it's driver configuration in an array, however `auto` needs to get SCSS/LESS configuration too, so this will be adjusted so that a driver gets access to all configuration.
* Code cleanup. Because I've been at a buck's all weekend and in my current capacity, I'm sure this is messy as hell.

### License

Styler is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT)
