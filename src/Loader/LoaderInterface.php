<?php
namespace Exts\Configured\Loader;

/**
 * Interface LoaderInterface
 *
 * @package Exts\Configured\Loader
 */
interface LoaderInterface
{
    /**
     * @param string $path
     *
     * @return mixed
     */
    public function load(string $path) : mixed;

    /**
     * @param string $path
     *
     * @return mixed|null
     */
    public function loadOrNull(string $path) : mixed;

    /**
     * @return mixed
     */
    public function getExtension() : string;

    /**
     * @param string $extension
     */
    public function setExtension(string $extension) : void;
}