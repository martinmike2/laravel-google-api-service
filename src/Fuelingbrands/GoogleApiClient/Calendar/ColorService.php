<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

class ColorService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->colors;
    }

    public function get($params = [])
    {
        try {
            return $this->getService()->get($params);
        } catch (\Google_Service_Exception $e)
        {
            \Log::error($e->getMessage());
            return null;
        }
    }
}