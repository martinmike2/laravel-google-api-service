<?php namespace Fuelingbrands\GoogleApiClient\Directory;

use Fuelingbrands\GoogleApiClient\Api;
use Fuelingbrands\GoogleApiClient\Client\GoogleClient;
use Fuelingbrands\GoogleApiClient\GoogleApiTrait;

/**
 * Class Directory
 * @package Fuelingbrands\GoogleApiClient\Directory
 */
abstract class DirectoryApi extends Api
{
    use GoogleApiTrait;

    /**
     * @var \Google_Service_Directory
     */
    protected $directory;

    const CHROMEOS_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.device.chromeos';
    const CHROMEOS_READONLY = 'https://www.googleapis.com/auth/admin.directory.device.chromeos.readonly';
    const MOBILE_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.device.mobile';
    const MOBILE_READONLY = 'https://www.googleapis.com/auth/admin.directory.device.mobile.readonly';
    const MOBILE_ACTION = 'https://www.googleapis.com/auth/admin.directory.device.mobile.action';
    const GROUP_MEMBER_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.group.member';
    const GROUP_MEMBER_READONLY = 'https://www.googleapis.com/auth/admin.directory.group.member.readonly';
    const GROUP_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.group';
    const GROUP_READONLY = 'https://www.googleapis.com/auth/admin.directory.group.readonly';
    const ORG_UNIT_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.orgunit';
    const ORG_UNIT_READONLY = 'https://www.googleapis.com/auth/admin.directory.orgunit.readonly';
    const USER_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.user';
    const USER_READONLY = 'https://www.googleapis.com/auth/admin.directory.user.readonly';
    const USER_ALIAS = 'https://www.googleapis.com/auth/admin.directory.user.alias';
    const USER_ALIAS_READONLY = 'https://www.googleapis.com/auth/admin.directory.user.alias.readonly';
    const USER_SECURITY_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.user.security';
    const USERSCHEMA_GLOBAL = 'https://www.googleapis.com/auth/admin.directory.userschema';
    const USERSCHEMA_READONLY = 'https://www.googleapis.com/auth/admin.directory.userschema.readonly';
    const DIRECTORY_NOTIFICATIONS = 'https://www.googleapis.com/auth/admin.directory.notifications';

    public function __construct($email, $private_key, $scopes, $impersonated_email)
    {
        parent::_construct($email, $private_key, $scopes, $impersonated_email);
    }

    /**
     * Return the base resource required by the service
     *
     * @return mixed
     */
    public function getResource()
    {
        return null;
    }
}