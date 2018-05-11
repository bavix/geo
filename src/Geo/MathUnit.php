<?php

namespace Bavix\Geo;

use Bavix\Geo\Units\MileUnit;

class MathUnit
{

    /**
     * @param Unit $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function add(Unit $unit, $value): MileUnit
    {
        if (\is_object($value) && $value instanceof Unit) {
            return new MileUnit($unit->miles() + $value->miles());
        }

        return new MileUnit($unit->miles() + $value);
    }
    
    /**
     * @param Unit $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function sub(Unit $unit, $value): MileUnit
    {
        if (\is_object($value) && $value instanceof Unit) {
            return new MileUnit($unit->miles() - $value->miles());
        }

        return new MileUnit($unit->miles() - $value);
    }
    
    /**
     * @param Unit $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function div(Unit $unit, $value): MileUnit
    {
        if (\is_object($value) && $value instanceof Unit) {
            return new MileUnit($unit->miles() / $value->miles());
        }

        return new MileUnit($unit->miles() / $value);
    }
    
    /**
     * @param Unit $unit
     * @param Unit|float $value
     * @return MileUnit
     */
    public static function mul(Unit $unit, $value): MileUnit
    {
        if (\is_object($value) && $value instanceof Unit) {
            return new MileUnit($unit->miles() * $value->miles());
        }

        return new MileUnit($unit->miles() * $value);
    }
    
}
