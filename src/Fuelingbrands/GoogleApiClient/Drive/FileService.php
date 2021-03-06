<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class FileService
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class FileService extends Drive
{

    /**
     * Retrieve a single file from the Drive
     *
     * @param int|string $resource
     * @param array $params
     * @return null
     */
    public function get($resource, $params = [])
    {
        return $this->getService()->get($resource, $params);
    }

    public function insertFolder($name, $parent = null, $params = [])
    {
        $folder = new \Google_Service_Drive_DriveFile();
        $folder->setTitle($name);
        $folder->setParents($parent);
        $folder->setMimeType('application/vnd.google-apps.folder');
        return $this->getService()->insert($folder, ['mimeType' => 'application/vnd.google-apps.folder']);
    }

    /**
     * Insert a new File into the Drive
     *
     * @param string $resourcename
     * @param null $parent
     * @param array $params
     * @return mixed
     */
    public function insert($resourcename, $parent = null, $params = [])
    {
        $file = new \Google_Service_Drive_DriveFile();
        $file->setTitle($resourcename);
        $file = $this->getService()->insert($file, $params);

        $parent_resource = new ParentService($this->email, $this->private_key, $this->scopes, $this->impersonated_email);

        $parent = $parent_resource->get($parent, $file->getId());

        $file->setParents($parent);

        return $this->update($file->getId(), $file);
    }

    /**
     * Delete a single file from the Drive
     *
     * @param int|string $resource
     * @param array $params
     * @return mixed
     */
    public function delete($resource, $params = [])
    {
        return $this->getService()->delete($resource, $params);
    }

    /**
     * Update a files metadata only
     *
     * @param int $resource_id
     * @param \Google_Service_Drive_DriveFile $resource
     * @param array $params
     * @return mixed
     */
    public function patch($resource_id, $resource, $params = [])
    {
        return $this->getService()->patch($resource_id, $resource, $params);
    }

    /**
     * Update a files meta data and/or content
     *
     * @param int $resource_id
     * @param  \Google_Service_Drive_DriveFile $resource
     * @param array $params
     * @return mixed
     */
    public function update($resource_id, $resource, $params = [])
    {
        return $this->getService()->update($resource_id, $resource, $params);
    }

    /**
     * Copy a file and place in new folder, if requested
     *
     * @param $original_id
     * @param $new_title
     * @param null $parent_title
     * @param array $params
     * @return mixed
     */
    public function copy($original_id, $new_title, $parent_title = null, $params = [])
    {
        $copy = new \Google_Service_Drive_DriveFile();

        $copy->setTitle($new_title);

        $parent = new \Google_Service_Drive_ParentReference();
        $parent->setId($parent_title);

        $copy->setParents([$parent]);
        $copy = $this->getService()->copy($original_id, $copy, $params);
        return $copy;
    }

    /**
     * List all files with matching parameters
     *
     * @param array $params
     * @return mixed
     */
    public function listAll($id = null, $params = [])
    {
        return $this->getService()->listFiles($params);
    }

    /**
     * Send a file to the trashbin
     *
     * @param $file_id
     * @param array $params
     * @return mixed
     */
    public function trash($file_id, $params = [])
    {
        return $this->getService()->trash($file_id, $params);
    }

    /**
     * Pull a file out of the trashbin
     *
     * @param $file_id
     * @param $params
     * @return mixed
     */
    public function untrash($file_id, $params)
    {
        return $this->getService()->untrash($file_id, $params);
    }

    /**
     * Permanently empty the trashbin
     *
     * @param array $params
     * @return mixed
     */
    public function emptyTrash($params = [])
    {
        return $this->getService()->emptyTrash($params);
    }

    /**
     * Watch a file for changes
     *
     * @param $file_id
     * @param $channel_id
     * @param array $params
     * @return mixed
     */
    public function watch($file_id, $channel_id, $params = [])
    {
        $channel_resource = new ChannelResource($this->email, $this->private_key, $this->scopes, $this->impersonated_email);

        return $this->getService()->watch($file_id, $channel_resource->get($channel_id), $params);
    }

    /**
     * @return \Google_Service_Drive_Files_Resource
     */
    protected function createService()
    {
        return $this->drive->files;
    }


}