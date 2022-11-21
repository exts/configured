<?php
namespace Exts\Configured\Filesystem;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter;

/**
 * Class PHPLeague
 * @package Exts\Configured\Filesystem
 */
class PHPLeague implements FilesystemInterface
{
    /**
     * @var string
     */
    protected string $directory;

    /**
     * @var Filesystem
     */
    protected Filesystem $filesystem;

    /**
     * PHPLeague constructor.
     * @param string $directory
     * @param FilesystemAdapter|null $adapter
     */
    public function __construct(string $directory, FilesystemAdapter $adapter = null)
    {
        $this->directory = $directory;
        $filesystemAdapter = $adapter ?? new LocalFilesystemAdapter($this->directory);
        $this->filesystem = new Filesystem($filesystemAdapter);
    }

    /**
     * @param $path
     *
     * @throws FilesystemException
     * @return string
     */
    public function read($path)
    {
        return $this->filesystem->read($path);
    }

    /**
     * @param $path
     *
     * @throws FilesystemException
     * @return bool
     */
    public function exists($path)
    {
        return $this->filesystem->has($path);
    }

    /**
     * @param string $path
     * @param $content
     *
     * @throws FilesystemException
     * @return void
     */
    public function write(string $path, $content) : void
    {
        $this->filesystem->write($path, $content);
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }
}