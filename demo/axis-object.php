<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$axis = new \Bavix\Geo\Axis();

$axis->degrees = 100;
var_dump($axis->radian, $axis->degrees);

$axis->radian = 3;
var_dump($axis->radian, $axis->degrees);

$proxy = $axis->proxy();
//$proxy->degrees = 99;
var_dump($proxy->degrees);
