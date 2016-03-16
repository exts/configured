<?php
use Exts\Configured\ConfigArray;

/**
 * Class ConfigArrayObjectTest
 */
class ConfigArrayObjectTest extends PHPUnit_Framework_TestCase
{
    public function testDotNotationReturnsValue()
    {
        $array = [
            'child' => [
                'array' => 'data'
            ]
        ];

        $arrayObject = new ConfigArray($array);

        $results = $arrayObject->get('child.array', 'default');

        $this->assertTrue($results == 'data');
    }

    public function testArrayObjectDirectKeyAccessReturnsValue()
    {
        $array = [
            'child' => [
                'array' => 'data'
            ]
        ];

        $arrayObject = new ConfigArray($array);

        $this->assertTrue($arrayObject['child']['array'] == 'data');
    }

    public function testArrayObjectSetDataFromDotNotationAndReturnsSetValueFromGetMethod()
    {
        $array = [
            'child' => [
                'array' => 'data'
            ]
        ];

        $arrayObject = new ConfigArray($array);
        $arrayObject->set('child.newArray', 'data2');

        $this->assertTrue($arrayObject->get('child.newArray') == 'data2');
    }

    public function testArrayObjectSetDataFromDotNotationAndReturnSetValueFromDirectAccess()
    {
        $array = [
            'child' => [
                'array' => 'data'
            ]
        ];

        $arrayObject = new ConfigArray($array);
        $arrayObject->set('child.newArray', 'data2');

        $this->assertTrue($arrayObject['child']['newArray'] == 'data2');
    }
}