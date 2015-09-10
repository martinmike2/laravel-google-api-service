<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class PermissionService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class PermissionService extends Drive
{

    /**
     * Tell the API what service to use
     * @return \Google_Service_Drive_Permissions_Resource
     */
    protected function createService()
    {
        return $this->drive->permissions;
    }

    /**
     * List all permissions on a file
     *
     * @param null $id
     * @param array $params
     * @return null
     */
    public function listAll($id = null, $params = [])
    {
        if(!is_null($id)) {
            return $this->getService()->listPermissions($id, $params);
        }

        return null;
    }

    /**
     * Insert permissions on a file
     *
     * @param $file_id
     * @param $value
     * @param $type
     * @param $role
     * @param array $params
     * @return mixed
     */
    public function insert($file_id, $value, $type, $role, $params = [])
    {
        $parameters = [
            'sendNotificationEmails' => false
        ];

        $params = array_merge($params, $parameters);

        $permission = new \Google_Service_Drive_Permission();
        $permission->setValue($value);
        $permission->setType($type);
        $permission->setRole($role);

        return $this->getService()->insert($file_id, $permission, $params);
    }

    /**
     * Remove permissions from a file
     *
     * @param $file_id
     * @param array $params
     * @return mixed
     */
    public function delete($file_id, $permission_id, $params = [])
    {
        return $this->getService()->delete($file_id, $permission_id, $params);
    }

    /**
     * Get a permission from a file
     *
     * @param $file_id
     * @param $permission_id
     * @param array $params
     * @return mixed
     */
    public function get($file_id, $permission_id, $params = [])
    {
        return $this->getService()->get($file_id, $permission_id, $params);
    }

    /**
     * Update a permission on a file
     *
     * @param $file_id
     * @param $permission_id
     * @param $new_role
     * @param array $params
     * @return mixed
     */
    public function patch($file_id, $permission_id, $new_role, $params = [])
    {
        $patch = new \Google_Service_Drive_Permission();
        $patch->setRole($new_role);

        return $this->getService()->patch($file_id, $permission_id, $patch, $params);
    }

    /**
     * Update a permission on a file
     *
     * @param $file_id
     * @param $permission_id
     * @param $new_role
     * @param array $params
     * @return mixed
     */
    public function update($file_id, $permission_id, $new_role, $params = [])
    {
        $permission = $this->get($file_id, $permission_id);
        $permission->setRole($new_role);

        return $this->getService()->update($file_id, $permission_id, $permission);
    }
}