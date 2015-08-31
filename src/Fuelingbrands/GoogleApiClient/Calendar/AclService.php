<?php namespace Fuelingbrands\GoogleApiClient\Calendar;

/**
 * Class AclService
 * @package Fuelingbrands\GoogleApiClient\Calendar
 */
class AclService extends CalendarApi
{

    /**
     * Tell the Api which service to use
     *
     * @return \Google_Service_Calendar_Acl_Resource
     */
    protected function createService()
    {
        return $this->calendar->acl;
    }

    /**
     * Delete an ACL Rule from a calendar
     *
     * @param $calendar_id
     * @param $rule_id
     * @return mixed
     */
    public function delete($calendar_id, $rule_id)
    {
        return $this->getService()->delete($calendar_id, $rule_id);
    }

    /**
     * Get an ACL Rule from the calendar
     *
     * @param $calendar_id
     * @param $rule_id
     * @return mixed
     */
    public function get($calendar_id, $rule_id)
    {
        return $this->getService()->get($calendar_id, $rule_id);
    }

    /**
     * Insert a new ACL Rule into the calendar
     *
     * @param $calendar_id
     * @param $role
     * @param $scope_type
     * @param $scope_value
     * @return mixed
     */
    public function insert($calendar_id, $role, $scope_type, $scope_value)
    {
        $rule = new \Google_Service_Calendar_AclRule();
        $scope = new \Google_Service_Calendar_AclRuleScope();

        $scope->setType($scope_type);
        $scope->setValue($scope_value);

        $rule->setScope($scope);
        $rule->setRole($role);

        return $this->getService()->insert($calendar_id, $rule);
    }

    /**
     * List all ACL rules effecting this calendar
     *
     * @param $calendar_id
     * @return mixed
     */
    public function listAll($calendar_id)
    {
        return $this->getService()->listAcl($calendar_id);
    }

    /**
     * Update an ACL Rule with a new Role
     *
     * @param $calendar_id
     * @param $rule_id
     * @param $role
     * @return mixed
     */
    public function update($calendar_id, $rule_id, $role)
    {
        $rule = $this->get($calendar_id, $rule_id);
        $rule->setRole($role);

        return $this->update($calendar_id, $rule->getId(), $rule);
    }

    /**
     * Update an ACL Rule with a new Role
     *
     * @param $calendar_id
     * @param $rule_id
     * @param $role
     * @return mixed
     */
    public function patch($calendar_id, $rule_id, $role)
    {
        return $this->update($calendar_id, $rule_id, $role);
    }

}