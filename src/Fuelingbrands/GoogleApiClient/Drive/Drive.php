<?php namespace Fuelingbrands\GoogleApiClient\Drive;

use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

abstract class Drive
{
    use GoogleApiTrait;
    protected $drive;

    const DRIVE = 'https://www.googleapis.com/auth/drive';
    const DRIVE_FILE = 'https://www.googleapis.com/auth/drive.file';
    const DRIVE_APPS_READONLY = 'https://www.googleapis.com/auth/drive.apps.readonly';
    const DRIVE_READONLY = 'https://www.googleapis.com/auth/drive.readonly';
    const DRIVE_METADATA_READONLY = 'https://www.googleapis.com/auth/drive.metadata.readonly';
    const DRIVE_METADATA = 'https://www.googleapis.com/auth/drive.metadata';
    const DRIVE_INSTALL = 'https://www.googleapis.com/auth/drive.install';
    const DRIVE_APPFOLDER = 'https://www.googleapis.com/auth/drive.appfolder';
    const DRIVE_SCRIPTS = 'https://www.googleapis.com/auth/drive.scripts';

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        $this->client = GoogleClient::getInstance($email, $private_key, $scopes, $impersonated_email);
        $this->drive = new \Google_Service_Drive($this->client->client);
        $this->private_key = $private_key;
        $this->scopes = $scopes;
        $this->impersonated_email = $impersonated_email;
        $this->email = $email;
    }

    public function getClient()
    {
        return $this->client;
    }

    abstract public function listAll($id = null, $params = []);
}