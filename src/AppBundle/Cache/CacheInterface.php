<?php
namespace AppBundle\Cache;

/**
 * Interface for Cache storage
 */
interface CacheInterface
{
    /**
     * Sets the value defined by key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value);

    /**
     * Gets the value defined by key
     *
     * @param $key
     *
     * @return mixed
     */
    public function get($key);
}