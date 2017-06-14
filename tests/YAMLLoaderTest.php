<?php

use Exts\Configured\Loader\YAML;
use PHPUnit\Framework\TestCase;

/**
 * Class YAMLLoaderTest
 */
class YAMLLoaderTest extends TestCase
{
    /**
     * @var YAML
     */
    private $loader;

    /**
     * YAMLLoaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->loader = new YAML(__DIR__ . '/configs');
    }

    /**
     * @expectedException \Exts\Configured\Exceptions\LoadFileException
     */
    public function testThrowLoadFileExceptionWhenFileDoesntExist()
    {
        $this->loader->load('test_doesnt_exist');
    }

    /**
     * @expectedException \Exts\Configured\Exceptions\ReadFileException
     */
    public function testThrowReadFileExceptionWhenFileExists()
    {
        $this->loader->load('test_empty');
    }

    public function testFileExistsAndDoesntThrowException()
    {
        $test = $this->loader->load('test.yml');

        $this->assertNotEmpty($test);
    }

    public function testLoadedFileIsAnArray()
    {
        $test = $this->loader->load('test');

        $this->assertTrue(is_array($test));
    }
}