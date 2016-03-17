<?php
use Exts\Configured\ConfigArray;
use Exts\Configured\ConfigLoader;
use Exts\Configured\Loader;
use Exts\Configured\Storage;

/**
 * Class YAMLStorageTest
 */
class YAMLStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $tempFile = '/fixtures/saved.yml';

    public function testConfigArrayStoredCorrectlyAsYAMLAndHasValidData()
    {
        $array = [
            'account' => [
                'user' => [
                    'username' => 'Lamonte',
                    'age' => 25
                ],
                'posts' => 12345
            ]
        ];

        $savePath = __DIR__ . $this->tempFile;

        $arrayObject = new ConfigArray($array);

        $storeArray = new Storage\YAML(dirname($savePath));
        $storeArray->store(basename($savePath), (array) $arrayObject);

        $configLoader = new ConfigLoader(new Loader\YAML(dirname($savePath)));
        $data = $configLoader->getArrayObject(basename($savePath));

        $this->assertTrue($data == $arrayObject);
        $this->assertTrue(file_exists($savePath));
    }

    public function tearDown()
    {
        parent::tearDown(); // TODO: Change the autogenerated stub

        if(file_exists(__DIR__ . $this->tempFile)) {
            unlink(__DIR__ . $this->tempFile);
        }
    }
}