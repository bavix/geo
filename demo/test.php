<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Coordinate;

// 2,76 км (1,71 мил.)
$coord1 = new Coordinate(45.012317, 39.053963);
$coord2 = new Coordinate(45.021130, 39.020961);

echo $coord1->distanceTo($coord2)->kilometers, PHP_EOL;
