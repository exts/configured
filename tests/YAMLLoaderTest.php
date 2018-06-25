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

    private $directory;

    /**
     * YAMLLoaderTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->directory = __DIR__ . '/configs/';

        $this->loader = new YAML($this->directory);
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

    public function testLoadedDirectoryPathIsSet()
    {
        $expected = $this->directory;
        $filesystem = $this->loader->getFilesystem();

        $this->assertEquals($expected, $filesystem->getDirectory());
    }

    /**
     * @expectedException \Exts\Configured\Exceptions\ReadFileException
     */
    public function testEmptyConfigFileExpectsException()
    {
        $test = $this->loader->load('empty');
    }

    public function testEmptyConfigFile()
    {
        $test = $this->loader->loadOrNull('empty');

        $this->assertTrue(is_null($test));
    }
}