<?php namespace Fuelingbrands\GoogleApiClient;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;

abstract class Api
{

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * Return the service required for the api
     *
     * @return mixed
     */
    abstract public function getService();

    /**
     * Return the base resource required by the service
     *
     * @return mixed
     */
    abstract public function getResource();
}