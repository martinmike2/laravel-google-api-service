<?php namespace Fuelingbrands\GoogleApiClient;

/**
 * Class GoogleApiTrait
 * @package Fuelingbrands\GoogleApiClient
 */
trait GoogleApiTrait
{
    /**
     * @var
     */
    protected $client;
    /**
     * @var
     */
    protected $service;
    /**
     * @var
     */
    protected $private_key;
    /**
     * @var
     */
    protected $impersonated_email;
    /**
     * @var
     */
    protected $email;
    /**
     * @var
     */
    protected $scopes;


    /**
     * @return mixed
     */
    public function getService(){
        if (is_null($this->service)) {
            $this->service = $this->createService();
        }

        return $this->service;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    abstract protected function createService();
}