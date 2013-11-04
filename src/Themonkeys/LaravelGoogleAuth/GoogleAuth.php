<?php namespace Themonkeys\LaravelGoogleAuth;

use Illuminate\Support\Facades\Facade;

class GoogleAuth extends Facade {
    protected static function getFacadeAccessor() { return 'laravel-google-auth'; }
}

