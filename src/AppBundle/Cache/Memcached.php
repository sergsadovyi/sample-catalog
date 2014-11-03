<?php
namespace AppBundle\Cache;

use Lsw\MemcacheBundle\Cache\AntiDogPileMemcache;

class Memcached implements CacheInterface
{
    /**
     * @var AntiDogPileMemcache
     */
    protected $client;

    public function __construct(AntiDogPileMemcache $client)
    {
        $this->client = $client;
    }

    public function set($key, $value)
    {
        $this->client->set($key, $value);
    }

    public function get($key)
    {
        return $this->client->get($key);
    }
}