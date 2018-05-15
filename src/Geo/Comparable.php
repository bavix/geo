<?php

namespace Bavix\Geo;

abstract class Comparable
{
    abstract public function compareTo(self $object): int;
}
