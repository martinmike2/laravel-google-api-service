<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class ChildrenService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class ChildrenService extends Drive
{

    /**
     * Tell drive which service to use
     *
     * @return \Google_Service_Drive_Children_Resource
     */
    protected function createService()
    {
        return $this->drive->children;
    }

    /**
     * List all children in a folder
     *
     * @param null $id
     * @param array $params
     * @return mixed
     */
    public function listAll($id = null, $params = [])
    {
        return $this->getService()->listChildren($id, $params);
    }

    /**
     * Get a child from the folder
     *
     * @param $resource_id
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function get($resource_id, $child_id, $params = [])
    {
        return $this->getService()->get($resource_id, $child_id, $params);
    }

    /**
     * Delete a child from the folder
     *
     * @param $resource_id
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function delete($resource_id, $child_id, $params = [])
    {
        return $this->getService()->delete($resource_id, $child_id, $params);
    }

    /**
     * Insert a new child into the folder
     *
     * @param $resource_id
     * @param $child_id
     * @param array $params
     * @return mixed
     */
    public function insert($resource_id, $child_id, $params = [])
    {
        $child_ref = new \Google_Service_Drive_ChildReference();
        $child_ref->setId($child_id);

        return $this->getService()->insert($resource_id, $child_ref);
    }
}