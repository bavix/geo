<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Unit\Distance;
use Bavix\Geo\Coordinate;
use Bavix\Geo\Metrical;

$center = new Coordinate(44.764558, 39.881960);

$unitX = Distance::fromMiles(4);
$unitY = Distance::fromMiles(3);

$metrical   = new Metrical();
$quadrangle = $metrical->rectangle(
    $center,
    $unitX,
    $unitY
);

echo \json_encode([
    'figure' => $quadrangle,

    'o->a' => $center->distanceTo($quadrangle->at(0))->miles,
    'o->b' => $center->distanceTo($quadrangle->at(1))->miles,
    'o->c' => $center->distanceTo($quadrangle->at(2))->miles,
    'o->d' => $center->distanceTo($quadrangle->at(3))->miles,

    'a->b' => $quadrangle->at(0)->distanceTo($quadrangle->at(1))->miles,
    'a->c' => $quadrangle->at(0)->distanceTo($quadrangle->at(2))->miles,
    'a->d' => $quadrangle->at(0)->distanceTo($quadrangle->at(3))->miles,
], JSON_PRETTY_PRINT);
