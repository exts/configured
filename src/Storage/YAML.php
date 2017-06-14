<?php
namespace Exts\Configured\Storage;

use Exts\Configured\Filesystem\FilesystemInterface;
use Exts\Configured\Filesystem\PHPLeague;
use Exts\Configured\Filesystem\Traits\Filesystem;
use Symfony\Component\Yaml\Dumper;

/**
 * Class YAML
 * @package Exts\Configured\Storage
 */
class YAML implements StorageInterface
{
    use Filesystem;

    /**
     * @var int
     */
    private $inline = 3;

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
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function store(string $path, array $data)
    {
        $parser = new Dumper();
        $yamlParsed = $parser->dump($data, $this->inline);

        return $this->filesystem->write($path, $yamlParsed);
    }

    /**
     * @param int $inline
     */
    public function setInline(integer $inline)
    {
        $this->inline = $inline;
    }
}