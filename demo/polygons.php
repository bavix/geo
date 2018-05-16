<?php

include_once \dirname(__DIR__) . '/vendor/autoload.php';

$center = new \Bavix\Geo\Coordinate(67.852064, -120.020849);

$unit = new \Bavix\Geo\Unit\Item();
$unit->miles = 100;

$metrical = new \Bavix\Geo\Metrical();
$square = $metrical->squareByHypotenuse($center, $unit);

$point = $square->at(3);

var_dump($square->contains($point));
