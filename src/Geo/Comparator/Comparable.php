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
     * @return Compare
     */
    public function compareTo(self $object): Compare
    {
        return new Compare($this->comparison($object));
    }

}
