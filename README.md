![The Monkeys](http://www.themonkeys.com.au/img/monkey_logo.png)

Laravel Google Authentication Driver
====================================

Allows you to use Google to authenticate users of your Laravel application.


Installation
------------
To get the latest version of cachebuster simply require it in your composer.json file.

> **Note**: This package depends on a non-packagist package, google-api-php-client, so you will need to manually add
  the following repository definition to your project's `composer.json` file before attempting to run `composer update`
  or `composer install`:


```json
	"repositories": [
		{
      "type": "package",
      "package": {
        "name": "google/google-api-php-client",
        "version": "0.6.7",
        "dist": {
          "url": "http://google-api-php-client.googlecode.com/files/google-api-php-client-0.6.7.tar.gz",
          "type": "tar"
        },
        "autoload": {
          "classmap": ["src/"]
        }
      }
		}
	],
```

```bash
composer require themonkeys/laravel-google-auth:dev-master --no-update
composer update themonkeys/laravel-google-auth
```

Once the package is installed you need to register the service provider with the application. Open up
`app/config/app.php` and find the `providers` key.

Delete the line for the AuthServiceProvider:

```php
'providers' => array(
		'Illuminate\Auth\AuthServiceProvider',
)
```

and replace it with:

```php
'providers' => array(
    'Themonkeys\LaravelGoogleAuth\LaravelGoogleAuthServiceProvider',
)
```

To configure the package, you can use the following command to copy the configuration file to
`app/config/packages/themonkeys/laravel-google-auth`.

```sh
php artisan config:publish themonkeys/laravel-google-auth
```

Or you can just create a new file in that folder and only override the settings you need.

The settings themselves are documented inside `config.php`.

To make your configuration apply only to a particular environment, put your configuration in an environment folder such
as `app/config/packages/themonkeys/laravel-google-auth/environment-name/config.php`.

Usage
-----

To enable Google-based authentication for your app, you first need to select the 'google' authentication driver. Open
up `app/config/auth.php` and edit the `driver` key:

```php
return array(
	'driver' => 'google',
);
```

For Google authentication, you need to add a Login page to your app which contains a link for the user to click on that
will initiate the authentication process. The simplest way of doing that is to add the following to your `routes.php`
file:

```php
Route::get('/login', function() {
    return View::make('login', array(
      'authUrl' => Auth::getAuthUrl()
    ));
});
```

> **Note**: the getAuthUrl() is not present in other authentication drivers, so the above code will throw an error with
  other drivers.

Then use `{{ $authUrl }}` as the `href` for a link in your `login.blade.php` view:

```php
<a class='login' href='{{ $authUrl }}'>Connect Me!</a>
```

Then you need to add the `'before'` filter `'google-finish-authentication'` to the route that google redirects to after
authentication is complete. Make sure this filter is applied first, before the `'auth'` filter - otherwise the `'auth'`
filter will send the user back to the login page and their session will be lost.

```php
Route::group(array('before' => array('google-finish-authentication', 'auth')), function() {
    Route::get('/', 'HomeController@showWelcome');
});
```

Adding a logout facility to your app is the same as with any other authentication driver - just add the following to
your `routes.php`, then add a link to the URI `/logout` wherever you need it:

```php
Route::get('/logout', function() {
    Auth::logout();
    return Redirect::to('/');
});
```

All information available in the `Google_Userinfo` object is available via the user object returned from `Auth::user()`,
for example `Auth::user()->name`:

```php
    <table>
        <tr>
            <th>Your ID:</th><td>{{ Auth::user()->id }}</td>
        </tr>
        <tr>
            <th>Your Full Name:</th><td>{{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <th>Your Given Name:</th><td>{{ Auth::user()->given_name }}</td>
        </tr>
        <tr>
            <th>Your Family Name:</th><td>{{ Auth::user()->family_name }}</td>
        </tr>
        <tr>
            <th>Your Email Address:</th><td>{{ Auth::user()->email }}</td>
        </tr>
        <tr>
            <td></td>
            <td>Your Email Address has
                @if (Auth::user()->verified_email)
                been <strong>verified</strong>
                @else
                <strong>not</strong> been verified
                @endif
            </td>
        </tr>
        <tr>
            <th>Your hosted domain:</th><td>{{ Auth::user()->hd }}</td>
        </tr>
        <tr>
            <th>Your Locale:</th><td>{{ Auth::user()->locale }}</td>
        </tr>
    </table>
```

Contribute
----------

In lieu of a formal styleguide, take care to maintain the existing coding style.

License
-------

MIT License
(c) [The Monkeys](http://www.themonkeys.com.au/)
