<?php
namespace Exts\Configured\Storage;

/**
 * Interface StorageInterface
 * @package Exts\Configured\Storage
 */
interface StorageInterface
{
    /**
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function store(string $path, array $data) : mixed;
}