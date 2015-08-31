<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

class CalendarListService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->calendarList;
    }
}