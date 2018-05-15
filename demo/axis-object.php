<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$axis = new \Bavix\Geo\AxisProperty();

$axis->degrees = 100;
var_dump($axis->radian, $axis->degrees);

$axis->radian = 3;
var_dump($axis->radian, $axis->degrees);
