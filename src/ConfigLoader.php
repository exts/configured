<?php
namespace Exts\Configured;

use Exts\Configured\Loader\LoaderInterface;

/**
 * Class ConfigLoader
 * @package Exts\Configured
 */
class ConfigLoader
{
    /**
     * @var LoaderInterface
     */
    private $loaderInterface;

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
     * @param $extension
     */
    public function setExtension($extension)
    {
        $this->loaderInterface->setExtension($extension);
    }

    /**
     * @param $path
     *
     * @return array
     */
    public function load($path) : array
    {
        $result = $this->loaderInterface->loadOrNull($path);

        return is_array($result) ? $result : [];
    }

    /**
     * @param string $data
     * @param null $default
     * @return array|null|string
     */
    public function get(string $data, $default = null)
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
    public function getArrayObject(string $file)
    {
        $data = $this->load($file);

        return new ConfigArray($data);
    }
}