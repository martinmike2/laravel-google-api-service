<?php namespace Fuelingbrands\GoogleApiClient\Client;

use Fuelingbrands\GoogleApiClient\Cache\LaravelCache;
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

    protected $name;

    private $private_key;

    protected $impersonated_email;

    protected $is_service_account = false;

    public $client;

    /**
     * @param $serviceAccountName
     * @param $private_key
     * @param array|null $scopes
     * @param null $impersonated_email
     */
    public function __construct($name, $private_key, $scopes = null, $impersonated_email = null)
    {
        $this->name = $name;
        $this->private_key = $private_key;
        $this->impersonated_email = $impersonated_email;

        if(isset($scopes)) {
            $this->scopes = new Collection($scopes);
        } else {
            $this->scopes = new Collection();
        }
        $client = new \Google_Client();
        $client->setCache(new LaravelCache($client));

        $this->constructServiceAccountClient($client);
    }

    private function constructServiceAccountClient($client)
    {

        $client->setAssertionCredentials($this->getNewCredentials());

        $this->client = $client;
        return $client;
    }

    public function reauthenticate()
    {
        $this->client->revokeToken();
        $this->client->setAssertionCredentials($this->getNewCredentials());
        $this->client->getAuth()->refreshTokenWithAssertion();
    }

    private function getNewCredentials()
    {
        $credentials = new \Google_Auth_AssertionCredentials(
            $this->name,
            $this->scopes->toArray(),
            $this->private_key
        );

        if(isset($this->impersonated_email)) {
            $credentials->sub = $this->impersonated_email;
        }

        return $credentials;
    }

    public function getAuth()
    {
        return $this->client->getAuth();
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
        $this->scopes->push($scope);
        $this->client->addScope($scope);
        $this->reauthenticate();
    }

    /**
     * Add an array of scopes to the client
     *
     * @param array $scopes
     */
    public function addScopes(array $scopes)
    {
        $this->scopes->merge($scopes);
        $this->client->addScope($scopes);
        $this->reauthenticate();
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