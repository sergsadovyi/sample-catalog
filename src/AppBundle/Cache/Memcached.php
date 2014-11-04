<?php
namespace AppBundle\Cache;

use \Memcached;

/**
 * Memcached storage
 */
class Memcached implements CacheInterface
{
    /**
     * @var Memcached
     */
    protected $client;

    public function __construct(Memcached $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->client->set($key, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return $this->client->get($key);
    }
}