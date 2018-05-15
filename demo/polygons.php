<?php

include_once \dirname(__DIR__) . '/vendor/autoload.php';

$polygon = new \Bavix\Geo\Polygon();

$center = new \Bavix\Geo\Coordinate(67.852064, -120.020849);

$metrical = new \Bavix\Geo\Metrical(\Bavix\Geo\Units\MileUnit::class);
$square = $metrical->squareByHypotenuse($center, new \Bavix\Geo\Units\MileUnit(100));

$polygon->addPoint($square->getLeftUp());
$polygon->addPoint($square->getRightUp());
$polygon->addPoint($square->getRightDown());
$polygon->addPoint($square->getLeftDown());

var_dump($polygon->contains(\Bavix\Geo\Coordinate::make(
    $square->getLeftUp()->getLatitudeDeg(),
    $square->getLeftUp()->getLongitudeDeg()
)));
