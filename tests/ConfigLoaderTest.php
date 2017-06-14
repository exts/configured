<?php

use Exts\Configured\ConfigArray;
use Exts\Configured\Loader\YAML;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigLoaderTest
 */
class ConfigLoaderTest extends TestCase
{
    /**
     * @var YAML
     */
    private $loader;

    /**
     * @var \Exts\Configured\ConfigLoader
     */
    private $configLoader;

    /**
     * ConfigLoaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->loader = new YAML(__DIR__ . '/configs');
        $this->configLoader = new \Exts\Configured\ConfigLoader($this->loader);
    }

    public function testConfigFileCreatesProperConfigArrayObject()
    {
        $arrayObject = $this->configLoader->getArrayObject('test');

        $this->assertTrue(($arrayObject instanceof ConfigArray));
    }

    public function testConfigArrayObjectCanBeAccessedDirectly()
    {
        $arrayObject = $this->configLoader->getArrayObject('test');

        $this->assertTrue($arrayObject['users'][0]['username'] == "Lamonte");
        $this->assertTrue($arrayObject['users'][0]['email'] == "example@example.com");

        $this->assertTrue($arrayObject['users'][1]['username'] == "John Doe");
        $this->assertTrue($arrayObject['users'][1]['email'] == "johndoe@example.com");
    }

    public function testConfigArrayObjectCanBeAccessedFromGetMethod()
    {
        $arrayObject = $this->configLoader->getArrayObject('test');

        $this->assertTrue($arrayObject->get('users.0.username') == "Lamonte");
        $this->assertTrue($arrayObject->get('users.0.email') == "example@example.com");

        $this->assertTrue($arrayObject->get('users.1.username') == "John Doe");
        $this->assertTrue($arrayObject->get('users.1.email') == "johndoe@example.com");
    }

    public function testConfigArrayOjectCanStoreDataDirectly()
    {
        $arrayObject = $this->configLoader->getArrayObject('test');

        $arrayObject->set('users.0.username', "Exts Developer");
        $arrayObject->set('users.0.email', "exts@gmail.com");

        $arrayObject->set('users.2.username', "Exts Developer Test");
        $arrayObject->set('users.2.email', "exts2@gmail.com");

        $this->assertTrue($arrayObject->get('users.0.username') == "Exts Developer");
        $this->assertTrue($arrayObject->get('users.0.email') == "exts@gmail.com");

        $this->assertTrue($arrayObject->get('users.2.username') == "Exts Developer Test");
        $this->assertTrue($arrayObject->get('users.2.email') == "exts2@gmail.com");

        $this->assertTrue(count($arrayObject['users']) == 3);
    }
}