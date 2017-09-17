<?php
/**
 * Created by PhpStorm.
 * User: cocoyo
 * Date: 2017/9/15 0015
 * Time: 16:49
 */
namespace Cocoyo\Geography\Support;

use ArrayAccess;
use Cocoyo\Geography\Exceptions\InvalidArgumentException;

class Config implements ArrayAccess
{
    /**
     * @var array
     */
    protected $config;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * get a config
     *
     * @param null $key
     * @return array|mixed
     */
    public function get($key = null)
    {
        $config = $this->config;

        if (is_null($key)) {
            return $config;
        }

        if (isset($config[$key])) {
            return $config[$key];
        }

        return $config;
    }

    /**
     * set a config
     *
     * @param  string $key
     * @param  string $value
     * @return array
     */
    public function set($key, $value)
    {
        if ($key == '') {
            throw new InvalidArgumentException('Invalid config key');
        }

        $this->config[$key] = $value;

        return $this->config;
    }

    /**
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->config);
    }

    /**
     * @param mixed $offset
     * @return array|mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return array
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return array
     */
    public function offsetUnset($offset)
    {
        return $this->set($offset, null);
    }
}