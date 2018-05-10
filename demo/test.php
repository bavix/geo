<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

// 1.02 km
$coord1 = new \Bavix\Geo\Coordinate(45.019369, 39.028994);
$coord2 = new \Bavix\Geo\Coordinate(45.023257, 39.017129);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\KilometerUnit::class);

var_dump($metrical->distance($coord1, $coord2));
