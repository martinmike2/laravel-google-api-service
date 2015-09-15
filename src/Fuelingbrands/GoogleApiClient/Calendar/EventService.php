<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

class EventService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->events;
    }

    public function delete($calendar_id, $event_id, $params = [])
    {
        try {
            return $this->getService()->delete($calendar_id, $event_id, $params);
        } catch (\Google_Service_Exception $e)
        {
            \Log::error($e->getMessage());
            return null;
        }
    }

    public function get($calendar_id, $event_id, $params = [])
    {
        try{
            return $this->getService()->get($calendar_id, $event_id, $params);
        }  catch (\Google_Service_Exception $e)
        {
            \Log::error($e->getMessage());
            return null;
        }
    }
}