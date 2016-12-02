<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:37 PM
 */

namespace Paul\Transport\Transportation;

use Paul\Transport\Coordinator\BoardingCard;
use Paul\Transport\Transportation\Exception\NoTransportationException;
use Paul\Transport\Transportation\Vehicle\Plane;

class Airport implements StationInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Plane[]
     */
    private $vehicles;

    /**
     * Airport constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Add vehicle to station
     *
     * @param VehicleInterface $vehicle
     *
     * @return bool
     */
    public function addVehicle(VehicleInterface $vehicle): bool
    {
        if ($vehicle instanceof Plane) {
            $this->vehicles[$vehicle->getUuid()] = $vehicle;

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return VehicleInterface
     * @throws \Paul\Transport\Transportation\Exception\NoTransportationException
     */
    public function getAvailableVehicle(): VehicleInterface
    {
        foreach ($this->vehicles as $plane) {
            if ($plane->isActive()) {
                return $plane;
            }
        }
        throw new NoTransportationException('There are no plane available');
    }

    /**
     * @param Coordinate $destination
     *
     * @return BoardingCard
     * @throws \Paul\Transport\Transportation\Exception\NoTransportationException
     */
    public function receiveTicketRequest(Coordinate $destination):BoardingCard
    {
        $availablePlan = $this->getAvailableVehicle();
        if ($availablePlan->getCurrentLocation()->distanceTo($destination) <= $availablePlan->getMaxDistance()) {
            $boarding = new BoardingCard($availablePlan, $destination, sprintf('Ticket Code %s', time()));
            $availablePlan->transport($boarding);

            return $boarding;
        }
        throw new NoTransportationException('There are no plane can reach this destination');
    }
}