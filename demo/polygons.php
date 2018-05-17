<?php

include_once \dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Metrical;
use Bavix\Geo\Coordinate;
use Bavix\Geo\Unit\Distance;

$center = new Coordinate(67.852064, -120.020849);
$unit = Distance::fromMiles(100);

$metrical = new Metrical();
$square = $metrical->squareByHypotenuse($center, $unit);

$point = $square->at(3);

var_dump($square->contains($point));
