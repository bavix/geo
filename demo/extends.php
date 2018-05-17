<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

class MyDistance extends \Bavix\Geo\Unit\Distable
{

    /**
     * @return string
     */
    public static function property(): string
    {
        return Distance::PROPERTY_MY_DISTANCE;
    }

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'my distance';
    }

    /**
     * @return float
     */
    public static function oneMile(): float
    {
        return .5;
    }

}

/**
 * Class Distance
 * @property-read float $myDistance
 */
class Distance extends \Bavix\Geo\Unit\Distance
{
    const PROPERTY_MY_DISTANCE = 'myDistance';

    protected $extends = [
        self::PROPERTY_MY_DISTANCE => [
            'type' => self::READ_ONLY
        ],
        \Bavix\Geo\Unit\Distance::PROPERTY_MILES => [
            'modify' => [
                self::PROPERTY_MY_DISTANCE => MyDistance::class
            ],
        ],
    ];
}

$distance = new Distance([
    Distance::PROPERTY_MILES => 10
]);

var_dump($distance->myDistance);
var_dump($distance->wheels);
