<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class ChannelService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class ChannelService extends Drive
{

    /**
     * Tell drive what service to use
     *
     * @return \Google_Service_Drive_Channels_Resource
     */
    protected function createService()
    {
        return $this->drive->channels;
    }

    /**
     * Stop watching a file for changes
     *
     * @param $channel_id
     * @param $resource_id
     * @return mixed
     */
    public function stop($channel_id, $resource_id)
    {
        $channel = new \Google_Service_Drive_Channel();
        $channel->setId($channel_id);
        $channel->setResourceId($resource_id);

        return $this->getService()->stop($channel);
    }

    /**
     * Not used in this implementation
     *
     * @param null $id
     * @param array $params
     */
    protected function listAll($id = null, $params = []) {}

}