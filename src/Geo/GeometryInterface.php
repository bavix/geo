<?php

namespace Bavix\Geo;

interface GeometryInterface extends \Countable
{
    public function getPoints(): array;
}
