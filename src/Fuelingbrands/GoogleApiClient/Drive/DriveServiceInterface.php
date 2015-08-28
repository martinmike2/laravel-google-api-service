<?php namespace Fuelingbrands\GoogleApiClient\Drive;

interface DriveServiceInterface
{
    public function insert($resourceTitle, $parent = null, $params = []);
    public function delete($resource, $params = []);
    public function get($resource, $params = []);
    public function patch($resourceId, $resource, $params = []);
    public function update($resourceId, $resource, $params = []);
}