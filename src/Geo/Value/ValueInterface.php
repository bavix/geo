<?php

namespace Bavix\Geo\Value;

interface ValueInterface
{
    /**
     * @param Valable $object
     * @param string $name
     * @param string $prop
     * @return mixed
     */
    public static function modify(Valable $object, string $name, string $prop);
}
