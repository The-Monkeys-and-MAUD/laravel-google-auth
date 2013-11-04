<?php namespace Themonkeys\LaravelGoogleAuth;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class GoogleUserProvider implements UserProviderInterface {
    function __construct()
    {
        $this->client = App::make('google-client');
        $this->oauth2 = new \Google_Oauth2Service($this->client);

        if (Session::has($this->getTokenName())) {
            $this->client->setAccessToken(Session::get($this->getTokenName()));

        } else if (isset($_GET['code'])) {

            $this->client->authenticate($_GET['code']);
            Session::put($this->getTokenName(), $this->client->getAccessToken());

            // strip the querystring from the current URL
            $url = rtrim(preg_replace('|&?code=[^&]+|', '', URL::full()), '?');

            header('Location: ' . filter_var($url, FILTER_SANITIZE_URL));
            exit();

        }
    }


    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveById($identifier)
    {
        $user = $this->retrieveByCredentials(array());
        if ($user->getAuthIdentifier() == $identifier) {
            return $user;
        }
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if ($this->client->getAccessToken()) {

            $userinfo = $this->oauth2->userinfo->get();
            return new GenericUser($userinfo);
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\UserInterface $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(UserInterface $user, array $credentials)
    {
        // this method doesn't make sense for Google auth
        return false;
    }

    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }


    /**
     * Get a unique identifier for the auth session value.
     *
     * @return string
     */
    public function getTokenName()
    {
        return 'googleauth_'.md5(get_class($this));
    }

}