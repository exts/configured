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
    protected FilesystemInterface $filesystem;

    /**
     * @param FilesystemInterface $filesystemInterface
     */
    public function registerFilesystem(FilesystemInterface $filesystemInterface) : void
    {
        $this->filesystem = $filesystemInterface;
    }

    /**
     * @return FilesystemInterface
     */
    public function getFilesystem() : FilesystemInterface
    {
        return $this->filesystem;
    }
}