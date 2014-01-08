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
    | The default, URL::to('/'), will usually suffice - redirects the user to
    | your home page after a successful login
    |
    */
    'redirectUri' => URL::to('/') . '/', // URL:to('/') doesn't include the trailing slash

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
    
    /*
    |--------------------------------------------------------------------------
    | Google services
    |--------------------------------------------------------------------------
    */
    'services' => null,
    
    /*
    |--------------------------------------------------------------------------
    | Google scopes
    |--------------------------------------------------------------------------
    */
    'scopes' => null,
    
    /*
    |--------------------------------------------------------------------------
    | Google OAuth2Service access_type
    |--------------------------------------------------------------------------
    */
    'access_type' => null,

);
