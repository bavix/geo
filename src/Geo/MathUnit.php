<?php

namespace Bavix\Geo;

use Bavix\Geo\Units\MileUnit;

class MathUnit
{

    /**
     * @param $value
     * @return float
     */
    protected static function miles($value): float
    {
        if (\is_object($value) && $value instanceof Unit)
        {
            return $value->miles();
        }

        return $value;
    }

    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function add($unit, $value): MileUnit
    {
        return new MileUnit(static::miles($unit) + static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function sub($unit, $value): MileUnit
    {
        return new MileUnit(static::miles($unit) - static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function div($unit, $value): MileUnit
    {
        return new MileUnit(static::miles($unit) / static::miles($value));
    }
    
    /**
     * @param Unit|float $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function mul($unit, $value): MileUnit
    {
        return new MileUnit(static::miles($unit) * static::miles($value));
    }
    
}
