<?php

namespace Bavix\Geo;

interface Comparable
{
    public function compareTo(self $object): int;
}
