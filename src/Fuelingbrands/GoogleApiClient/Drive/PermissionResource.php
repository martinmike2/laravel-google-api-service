<?php namespace Fuelingbrands\GoogleApiClient\Drive;

class PermissionResource extends Drive
{

    protected function createService()
    {
        return $this->drive->permissions;
    }

    protected function listAll($id = null, $params = [])
    {
        if(!is_null($id)) {
            return $this->getService()->listPermissions($id, $params);
        }

        return null;
    }

    public function insert($file_id, $value, $type, $role, $params = [])
    {
        $permission = new \Google_Service_Drive_Permission();
        $permission->setValue($value);
        $permission->setType($type);
        $permission->setRole($role);

        return $this->getService()->inser($file_id, $permission, $params);
    }

    public function delete($file_id, $params = [])
    {
        return $this->getService()-delete($file_id, $params);
    }

    public function get($file_id, $permission_id, $params = [])
    {
        return $this->getService()->get($file_id, $permission_id, $params);
    }

    public function patch($file_id, $permission_id, $new_role, $params = [])
    {
        $patch = new \Google_Service_Drive_Permission();
        $patch->setRole($new_role);

        return $this->getService()->path($file_id, $permission_id, $patch, $params);
    }

    public function update($file_id, $permission_id, $new_role, $params = [])
    {
        $permission = $this->get($file_id, $permission_id);
        $permission->setRole($new_role);

        return $this->getService()->update($file_id, $permission_id, $permission);
    }
}