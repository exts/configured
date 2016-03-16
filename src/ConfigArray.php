<?php
namespace Exts\Configured;

use function igorw\get_in;

/**
 * Class ConfigArray
 * @package Exts\Configured
 */
class ConfigArray extends \ArrayObject
{
    /**
     * @param string $key
     * @param null $default
     * @return array|null
     */
    public function get(string $key, $default = null)
    {
        if(empty($key)) {
            return $default;
        }

        $array = $this->getArrayCopy();

        $keys = explode('.', $key);
        foreach($keys as $arrayKey) {
            $array = $array[$arrayKey] ?? null;
            if(is_null($array)) {
                break;
            }
        }

        return $array ?? $default;
    }

    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    public function set(string $key, $value)
    {
        if(empty($key)) {
            return false;
        }

        $keys = explode('.', $key);
        $array =& $this;
        foreach($keys as $arrayKey) {
            $array =& $array[$arrayKey];
        }

        $array = $value;

        return true;
    }
}