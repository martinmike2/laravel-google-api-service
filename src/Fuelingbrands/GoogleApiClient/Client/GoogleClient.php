<?php namespace Fuelingbrands\GoogleApiClient\Client;

use Illuminate\Support\Collection;

/**
 * Class GoogleClient
 * @package Fuelingbrands\GoogleApiClient\Client
 */
class GoogleClient
{
    /**
     * @var
     */
    protected static $instance;
    /**
     * @var Collection
     */
    protected $scopes;

    protected $is_service_account = false;

    /**
     * @param $serviceAccountName
     * @param $private_key
     * @param array|null $scopes
     * @param null $impersonated_email
     */
    public function __construct($name, $private_key, $scopes = null, $impersonated_email = null)
    {
        if(isset($scopes)) {
            $this->scopes = new Collection($scopes);
        } else {
            $this->scopes = new Collection();
        }
        $client = new \Google_Client();

        $this->constructServiceAccountClient($client, $name, $private_key, $impersonated_email);
    }

    private function constructServiceAccountClient($client, $name, $private_key, $impersonated_email = null)
    {
        $credentials = new \Google_Auth_AssertionCredentials(
            $name,
            $this->scopes->toArray(),
            $private_key
        );

        if(isset($impersonated_email)) {
            $credentials->sub = $impersonated_email;
        }

        $client->setAssertionCredentials($credentials);

        $this->client = $client;
        return $client;
    }

    private function constructUserAccountClient($client, $name, $private_key, $redirect_uri) {
        $client->setAuthConfig($private_key);
        $client->addScope($this->scopes->toArray());
        $client->setRedirectUri($redirect_uri);
        return $client;
    }

    /**
     * Retrieve the static instance or create it if its not set
     *
     * @param $private_key
     * @param null $scopes
     * @param null $impersonated_email
     * @return mixed
     */
    public static function getInstance($name, $private_key, $scopes = null, $impersonated_email = null)
    {
        if(is_null(static::$instance)) {
            static::$instance = new static($name, $private_key, $scopes, $impersonated_email);
        }

        self::refreshThisToken();

        return static::$instance;
    }

    /**
     * Add a single scope to the client
     *
     * @param $scope
     */
    public function addScope($scope)
    {
        $client = static::$instance;
        $client->addScope($scope);
        $this->scopes->push($scope);
    }

    /**
     * Add an array of scopes to the client
     *
     * @param array $scopes
     */
    public function addScopes(array $scopes)
    {
        $client = static::$instance;
        $client->addScope($scopes);
        $this->scopes->merge($scopes);
    }

    /**
     *  Refresh the token, if it is expired
     */
    protected static function refreshThisToken()
    {

        if (static::$instance->client->getAuth()->isAccessTokenExpired()) {
            static::$instance->client->getAuth()->refreshTokenWithAssertion();
        }
    }
}