<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:02 PM
 */

namespace Paul\Transport\Transportation;

class Location extends Coordinate
{
    /**
     * @var string
     */
    private $name;

    /**
     * Destination constructor.
     *
     * @param $name
     * @param $lat
     * @param $lon
     */
    public function __construct(string $name, float $lat, float $lon)
    {
        parent::__construct($lat, $lon);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}