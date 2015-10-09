<?php namespace Fuelingbrands\GoogleApiClient\Directory;

/**
 * Class GroupService
 *
 * Google Groups provide your users the ability to send
 * messages to groups of people using the group's email address.
 *
 * @package Fuelingbrands\GoogleApiClient\Directory
 */
class GroupService extends DirectoryApi
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        $this->getClient()->addScopes([DirectoryApi::GROUP_GLOBAL, DirectoryApi::GROUP_READONLY]);
        return $this->directory->groups;
    }

    /**
     * Get the base class
     *
     * @return \Google_Service_Directory_Group
     */
    public function getResource()
    {
        return new \Google_Service_Directory_Group;
    }

    /**
     * Delete a group
     *
     * @param $group_key
     * @param array $params
     * @return null
     */
    public function delete($group_key, $params = [])
    {
        try {
            return $this->getService()->delete($group_key, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve a group
     *
     * @param $group_key
     * @param array $params
     * @return null
     */
    public function get($group_key, $params = [])
    {
        try {
            return $this->getService()->get($group_key, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Insert a new group
     *
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function insert(\Google_Service_Directory_Group $group, $params = [])
    {
        try {
            return $this->getService()->insert($group, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * List all groups
     *
     * @param array $params
     * @return null
     */
    public function listGroups($params = [])
    {
        try {
            return $this->getService()->listGroups($params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Patch a group with new values
     *
     * SUPPORTS PATCH SEMANTICS
     *
     * @param $group_key
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function patch($group_key, \Google_Service_Directory_Group $group, $params = [])
    {
        try {
            return $this->getService()->patch($group_key, $group, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Update a group with new values
     *
     * DOES NOT SUPPORT PATCH SEMANTICS
     *
     * @param $group_key
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function update($group_key, \Google_Service_Directory_Group $group, $params = [])
    {
        try {
            return $this->getService()->update($group_key, $group, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

}