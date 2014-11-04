<?php
namespace AppBundle\Cache;

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

    public function get($key)
    {
        $file = $this->getFilePath($key);
        if (file_exists($file)) {
            return file_get_contents($file);
        }

        return false;
    }

    protected function getFilePath($key)
    {
        return $this->dir . '/storage/' . $key;
    }
}