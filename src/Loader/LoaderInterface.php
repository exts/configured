<?php
namespace Exts\Configured\Loader;

/**
 * Interface LoaderInterface
 * @package Exts\Configured\Loader
 */
interface LoaderInterface
{
    /**
     * @param $path
     * @return mixed
     */
    public function load($path);

    /**
     * @return mixed
     */
    public function getExtension();
}