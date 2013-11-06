<?php
return array(
    /*
    |--------------------------------------------------------------------------
    | Google oauth2_client_id
    |--------------------------------------------------------------------------
    |
    | Visit https://code.google.com/apis/console?api=plus to generate your
    | oauth2_client_id, oauth2_client_secret, and to register your
    | oauth2_redirect_uri.
    |
    | Should be '*.apps.googleusercontent.com'
    |
    */
    'clientId' => null,

    /*
    |--------------------------------------------------------------------------
    | Google oauth2_client_secret
    |--------------------------------------------------------------------------
    */
    'clientSecret' => null,

    /*
    |--------------------------------------------------------------------------
    | Google oauth2_redirect_uri
    |--------------------------------------------------------------------------
    |
    | Default URI to redirect the user to after a successful login. If the
    | user attempted to access a secured URL and was redirected to the login
    | page, they'll be redirected to their original intended URL and this
    | setting will be ignored. This setting is only used when the user visited
    | the login page directly.
    |
    | The default, URL::to('/'), will usually suffice - redirects the user to
    | your home page after a successful login
    |
    */
    'redirectUri' => URL::to('/'),

    /*
    |--------------------------------------------------------------------------
    | Google Developer Key
    |--------------------------------------------------------------------------
    */
    'developerKey' => null,

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | The Application Name to register with the Google API.
    |
    */
    'applicationName' => null,

);