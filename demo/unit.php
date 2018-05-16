<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$unit = new \Bavix\Geo\Unit\Unit();
$unit->miles = 10;

var_dump($unit);

$unit->yards = \Bavix\Geo\Unit\Provider\Yard::oneMile();
var_dump($unit);

$unit->miles = 1;
var_dump($unit);

$unit->wheels = \Bavix\Geo\Unit\Provider\Wheel::oneMile() * 2;
var_dump($unit);

