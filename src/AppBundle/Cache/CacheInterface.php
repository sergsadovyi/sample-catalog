<?php
namespace AppBundle\Cache;

interface CacheInterface
{
    public function set($key, $value);
    public function get($key);
}