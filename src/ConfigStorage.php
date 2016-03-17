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
    private $storageInterface;

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
     * @param $data
     * @return mixed
     */
    public function store(string $file, $data)
    {
        return $this->storageInterface->store($file, $data);
    }
}