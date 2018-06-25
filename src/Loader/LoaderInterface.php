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
     * @param $path
     *
     * @return mixed
     */
    public function load($path);

    /**
     * @param $path
     *
     * @return mixed|null
     */
    public function loadOrNull($path);

    /**
     * @return mixed
     */
    public function getExtension();

    /**
     * @param $extension
     */
    public function setExtension($extension);
}