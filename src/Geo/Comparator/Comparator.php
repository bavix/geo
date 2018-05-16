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

    /**
     * @return bool
     */
    public function equal(): bool
    {
        return $this->cmp === 0;
    }

    /**
     * @return bool
     */
    public function less(): bool
    {
        return $this->cmp === -1;
    }

    /**
     * @return bool
     */
    public function greater(): bool
    {
        return $this->cmp === 1;
    }

    /**
     * @return bool
     */
    public function lessThanOrEqual(): bool
    {
        return $this->cmp < 1;
    }

    /**
     * @return bool
     */
    public function greaterThanOrEqual(): bool
    {
        return $this->cmp > -1;
    }

}
