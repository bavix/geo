<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

// 2,76 км (1,71 мил.)
$coord1 = new \Bavix\Geo\Coordinate(45.012317, 39.053963);
$coord2 = new \Bavix\Geo\Coordinate(45.021130, 39.020961);

echo $coord1->distanceTo($coord2)->miles;
