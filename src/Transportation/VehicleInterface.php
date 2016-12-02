<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:01 PM
 */

namespace Paul\Transport\Transportation;


use Paul\Transport\Coordinator\BoardingCard;

interface VehicleInterface
{
    /**
     * @return string
     */
    public function getUuid(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getMaxDistance(): float;

    /**
     * @return float
     */
    public function getAverageSpeed(): float;

    /**
     * @return int
     */
    public function getTotalSeats():int;

    /**
     * @param BoardingCard $card
     *
     * @return bool
     */
    public function transport(BoardingCard $card): bool;

    /**
     * @return Location
     */
    public function getCurrentLocation():Location;

    /**
     * @return bool
     */
    public function isActive(): bool;
}