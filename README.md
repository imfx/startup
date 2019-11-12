# Startup

## Installation

### Requirements

* Composer
* Laravel Framework 5.8+
* Node.js & NPM

### Installing Startup

Run the following command in your console terminal:

```bash
$ composer require imfx/startup
```

Or if you want to download the files, add the following configuration to the composer.json file:

```json
    "repositories": [
        {
            "type": "path",
            "url": "../startup"
        }
    ],
```

or if you are symlinking the package locally:

```bash
$ ln -s ../startup startup
```

```json

    "repositories": [
        {
            "type": "path",
            "url": "../startup",
            "options": {
                "symlink": true
            }
        }
    ],
```

Next, add the package to the require section of your composer.json file:

```json
"require": {
    "php": "^7.2",
    "fideloper/proxy": "^4.0",
    "laravel/framework": "5.8.*",
    "laravel/tinker": "^1.0",
    "imfx/startup": "*"
},
```

Now run `composer update` command:

```bash
$ composer update
```

### Database Credentials

Next make sure to create a new database and add your database credentials to your `.env` file:

```ruby
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### Run the installer

Finally, run the install command and migrate Artisan commands.

```bash
$ php artisan startup:install

$ php artisan migrate
```

## Security

If you discover any security related issues, please use the issue tracker.

## Credits

- [Felix Ayala](http://felixaya.la)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
