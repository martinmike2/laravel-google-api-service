<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class ParentService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class ParentService extends Drive
{
    /**
     * Tell the drive what service to use
     *
     * @return \Google_Service_Drive_Parents_Resource
     */
    protected function createService()
    {
        return $this->drive->parents;
    }

    /**
     * List all parents of a file
     *
     * @param $child_id
     * @return mixed
     */
    protected function listAll($child_id = null, $params = [])
    {
        if(is_null($child_id)) {
            return null;
        }

        return $this->getService()->listParents($child_id, $params);
    }

    /**
     * Insert a parent reference into a file
     *
     * @param $resource
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function insert($resource, $child_id, $params = [])
    {
        if (is_string($resource)) {
            $resource = $this->get($resource, $child_id)->getId();
        }

        $parent_ref = new \Google_Service_Drive_ParentReference();
        $parent_ref->setId($resource);

        return $this->getService()->insert($child_id, $parent_ref, $params);
    }

    /**
     * Remove a parent reference from a file
     *
     * @param $resource
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function delete($resource, $child_id, $params = [])
    {
        if (is_string($resource)) {
            $resource = $this->get($resource, $child_id)->getId();
        }

        return $this->getService()->delete($child_id, $resource, $params);
    }

    /**
     * Check if a file belongs to the parent
     *
     * @param $resource
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function get($resource, $child_id, $params = [])
    {
        if(is_int($resource)) {
            return $this->getService()->get($child_id, $resource, $params);
        } elseif (is_string($resource)) {
            $query = [
                'q' => "Title = '".$resource."'"
            ];

            $params = array_merge($params, $query);

            return $this->getService()->get($child_id, $resource, $params);
        }
    }
}