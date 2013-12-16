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

    public function getAuthUrl()
    {
        return $this->provider->getAuthUrl();
    }

    /**
     * If this request is the redirect from a successful authorization grant, store the access token in the session
     * and return a Laravel redirect Response to send the user to their requested page. Otherwise returns null
     * @return Response or null
     */
    public function finishAuthenticationIfRequired()
    {
        return $this->provider->finishAuthenticationIfRequired();
    }
}