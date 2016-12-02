<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:21 PM
 */

namespace Paul\Transport\Coordinator;


use Paul\Transport\Transportation\Location;
use Paul\Transport\Transportation\Vehicle\Plane;
use Paul\Transport\Transportation\Vehicle\Train;
use Paul\Transport\Transportation\VehicleInterface;

class BoardingCard
{
    /**
     * @var Location
     */
    private $destination;

    /**
     * @var string
     */
    private $description;

    /**
     * @var VehicleInterface
     */
    private $vehicle;

    /**
     * BoardingCard constructor.
     *
     * @param VehicleInterface $vehicle
     * @param Location         $destination
     * @param string           $description
     */
    public function __construct(VehicleInterface $vehicle, Location $destination, $description)
    {
        $this->destination = $destination;
        $this->description = $description;
        $this->vehicle     = $vehicle;
    }

    /**
     * @return Location
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        if ($this->vehicle instanceof Plane) {
            return sprintf(
                'From %s, take %s %s to %s. %s',
                $this->vehicle->getCurrentLocation()->getName(),
                $this->vehicle->getName(),
                $this->vehicle->getUuid(),
                $this->destination->getName(),
                $this->description
            );
        }
        if ($this->vehicle instanceof Train) {
            return sprintf(
                'Take %s %s from %s to %s. %s',
                $this->vehicle->getName(),
                $this->vehicle->getUuid(),
                $this->vehicle->getCurrentLocation()->getName(),
                $this->destination->getName(),
                $this->description
            );
        }

        return sprintf(
            'Take the %s %s from %s to %s. %s',
            $this->vehicle->getName(),
            $this->vehicle->getUuid(),
            $this->vehicle->getCurrentLocation()->getName(),
            $this->destination->getName(),
            $this->description
        );
    }

    /**
     * @return VehicleInterface
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
}