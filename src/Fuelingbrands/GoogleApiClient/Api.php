<?php namespace Fuelingbrands\GoogleApiClient;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class Api
{

    public $client;

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;


        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->drive = new \Google_Service_Drive($this->client->client);
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