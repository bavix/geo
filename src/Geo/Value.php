<?php

namespace Bavix\Geo;

abstract class Value
{

    const READ_ONLY = 1;
    const WRITE = 2;

    /**
     * @var string
     */
    protected $depend;

    /**
     * @var array
     */
    protected $properties;

    /**
     * @var array
     */
    private $data = [];

    /**
     * Object constructor.
     *
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        foreach ((array)$data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param array|null $data
     *
     * @return Value
     */
    public static function make(array $data = null): self
    {
        return new static($data);
    }


    /**
     * @param string $name
     */
    protected function propertyValidate(string $name)
    {
        if (empty($this->properties[$name])) {
            throw new \InvalidArgumentException('Property not exists');
        }
    }

    /**
     * @param string $name
     * @param        $value
     */
    protected function change(string $name, $value)
    {
        $this->data[$name] = $value;

        if (isset($this->properties[$name]['update'])) {
            $this->update($name, $this->properties[$name]['update']);
        }
    }

    /**
     * @param string $name
     * @param array  $props
     */
    protected function update(string $name, array $props)
    {
        foreach ($props as $prop => $callback) {
            if (\is_int($prop)) {
                $prop = $callback;
                $this->data[$prop] = $this->{$callback . 'Get'}($this->data[$name]);
                continue;
            }

            $this->data[$prop] = $callback($this->data[$name]);
        }
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        $this->propertyValidate($name);

        if ($this->__isset($name)) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     * @param string $name
     * @param        $value
     */
    public function __set(string $name, $value)
    {
        $this->propertyValidate($name);

        if (empty($this->properties[$name]['type'])) {
            throw new \InvalidArgumentException('Type not found');
        }

        if ($this->properties[$name]['type'] !== self::WRITE) {
            throw new \InvalidArgumentException('Magic __set(\'' . $name . '\') is not installed');
        }

        $this->change($name, $value);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return
            \array_key_exists($name, $this->data) ||
            isset($this->properties[$name]);
    }

}
