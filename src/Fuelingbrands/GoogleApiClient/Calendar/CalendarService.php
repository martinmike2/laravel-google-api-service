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
    public function clear($calendar_id)
    {
        try {
            return $this->getService()->clear($calendar_id);
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
    public function delete($calendar_id)
    {
        try {
            $this->getService()->delete($calendar_id);
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
    public function get($calendar_id)
    {
        try {
            return $this->getService()->get($calendar_id);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

}