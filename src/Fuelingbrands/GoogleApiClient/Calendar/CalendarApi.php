<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class CalendarApi
{
    use GoogleApiTrait;
    protected $calendar;

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->calendar = new \Google_Service_Calendar($this->client);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

}