<?php
namespace Exts\Configured;

use Exts\Configured\Loader\LoaderInterface;

class ConfigLoader
{
    private $loaderInterface;
    
    public function __construct(LoaderInterface $loaderInterface)
    {
        $this->fileExtension = $loaderInterface->getExtension();
        $this->loaderInterface = $loaderInterface;
    }

    public function setExtension($extension)
    {
        $this->loaderInterface->setExtension($extension);
    }

    public function load($path) : array
    {
        return $this->loaderInterface->load($path);
    }

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

    public function getArrayObject(string $file)
    {
        $data = $this->load($file);

        return new ConfigArray($data);
    }
}