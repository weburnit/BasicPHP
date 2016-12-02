<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:30 PM
 */

namespace Paul\Transport\Transportation;

use Paul\Transport\Coordinator\BoardingCard;

class BusStation implements StationInterface
{
    /**
     * Add vehicle to station
     *
     * @param VehicleInterface $vehicle
     *
     * @return bool
     */
    public function addVehicle(VehicleInterface $vehicle): bool
    {
        // TODO: Implement addVehicle() method.
    }

    /**
     * @param BoardingCard $card
     *
     * @return bool
     */
    public function transport(BoardingCard $card): bool
    {
        // TODO: Implement transport() method.
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    /**
     * @return VehicleInterface
     */
    public function getAvailableVehicle(): VehicleInterface
    {
        // TODO: Implement getAvailableVehicle() method.
    }

    public function receiveTicketRequest(Coordinate $coordinate):BoardingCard
    {

    }
}