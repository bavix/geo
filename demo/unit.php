<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Unit\Provider\Kilometer;
use Bavix\Geo\Unit\Distance;

$unit1 = new Distance();
$unit1->miles = 10;

$unit2 = new Distance([
    Distance::PROPERTY_KILOMETERS => 10 * Kilometer::oneMile()
]);

var_dump($unit1->compareTo($unit2)->lessThanOrEqual());
