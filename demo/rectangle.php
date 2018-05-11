<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$center = new \Bavix\Geo\Coordinate(44.764558, 39.881960);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\MileUnit::class);
$rectangle = $metrical->rectangle(
    $center,
    new \Bavix\Geo\Units\MileUnit(4),
    new \Bavix\Geo\Units\MileUnit(3)
);

//var_dump([
//    $metrical->distance($center, new \Bavix\Geo\Coordinate($rectangle->getLeftUp()->getLatitudeDeg(), $center->getLongitudeDeg())),
//    $metrical->distance($center, new \Bavix\Geo\Coordinate($center->getLatitudeDeg(), $rectangle->getLeftUp()->getLongitudeDeg())),
//]);

var_dump(\json_encode([
    'figure' => $rectangle,

    'c1->c2' => $metrical->distance($center, $rectangle->getLeftUp()),
    'c1->c3' => $metrical->distance($center, $rectangle->getLeftDown()),
    'c1->c4' => $metrical->distance($center, $rectangle->getRightUp()),
    'c1->c5' => $metrical->distance($center, $rectangle->getRightDown()),

    'c2->c5' => $metrical->distance($rectangle->getLeftUp(), $rectangle->getRightDown()),
    'c3->c5' => $metrical->distance($rectangle->getLeftDown(), $rectangle->getRightDown()),
    'c4->c5' => $metrical->distance($rectangle->getRightUp(), $rectangle->getRightDown()),
], JSON_PRETTY_PRINT));
