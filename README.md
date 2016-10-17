# Laravel Settings Injector

laravel-settings-injector provides a bootstrapper replacement for the default LoadConfiguration bootstrapper from Laravel.

This allows you to create a directory to manage settings from outside of the application directory with symlinks so that various environment-specific variables can be managed at a systems-level for production and other internal enviroments.

This is probably not useful for many installations of Laravel, however due to recommendations of not using dotenv files for production environment variables this is necessary to obfuscate production variables from the application repository.

## Installation

1. `composer config repositories.laravelsettingsinjector vcs https://github.com/mradcliffe/laravel-settings-injector.git`
1. `composer require mradcliffe/laravel-settings-injector`

## Configuration

1. Modify `app/Http/Kernel.php`.
2. Replace `\Illuminate\Foundation\Bootstrap\LoadConfiguration` with `\Radcliffe\LaravelSettingsInjector\Bootstrap\LoadConfiguration` either by modifying an existing `::$bootstrappers` protected variable or doing so within the `::bootstrappers()` method of that class.

## Usage

1. Create a `settings` directory in app root.
2. Do something at a systems-level to create `settings/settings.php` so that variables are created there.
3. Use those variables as normal in `config/*.php` to configure your application.

See `tests` directory for some example fixtures.
