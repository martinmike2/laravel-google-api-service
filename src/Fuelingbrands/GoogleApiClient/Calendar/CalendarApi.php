<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Fuelingbrands\GoogleApiClient\Api;
use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

/**
 * Class CalendarApi
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
abstract class CalendarApi
{
    use GoogleApiTrait;

    /**
     *
     */
    const CALENDAR_FULL_SCOPE = 'https://www.googleapis.com/auth/calendar';
    /**
     *
     */
    const CALENDAR_READONLY_SCOPE = 'https://www.googleapis.com/auth/calendar.readonly';

    /**
     * @var
     */
    protected $calendar;
    /**
     * @var
     */
    protected $service;


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
    public function getService()
    {
        if(is_null($this->service)) {
            $this->createService();
        }

        return $this->service;
    }

    /**
     * Return the base resource required by the service
     *
     * @return mixed
     */
    public function getResource()
    {
        return new \Google_Service_Calendar_Calendar;
    }

}