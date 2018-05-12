<?php

namespace Bavix\Geo;

class CompareUnit
{

    /**
     * @param Unit $first
     * @param Unit $second
     *
     * @return bool
     */
    public static function equal(Unit $first, Unit $second): bool
    {
        return $first->miles() === $second->miles();
    }

    /**
     * @param Unit $first
     * @param Unit $second
     *
     * @return bool
     */
    public static function less(Unit $first, Unit $second): bool
    {
        return $first->miles() < $second->miles();
    }

    /**
     * @param Unit $first
     * @param Unit $second
     *
     * @return bool
     */
    public static function greater(Unit $first, Unit $second): bool
    {
        return $first->miles() > $second->miles();
    }

    /**
     * @param Unit $first
     * @param Unit $second
     *
     * @return bool
     */
    public static function lessThanOrEqual(Unit $first, Unit $second): bool
    {
        return $first->miles() < $second->miles() || static::equal($first, $second);
    }

    /**
     * @param Unit $first
     * @param Unit $second
     *
     * @return bool
     */
    public static function greaterThanOrEqual(Unit $first, Unit $second): bool
    {
        return $first->miles() > $second->miles() || static::equal($first, $second);
    }

}
