<?php namespace Fuelingbrands\GoogleApiClient\Drive;

/**
 * Class FileResource
 * @package Fuelingbrands\GoogleApiClient\Drive
 */
class FileResource extends Drive
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
        if (is_int($resource)) {
            $this->getService()->get($resource, $params);
        } elseif (is_string($resource)) {
            $query = [
                'q' => "title = '" . $resource . "'"
            ];
            $params = array_merge($params, $query);
            return $this->listFiles($params);
        }

        return null;
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

        $parent_resource = new ParentResource($this->private_key, $this->scopes, $this->impersonated_email);

        $parent = $parent_resource->get($parent);

        $file->setParents($parent);

        return $this->getService()->insert($file, $params);
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

        $parent_resource = new ParentResource($this->private_key, $this->scopes, $this->impersonated_email);
        if (!is_null($parent_title) && $parent = $parent_resource->get($parent_title)) {
            $parent_reference = new \Google_Service_Drive_ParentReference();
            $parent_reference->setId($parent->getId());
            $copy->setParents($parent_reference);
        }

        return $this->getService()->copy($original_id, $copy, $params);
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
        $channel_resource = new ChannelResource($this->private_key, $this->scopes, $this->impersonated_email);

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