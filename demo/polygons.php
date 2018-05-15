<?php

include_once \dirname(__DIR__) . '/vendor/autoload.php';

$center = new \Bavix\Geo\Coordinate(67.852064, -120.020849);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\Mile::class);
$square = $metrical->squareByHypotenuse($center, new \Bavix\Geo\Units\Mile(100));

$polygon = $square->toPolygon();

var_dump($polygon->contains(\Bavix\Geo\Coordinate::make(
    $square->getLeftUp()->getLatitudeDeg(),
    $square->getLeftUp()->getLongitudeDeg()
)));
