<?php

namespace Bavix\Geo\Comparator;

trait Comparable
{

    /**
     * @param self $object
     * @return int
     */
    abstract protected function comparison(self $object): int;

    /**
     * @param self $object
     * @return Comparator
     */
    public function compareTo(self $object): Comparator
    {
        return new Comparator($this->comparison($object));
    }

}
