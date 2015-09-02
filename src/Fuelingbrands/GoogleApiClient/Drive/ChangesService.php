<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class ChangesService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class ChangesService extends Drive
{

    /**
     * Tell the drive waht service to use
     * @return \Google_Service_Drive_Changes_Resource
     */
    protected function createService()
    {
        return $this->drive->changes;
    }

    /**
     * List all changes to a file
     *
     * @param null $id
     * @param array $params
     * @return array
     */
    public function listAll($id = null, $params = [])
    {
        $result = [];
        $pageToken = null;

        do {
            try {
                $parameters = [];

                if ($id) {
                    $parameters['startChangeId'] = $id;
                }
                if ($pageToken) {
                    $parameters['pageToken'] = $pageToken;
                }

                $params = array_merge($parameters, $params);

                $changes = $this->getService()->listChanges($params);
                $result = array_merge($result, $changes->getItems());
                $pageToken = $changes->getNextPageToken();
            } catch (\Exception $e) {
                $pageToken = null;
            }
        } while ($pageToken);

        return $result;
    }

    /**
     * Get a specific change
     *
     * @param $change_id
     * @return mixed
     */
    public function get($change_id) {
        return $this->getService()->get($change_id);
    }

    /**
     * Watch a change for changes
     *
     * @param $channel_id
     * @param array $params
     * @return mixed
     */
    public function watch($channel_id, $params = [])
    {
        $channel_resource = new ChannelResource($this->email, $this->private_key, $this->scopes, $this->impersonated_email);

        return $this->getService()->watch($channel_resource->get($channel_id), $params);
    }
}