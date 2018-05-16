<?php

namespace Bavix\Geo\Value;

abstract class Valable
{

    const READ_ONLY = 1;
    const WRITE = 2;

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
     * @return Valable
     */
    public static function make(array $data = null): self
    {
        return new static($data);
    }

    /**
     * @return static
     */
    public function proxy(): self
    {
        $self = clone $this;

        foreach ((array)$this->properties as $key => $value) {
            $self->properties[$key]['type'] = self::READ_ONLY;
        }

        return $self;
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
    protected function modifies(string $name, $value)
    {
        $this->data[$name] = $value;

        if (isset($this->properties[$name]['modify'])) {
            $this->modify($name, $this->properties[$name]['modify']);
        }
    }

    /**
     * @param string $name
     * @param array  $props
     */
    protected function modify(string $name, array $props)
    {
        foreach ($props as $prop => $callback) {
            if (class_exists($callback)) {
                $this->dataSet($prop, $this->classModify($callback, $name, $prop));
                continue;
            }

            $this->dataSet($prop, $this->$callback($this->data[$name], $name, $prop));
        }
    }

    protected function dataSet(string $prop, $mixed)
    {
        if ($mixed !== null) {
            $this->data[$prop] = $mixed;
        }
    }

    /**
     * @param string $class
     * @param string $name
     * @param string $prop
     *
     * @return mixed
     */
    protected function classModify(string $class, string $name, string $prop)
    {
        $object = new $class();

        if (!($object instanceof ValueInterface)) {
            throw new \InvalidArgumentException('Interface ' . ValueInterface::class . ' not found');
        }

        return $object->modify($this, $name, $prop);
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

        $this->modifies($name, $value);
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
