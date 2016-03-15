<?php
namespace Exts\Configured\Filesystem;

/**
 * Interface FilesystemInterface
 * @package Exts\Configured\Filesystem
 */
interface FilesystemInterface
{
    /**
     * @param $path
     * @return mixed
     */
    public function read($path);

    /**
     * @param $path
     * @return mixed
     */
    public function exists($path);

    /**
     * @return mixed
     */
    public function getDirectory();
}