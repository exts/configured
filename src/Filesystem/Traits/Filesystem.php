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
     * @return mixed
     */
    public function getFilesystem()
    {
        return $this->getFilesystem();
    }
}