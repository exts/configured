<?php
namespace Exts\Configured;

use Exts\Configured\Storage\StorageInterface;

/**
 * Class ConfigStorage
 * @package Exts\Configured
 */
class ConfigStorage
{
    /**
     * @var StorageInterface
     */
    private StorageInterface $storageInterface;

    /**
     * ConfigStorage constructor.
     * @param StorageInterface $storageInterface
     */
    public function __construct(StorageInterface $storageInterface)
    {
        $this->storageInterface = $storageInterface;
    }

    /**
     * @param string $file
     * @param mixed $data
     * @return mixed
     */
    public function store(string $file, mixed $data):  mixed
    {
        return $this->storageInterface->store($file, $data);
    }
}