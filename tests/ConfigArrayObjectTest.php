<?php

use Exts\Configured\ConfigArray;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigArrayObjectTest
 */
class ConfigArrayObjectTest extends TestCase
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

    public function testDotNotationReturnEmptyValue()
    {
        $array = [
            'child' => [
                'array' => '',
                'array2' => false,
                'array3' => 0,
            ]
        ];

        $arrayObject = new ConfigArray($array);
        $results = $arrayObject->get('child.array', 'default');
        $results2 = $arrayObject->get('child.array2', 'default');
        $results3 = $arrayObject->get('child.array3', 'default');
        $this->assertTrue($results === 'default');
        $this->assertTrue($results2 !== 'default');
        $this->assertTrue($results3 !== 'default');
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