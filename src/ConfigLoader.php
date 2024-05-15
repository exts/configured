<?php
namespace Exts\Configured;

use Exts\Configured\Loader\LoaderInterface;

/**
 * Class ConfigLoader
 * @package Exts\Configured
 */
class ConfigLoader
{
    private string $fileExtension;

    /**
     * @var LoaderInterface
     */
    private LoaderInterface $loaderInterface;

    /**
     * ConfigLoader constructor.
     * @param LoaderInterface $loaderInterface
     */
    public function __construct(LoaderInterface $loaderInterface)
    {
        $this->fileExtension = $loaderInterface->getExtension();
        $this->loaderInterface = $loaderInterface;
    }

    /**
     * @param string $extension
     */
    public function setExtension(string $extension) : void
    {
        $this->loaderInterface->setExtension($extension);
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function load(string $path) : array
    {
        $result = $this->loaderInterface->loadOrNull($path);

        return is_array($result) ? $result : [];
    }

    /**
     * @param string $data
     * @param null $default
     * @return mixed
     */
    public function get(string $data, mixed $default = null) : mixed
    {
        if(empty($data)) {
            return $default;
        }

        $arrayKeys = explode('.', $data);
        $configFile = array_shift($arrayKeys);

        $data = $this->load($configFile);
        if(empty($data)) {
            return $default;
        }

        if(empty($arrayKeys)) {
            return $data;
        }

        return (new ConfigArray($data)) -> get(implode('.', $arrayKeys), $default);
    }

    /**
     * @param string $file
     * @return ConfigArray
     */
    public function getArrayObject(string $file): ConfigArray
    {
        $data = $this->load($file);

        return new ConfigArray($data);
    }
}