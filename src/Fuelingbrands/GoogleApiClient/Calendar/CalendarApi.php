<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class CalendarApi
{
    use GoogleApiTrait;
    protected $calendar;
    protected $service;

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->calendar = new \Google_Service_Calendar($this->client);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getService()
    {
        if(is_null($this->service)) {
            $this->createService();
        }

        return $this->service;
    }

}