<?php
namespace Exts\Configured\Filesystem\Traits;

use Exts\Configured\Filesystem\FilesystemInterface;

/**
 * Trait Filesystem
 * @package Exts\Configured\Filesystem\Traits
 */
trait Filesystem
{
    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * @param FilesystemInterface $filesystemInterface
     */
    public function registerFilesystem(FilesystemInterface $filesystemInterface)
    {
        $this->filesystem = $filesystemInterface;
    }

    /**
     * @return FilesystemInterface
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }
}