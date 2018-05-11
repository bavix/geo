<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

//$center = new \Bavix\Geo\Coordinate(44.764558, 39.881960);
$center = new \Bavix\Geo\Coordinate(67.852064, -120.020849);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\MileUnit::class);
$square = $metrical->squareByHypotenuse($center, new \Bavix\Geo\Units\MileUnit(100));

echo \json_encode([
    'figure' => $square,
    'c1->c2' => $metrical->distance($center, $square->getLeftUp()),
    'c1->c3' => $metrical->distance($center, $square->getLeftDown()),
    'c1->c4' => $metrical->distance($center, $square->getRightUp()),
    'c1->c5' => $metrical->distance($center, $square->getRightDown()),

    'c2->c5' => $metrical->distance($square->getLeftUp(), $square->getRightDown()),
    'c3->c5' => $metrical->distance($square->getLeftDown(), $square->getRightDown()),
    'c4->c5' => $metrical->distance($square->getRightUp(), $square->getRightDown()),
], JSON_PRETTY_PRINT);
