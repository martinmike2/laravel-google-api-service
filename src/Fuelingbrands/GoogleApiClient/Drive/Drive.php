<?php namespace Fuelingbrands\GoogleApiClient\Drive;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class Drive
{
    use GoogleApiTrait;
    protected $drive;

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->drive = new \Google_Service_Drive($this->client->client);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

    abstract protected function listAll($id = null, $params = []);
}