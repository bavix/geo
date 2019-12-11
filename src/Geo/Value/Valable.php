<?php

namespace Bavix\Geo\Value;

abstract class Valable implements \JsonSerializable
{

    const READ_ONLY = 1;
    const WRITE = 2;

    /**
     * @var string
     */
    protected $objectId;

    /**
     * @var array
     */
    protected $properties;

    /**
     * @var array
     */
    protected $extends;

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
        $this->objectId = \spl_object_id($this);

        if ($this->extends) {
            $this->properties = \array_merge_recursive(
                $this->properties,
                $this->extends
            );
        }

        foreach ((array)$data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return string
     */
    public function objectId(): string
    {
        return $this->objectId;
    }

    /**
     * @param array|null $data
     *
     * @return static
     */
    public static function make(array $data = null): self
    {
        return new static($data);
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        $name = \preg_replace('~([A-Z]{1})~', '_$1', $name, 1);
        list($method, $property) = \explode('_', $name, 2);

        if ($method !== 'from') {
            throw new \InvalidArgumentException('Method ' . $method . ' not found');
        }

        return static::make([
            \lcfirst($property) => $arguments[0] ?? 0
        ]);
    }

    /**
     * @return static
     */
    public function proxy(): self
    {
        static $proxies = [];

        if (empty($proxies[$this->objectId()])) {
            $proxies[$this->objectId()] = $self = clone $this;
            foreach ((array)$this->properties as $key => $value) {
                $self->properties[$key]['type'] = self::READ_ONLY;
            }
        }

        return $proxies[$this->objectId()];
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
            if (class_exists($callback, false)) {
                $this->dataSet($prop, $this->classModify($callback, $name, $prop));
                continue;
            }

            $this->dataSet($prop, $this->$callback($this->data[$name], $name, $prop));
        }
    }

    /**
     * @param string $prop
     * @param $mixed
     */
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

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->data;
    }

}
