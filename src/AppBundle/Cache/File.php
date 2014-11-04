<?php
namespace AppBundle\Cache;

/**
 * File Storage
 */
class File implements CacheInterface
{
    /**
     * @var string  Root dir for storage
     */
    protected $dir;

    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $file = $this->getFilePath($key);

        // Checks directory
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($file, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $file = $this->getFilePath($key);
        if (file_exists($file)) {
            return file_get_contents($file);
        }

        return false;
    }

    /**
     * Builds the full path to cache file
     *
     * @param $key
     *
     * @return string
     */
    protected function getFilePath($key)
    {
        return $this->dir . '/storage/' . $key;
    }
}