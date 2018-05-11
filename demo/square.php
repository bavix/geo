<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$center = new \Bavix\Geo\Coordinate(44.764558, 39.881960);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\MileUnit::class);
$square = $metrical->square($center, new \Bavix\Geo\Units\MileUnit(3));

//var_dump([
//    $metrical->distance($center, new \Bavix\Geo\Coordinate($square->getLeftUp()->getLatitudeDeg(), $center->getLongitudeDeg())),
//    $metrical->distance($center, new \Bavix\Geo\Coordinate($center->getLatitudeDeg(), $square->getLeftUp()->getLongitudeDeg())),
//]);

var_dump(\json_encode([
    'figure' => $square,
    'c1->c2' => $metrical->distance($center, $square->getLeftUp()),
    'c1->c3' => $metrical->distance($center, $square->getLeftDown()),
    'c1->c4' => $metrical->distance($center, $square->getRightUp()),
    'c1->c5' => $metrical->distance($center, $square->getRightDown()),

    'c2->c5' => $metrical->distance($square->getLeftUp(), $square->getRightDown()),
    'c3->c5' => $metrical->distance($square->getLeftDown(), $square->getRightDown()),
    'c4->c5' => $metrical->distance($square->getRightUp(), $square->getRightDown()),
], JSON_PRETTY_PRINT));
