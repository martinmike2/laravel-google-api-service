<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

use Fuelingbrands\GoogleApiClient\Api;
use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

/**
 * Class CalendarApi
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
abstract class CalendarApi extends Api
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


    /**
     * @param $email
     * @param $private_key
     * @param array $scopes
     * @param $impersonated_email
     */
    public function __construct($email, $private_key, array $scopes, $impersonated_email)
    {
        $this->calendar = new \Google_Service_Calendar($this->client);
        parent::__construct($email, $private_key, $scopes, $impersonated_email);
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