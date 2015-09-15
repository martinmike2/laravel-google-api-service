<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

/**
 * Class ChannelService
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
class ChannelService extends CalendarApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->calendar->channels;
    }

    /**
     * Stop watching a channel
     *
     * @param \Google_Service_Calendar_Channel $channel
     * @param array $params
     * @return null
     */
    public function stop(\Google_Service_Calendar_Channel $channel, $params = [])
    {
        try {
            return $this->getService()->stop($channel, $params);
        } catch (\Google_Service_Exception $e)
        {
            \Log::error($e->getMessage());
            return null;
        }
    }
}