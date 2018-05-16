<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$center = new \Bavix\Geo\Coordinate(44.764558, 39.881960);

$unitX = \Bavix\Geo\Unit\Item::make([
    \Bavix\Geo\Unit\Item::PROPERTY_MILES => 4
]);

$unitY = \Bavix\Geo\Unit\Item::make([
    \Bavix\Geo\Unit\Item::PROPERTY_MILES => 3
]);

$metrical = new \Bavix\Geo\Metrical();
$rectangle = $metrical->rectangle(
    $center,
    $unitX,
    $unitY
);

echo \json_encode([
    'figure' => $rectangle,

    'o->a' => $metrical->distance($center, $rectangle->at(0))->miles,
    'o->b' => $metrical->distance($center, $rectangle->at(1))->miles,
    'o->c' => $metrical->distance($center, $rectangle->at(2))->miles,
    'o->d' => $metrical->distance($center, $rectangle->at(3))->miles,

    'a->b' => $metrical->distance($rectangle->at(0), $rectangle->at(1))->miles,
    'a->c' => $metrical->distance($rectangle->at(0), $rectangle->at(2))->miles,
    'a->d' => $metrical->distance($rectangle->at(0), $rectangle->at(3))->miles,
], JSON_PRETTY_PRINT);
