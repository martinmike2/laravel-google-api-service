<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

/**
 * Class CalendarListService
 *
 * A Service for interacting with the individual
 * calendar entries for a single calendar
 *
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
class CalendarListService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return \Google_Service_Calendar_CalendarList
     */
    protected function createService()
    {
        return $this->calendar->calendarList;
    }

    /**
     * Delete an entry from a calendar
     *
     * @param string $calendar_id
     * @return bool
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
     * Retrieve a specific entry from the calendar
     *
     * @param string $calendar_id
     * @return \Google_Service_Calendar_CalendarListEntry|null
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

    /**
     * Insert a calendar entry into a specific calendar
     *
     * @param string $calendar_id
     * @return \Google_Service_Calendar_CalendarListEntry|null
     */
    public function insert($calendar_id)
    {
        $calendar_list_entry = new \Google_Service_Calendar_CalendarListEntry();
        $calendar_list_entry->setId($calendar_id);

        try {
            return $this->getService()->insert($calendar_list_entry);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }

    }

    /**
     * Retrieve all entries from users calendar list
     *
     * @return \Google_Service_Calendar_CalendarList|array
     */
    public function listCalendarList()
    {
        try {
            return $this->getService()->listCalendarList();
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return [];
        }
    }

    /**
     * Update an entry on the calendar list
     * (Supports PATCH semantics)
     *
     * @param $calendar_id
     * @param $entry
     * @param array $params
     * @return null
     */
    public function patch($calendar_id, $entry, $params = [])
    {
        try {
            return $this->getService()->patch($calendar_id, $entry, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Update and entry on the calendar list
     * (Does NOT support PATCH semantics)
     *
     * @param $calendar_id
     * @param $entry
     * @param array $params
     * @return null
     */
    public function update($calendar_id, $entry, $params = [])
    {
        try {
            return $this->getService()->update($calendar_id, $entry, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Watch for changes to a calendar list
     *
     * @param \Google_Service_Calendar_Channel $channel
     * @param array $params
     * @return \Google_Service_Calendar_Channel|null
     */
    public function watch(\Google_Service_Calendar_Channel $channel, $params = [])
    {
        try {
            return $this->getService()->watch($channel, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }
}