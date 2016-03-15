<?php
namespace Exts\Configured\Filesystem;

use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

/**
 * Class PHPLeague
 * @package Exts\Configured\Filesystem
 */
class PHPLeague implements FilesystemInterface
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * PHPLeague constructor.
     * @param $directory
     * @param AdapterInterface|null $adapter
     */
    public function __construct($directory, AdapterInterface $adapter = null)
    {
        $filesystemAdapter = $adapter ?? new Local($directory);

        $this->filesystem = new Filesystem($filesystemAdapter);
    }

    /**
     * @param $path
     * @return bool|false|string
     */
    public function read($path)
    {
        return $this->filesystem->read($path);
    }

    /**
     * @param $path
     * @return bool
     */
    public function exists($path)
    {
        return $this->filesystem->has($path);
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        /** @var AbstractAdapter $adapter */
        $adapter = $this->filesystem->getAdapter();

        return $adapter->getPathPrefix();
    }
}