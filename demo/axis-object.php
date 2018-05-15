<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$axis = new \Bavix\Geo\AxisValue();

$axis->degrees = 100;
var_dump($axis->radian, $axis->degrees);

$axis->radian = 3;
var_dump($axis->radian, $axis->degrees);
