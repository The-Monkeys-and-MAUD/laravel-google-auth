<?php

namespace Themonkeys\LaravelGoogleAuth;


use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class GoogleAuthGuard extends Guard {
    public function user()
    {
        $user = parent::user();
        if (is_null($user)) {
            return $this->user = $this->provider->retrieveByCredentials(array());
        }
        return $user;
    }

    public function logout()
    {
        Session::forget($this->provider->getTokenName());
        App::make('google-client')->revokeToken();
        parent::logout();
    }


}