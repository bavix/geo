<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$unit1 = new \Bavix\Geo\Unit\Distance();
$unit1->miles = 10;

$unit2 = new \Bavix\Geo\Unit\Distance();
$unit2->kilometers = 10 * \Bavix\Geo\Unit\Provider\Kilometer::oneMile();

var_dump($unit1->compareTo($unit2)->lessThanOrEqual());
