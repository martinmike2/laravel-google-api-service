<?php namespace Fuelingbrands\GoogleApiClient\Drive;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;

abstract class Drive
{
    protected $client;
    protected $service;
    protected $drive;
    protected $private_key;
    protected $scopes;
    protected $impersonated_email;


    public function __construct($private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($private_key, $scopes, $impersonated_email);
        $this->drive = new \Google_Service_Drive($this->client);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
    }

    public function getService(){
        if (is_null($this->service)) {
            $this->createService();
        }

        return $this->service;
    }

    abstract protected function createService();
    abstract protected function listAll($id = null, $params = []);
}