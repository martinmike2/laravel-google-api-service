<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

/**
 * Class CalendarService
 *
 * A collection of existing calendars
 *
 * Can be used to access and modify those calendar properties
 * which are visible and shared across all users with access
 * to calendar.
 *
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
class CalendarService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return \Google_Service_Calendar_Calendars_Resource
     */
    protected function createService()
    {
        return $this->calendar->calendars;
    }

    /**
     * Clears the primary calendar.
     *
     * Deleted all events associated with
     * the primary calendar of an account
     *
     * @param string $calendar_id
     * @return \Google_Service_Calendar_Calendar|null
     */
    public function clear($calendar_id, $params = [])
    {
        try {
            return $this->getService()->clear($calendar_id, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Delete a secondary calendar.
     *
     * @param string $calendar_id
     * @return boolean
     */
    public function delete($calendar_id, $params = [])
    {
        try {
            $this->getService()->delete($calendar_id, $params);
            return true;
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * Returns metadata for a calendar
     *
     * @param string $calendar_id
     * @return \Google_Service_Calendar_Calendar|null
     */
    public function get($calendar_id, $params = [])
    {
        try {
            return $this->getService()->get($calendar_id, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Creates a secondary calendar
     *
     * @param string $title
     * @param string null $description
     * @param string null $location
     * @param string null $timezone
     *
     * @return \Google_Service_Calendar_Calendar|null
     */
    public function insert($title, $description = null, $location = null, $timezone = null, $params = [])
    {
        try {
            $calendar = $this->getResource();
            $calendar->setSummary($title);
            $calendar->setDescription($description);
            $calendar->setLocation($location);
            $calendar->setTimeZone($timezone);

            return $this->getService()->insert($calendar, $params);

        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Updates the metadata for a calendar (Supports PATCH semantics)
     * @param $calendar_id
     * @param \Google_Service_Calendar_Calendar $calendar
     * @return \Google_Service_Calendar_Calendar|null
     */
    public function patch($calendar_id, \Google_Service_Calendar_Calendar $calendar, $params = [])
    {
        try {
            return $this->getService()->patch($calendar_id, $calendar, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Updates metadata for a calendar (Does NOT support PATCH semantics)
     * @param $calendar_id
     * @param \Google_Service_Calendar_Calendar $calendar
     * @return \Google_Service_Calendar_Calendar|null
     */
    public function update($calendar_id, \Google_Service_Calendar_Calendar $calendar, $params = [])
    {
        try {
            return $this->getService()->update($calendar_id, $calendar, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    public function getResource()
    {
        return new \Google_Service_Calendar_Calendar();
    }
}