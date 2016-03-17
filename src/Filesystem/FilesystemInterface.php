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
     * @param string $path
     * @param $content
     * @return mixed
     */
    public function write(string $path, $content);

    /**
     * @return mixed
     */
    public function getDirectory();
}