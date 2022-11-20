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

    public function testThrowLoadFileExceptionWhenFileDoesntExist()
    {
        $this->expectException(\Exts\Configured\Exceptions\LoadFileException::class);
        $this->loader->load('test_doesnt_exist');
    }

    public function testThrowReadFileExceptionWhenFileExists()
    {
        $this->expectException(\Exts\Configured\Exceptions\ReadFileException::class);
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

    public function testEmptyConfigFileExpectsException()
    {
        $this->expectException(\Exts\Configured\Exceptions\ReadFileException::class);
        $test = $this->loader->load('empty');
    }

    public function testEmptyConfigFile()
    {
        $test = $this->loader->loadOrNull('empty');

        $this->assertTrue(is_null($test));
    }
}