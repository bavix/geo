<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

use Bavix\Geo\Comparator\Comparable;

class Datum
{

    use Comparable;

    /**
     * @var float
     */
    protected $data;

    /**
     * A constructor.
     *
     * @param float $data
     */
    public function __construct(float $data)
    {
        $this->data = $data;
    }

    /**
     * @return float
     */
    public function getData(): float
    {
        return $this->data;
    }

    /**
     * @param self $object
     *
     * @return int
     */
    protected function comparison(self $object): int
    {
        return $this->getData() <=> $object->getData();
    }

}

$a = new Datum(10.);
$b = new Datum(10.1);

var_dump($a->compareTo($b)->lessThanOrEqual());
