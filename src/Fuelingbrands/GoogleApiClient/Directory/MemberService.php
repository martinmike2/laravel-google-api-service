<?php namespace Fuelingbrands\GoogleApiClient\Directory;

/**
 * Class MemberService
 *
 * A Google Groups member can be a user or another group.
 * This member can be inside or outside of your account's domains.
 *
 * @package Fuelingbrands\GoogleApiClient\Directory
 */
class MemberService extends Directory
{

    /**
     * Tell the API which Service to use
     * @return mixed
     */
    protected function createService()
    {
        return $this->directory->members;
    }

    /**
     * Get the base class
     *
     * @return \Google_Service_Directory_Group
     */
    public function getResource()
    {
        return new \Google_Service_Directory_Member;
    }

    /**
     * Delete a member from a group
     *
     * @param $group_key
     * @param array $params
     * @return null
     */
    public function delete($group_key, $member_key, $params = [])
    {
        try {
            return $this->getService()->delete($group_key, $member_key, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Retrieve a member from a group
     *
     * @param $group_key
     * @param array $params
     * @return null
     */
    public function get($group_key, $member_key, $params = [])
    {
        try {
            return $this->getService()->get($group_key, $member_key, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Insert a new member into a group
     *
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function insert($group_key, \Google_Service_Directory_Member $member, $params = [])
    {
        try {
            return $this->getService()->insert($group_key, $member, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * List all members in a group
     *
     * @param array $params
     * @return null
     */
    public function listMembers($group_key, $params = [])
    {
        try {
            return $this->getService()->listGroups($group_key, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Patch a member with new values
     *
     * SUPPORTS PATCH SEMANTICS
     *
     * @param $group_key
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function patch($group_key, $member_key, \Google_Service_Directory_Member $member, $params = [])
    {
        try {
            return $this->getService()->patch($group_key, $member_key, $member, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }

    /**
     * Update a member with new values
     *
     * DOES NOT SUPPORT PATCH SEMANTICS
     *
     * @param $group_key
     * @param \Google_Service_Directory_Group $group
     * @param array $params
     * @return null
     */
    public function update($group_key, $member_key, \Google_Service_Directory_Member $member, $params = [])
    {
        try {
            return $this->getService()->update($group_key, $member_key, $member, $params);
        } catch (\Google_Service_Exception $e) {
            \Log::error($e->getMessage());
            return null;
        }
    }
}