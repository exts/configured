<?php
namespace Exts\Configured\Filesystem;

/**
 * Interface FilesystemInterface
 * @package Exts\Configured\Filesystem
 */
interface FilesystemInterface
{
    /**
     * @param string $path
     * @return mixed
     */
    public function read(string $path) : string;

    /**
     * @param string $path
     * @return bool
     */
    public function exists(string $path) : bool;

    /**
     * @param string $path
     * @param mixed $content
     * @return void
     */
    public function write(string $path, mixed $content) : void;

    /**
     * @return string
     */
    public function getDirectory() : string;
}