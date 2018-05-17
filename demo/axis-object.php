<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Value\Axis;

$axis = Axis::fromDegrees(100);

var_dump($axis->radian, $axis->degrees);

$axis->radian = 3;
var_dump($axis->radian, $axis->degrees);

try {
    $proxy = $axis->proxy();
    $proxy->degrees = 99;
} catch (\Throwable $throwable) {
    var_dump($throwable->getMessage(), $proxy->degrees);
}
