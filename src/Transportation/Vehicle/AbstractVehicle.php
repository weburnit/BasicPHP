<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 10:49 PM
 */

namespace Paul\Transport\Transportation\Vehicle;

use Paul\Transport\Transportation\Location;
use Paul\Transport\Transportation\VehicleInterface;

/**
 * Class AbstractVehicle
 * @package Paul\Transport\Transportation\Vehicle
 */
abstract class AbstractVehicle implements VehicleInterface
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $totalSeats;

    /**
     * @var Location
     */
    private $currentLocation;

    private $active;

    /**
     * Bus constructor.
     *
     * @param string $uuid
     * @param string $name
     * @param int    $totalSeats
     */
    public function __construct($name, $uuid, $totalSeats)
    {
        $this->uuid       = $uuid;
        $this->name       = $name;
        $this->totalSeats = $totalSeats;
        $this->active     = true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return int
     */
    public function getTotalSeats():int
    {
        return $this->totalSeats;
    }

    /**
     * @return Location
     */
    public function getCurrentLocation(): Location
    {
        return $this->currentLocation;
    }

    /**
     * @param Location $currentLocation
     *
     * @return AbstractVehicle
     */
    public function setCurrentLocation($currentLocation)
    {
        $this->currentLocation = $currentLocation;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}