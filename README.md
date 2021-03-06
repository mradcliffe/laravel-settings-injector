# Laravel Settings Injector

[![Build Status](https://travis-ci.org/mradcliffe/laravel-settings-injector.svg?branch=master)](https://travis-ci.org/mradcliffe/laravel-settings-injector)

laravel-settings-injector provides a bootstrapper replacement for the default LoadConfiguration bootstrapper from Laravel.

This allows you to create a directory to manage settings from outside of the application directory with symlinks so that various environment-specific variables can be managed at a systems-level for production and other internal enviroments.

This is probably not useful for many installations of Laravel, however due to recommendations of not using dotenv files for production environment variables this is necessary to obfuscate production variables from the application repository. The advantage is that the variables are scoped to LoadConfiguration instead of using global environment variables.

## Installation

```bash
composer require mradcliffe/laravel-settings-injector
```

## Configuration

1. Modify `app/Http/Kernel.php`.
2. Replace `\Illuminate\Foundation\Bootstrap\LoadConfiguration` with `\Radcliffe\LaravelSettingsInjector\Bootstrap\LoadConfiguration` either by modifying an existing `::$bootstrappers` protected variable or doing so within the `::bootstrappers()` method of that class.
3. Modify `app/Console/Kernel.php` and add `\Illuminate\Foundation\Console\Kernel::$bootstrappers` protected variables to there, and do the same replacement as in #2 above.

## Usage

See `tests` directory for some example fixtures.

1. Create a `settings` directory in app root.
2. Provision files outside of the webroot, but required somehow by `settings/settings.php`. See image below.
3. Use those variables as normal in `config/*.php` to configure your application.
   * Note that any defines or requires could potentially happen more than once due to the way that Laravel works. Specifically `artisan config:cache` will load configuration after configuration has already been loaded so any use of `define` or `require` within `settings/settings.php` or any file it requires needs to take that into consideratino.


![Example Configuration](docs/example.png?raw=true "Example Configuration")
