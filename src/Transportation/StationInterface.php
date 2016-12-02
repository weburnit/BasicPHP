<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:30 PM
 */

namespace Paul\Transport\Transportation;


use Paul\Transport\Coordinator\BoardingCard;

/**
 * Interface StationInterface
 * @package Paul\Transport\Transportation
 */
interface StationInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * Add vehicle to station
     *
     * @param VehicleInterface $vehicle
     *
     * @return bool
     */
    public function addVehicle(VehicleInterface $vehicle): bool;

    /**
     * @return VehicleInterface
     */
    public function getAvailableVehicle(): VehicleInterface;

    /**
     * @param Coordinate $destination
     *
     * @return BoardingCard
     */
    public function receiveTicketRequest(Coordinate $destination):BoardingCard;
}