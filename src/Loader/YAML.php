<?php
namespace Exts\Configured\Loader;

use Exts\Configured\Exceptions\LoadFileException;
use Exts\Configured\Exceptions\ReadFileException;
use Exts\Configured\Filesystem\FilesystemInterface;
use Exts\Configured\Filesystem\PHPLeague;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Class YAML
 * @package Exts\Configured\Loader
 */
class YAML implements LoaderInterface
{
    /**
     * @var FilesystemInterface
     */
    protected $filesystemInterface;

    /**
     * @var string
     */
    protected $extension = 'yml';

    /**
     * YAML constructor.
     * @param $directory
     * @param FilesystemInterface|null $filesystemInterface
     */
    public function __construct($directory, FilesystemInterface $filesystemInterface = null)
    {
        $filesystem = $filesystemInterface ?? new PHPLeague($directory);

        $this->registerFileSystem($filesystem);
    }

    /**
     * @param $path
     * @return mixed
     * @throws LoadFileException
     * @throws ReadFileException
     */
    public function load($path)
    {
        $path = !preg_match("#" . preg_quote('.' . $this->extension) . "$#", $path) ? $path . '.' . $this->extension : $path;
        $filePath = sprintf("%s/%s", rtrim($this->filesystemInterface->getDirectory(), '/'), ltrim($path));

        if(!$this->filesystemInterface->exists($path)) {
            throw new LoadFileException(sprintf("The file you were trying to load doesn't exist: %s", $filePath));
        }

        $fileContent = $this->filesystemInterface->read($path);
        if(!$fileContent) {
            throw new ReadFileException(sprintf("There was a problem trying to read this file: %s", $filePath));
        }

        try {
            return (new Parser) -> parse($fileContent);
        } catch(ParseException $e) {
            throw new ReadFileException(sprintf("Unable to parse the YAML string: %s", $e->getMessage()));
        }
    }

    /**
     * @param FilesystemInterface $filesystemInterface
     */
    public function registerFileSystem(FilesystemInterface $filesystemInterface)
    {
        $this->filesystemInterface = $filesystemInterface;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}