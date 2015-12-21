<?php namespace Fuelingbrands\GoogleApiClient\Cache;

interface CacheInterface extends \Google_Cache_Abstract
{
    /**
     * Retrieves the data for the given key, or false if they
     * key is unknown or expired
     *
     * @param String $key The key who's data to retrieve
     * @param boolean|int $expiration Expiration time in seconds
     *
     */
    public function get($key, $expiration);

    /**
     * Store the key => $value set.
     *
     * @param string $key Key of the data
     * @param string $value data
     */
    public function set($key, $value);

    /**
     * Removes the key/data pair for the given $key
     *
     * @param String $key
     */
    public function delete($key);
}