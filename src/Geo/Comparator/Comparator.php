<?php

namespace Bavix\Geo\Comparator;

class Comparator
{

    /**
     * @var int
     */
    protected $cmp;

    /**
     * Compare constructor.
     * @param int $cmp
     */
    public function __construct(int $cmp)
    {
        $this->cmp = $cmp;
    }

    public static function equal(): bool
    {
        return false;
    }

    public static function less(): bool
    {
        return false;
    }

    public static function greater(): bool
    {
        return false;
    }

    public static function lessThanOrEqual(): bool
    {
        return false;
    }

    public static function greaterThanOrEqual(): bool
    {
        return false;
    }

}
