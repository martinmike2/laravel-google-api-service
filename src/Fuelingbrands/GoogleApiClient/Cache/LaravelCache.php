<?php namespace Fuelingbrands\GoogleApiClient\Cache;

use Google_Client;

class LaravelCache extends \Google_Cache_Abstract
{

    protected $client;


    public function __construct(Google_Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieves the data for the given key, or false if they
     * key is unknown or expired
     *
     * @param String $key The key who's data to retrieve
     * @param boolean|int $expiration Expiration time in seconds
     *
     */
    public function get($key, $expiration = false)
    {
        \Cache::get($key);
    }

    /**
     * Store the key => $value set. The $value is serialized
     * by this function so can be of any type
     *
     * @param string $key Key of the data
     * @param string $value data
     */
    public function set($key, $value)
    {
        \Cache::put($key, $value);
    }

    /**
     * Removes the key/data pair for the given $key
     *
     * @param String $key
     */
    public function delete($key)
    {
        \Cache::forget($key);
    }
}