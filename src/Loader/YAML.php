<?php
namespace Exts\Configured\Loader;

use Exts\Configured\Exceptions\LoadFileException;
use Exts\Configured\Exceptions\ReadFileException;
use Exts\Configured\Filesystem\FilesystemInterface;
use Exts\Configured\Filesystem\PHPLeague;
use Exts\Configured\Filesystem\Traits\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Parser;

/**
 * Class YAML
 * @package Exts\Configured\Loader
 */
class YAML implements LoaderInterface
{
    use Filesystem;

    /**
     * @var string
     */
    protected $extension = 'yml';

    /**
     * @var string|null
     */
    protected ?string $exceptionMessage = null;

    /**
     * YAML constructor.
     * @param $directory
     * @param FilesystemInterface|null $filesystemInterface
     */
    public function __construct($directory, FilesystemInterface $filesystemInterface = null)
    {
        $filesystem = $filesystemInterface ?? new PHPLeague($directory);

        $this->registerFilesystem($filesystem);
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
        $filePath = sprintf("%s/%s", rtrim($this->filesystem->getDirectory(), '/'), ltrim($path));

        if(!$this->filesystem->exists($path)) {
            throw new LoadFileException(sprintf("The file you were trying to load doesn't exist: %s", $filePath));
        }

        $fileContent = $this->filesystem->read($path);
        if(!$fileContent) {
            throw new ReadFileException(sprintf("There was a problem trying to read this file: %s", $filePath));
        }

        $fileContent = trim($fileContent);
        if(empty($fileContent)) {
            throw new ReadFileException(sprintf("This file is empty: %s", $filePath));
        }

        try {
            return (new Parser) -> parse($fileContent);
        } catch(ParseException $e) {
            throw new ReadFileException(sprintf("Unable to parse the YAML string: %s", $e->getMessage()));
        }
    }

    /**
     * @param $path
     *
     * @return mixed|null
     */
    public function loadOrNull($path)
    {
        try {
            return $this->load($path);
        } catch(\Exception $e) {
            $this->exceptionMessage = $e->getMessage();
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
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