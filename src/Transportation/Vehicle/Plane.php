<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:24 PM
 */

namespace Paul\Transport\Transportation\Vehicle;


use Paul\Transport\Coordinator\BoardingCard;

class Plane extends AbstractVehicle
{
    /**
     * @var BoardingCard[]
     */
    private $seats;

    public function __construct($uuid, $name, $totalSeats)
    {
        parent::__construct($uuid, $name, $totalSeats);
        $this->seats = [];
    }


    /**
     * @return float
     */
    public function getMaxDistance(): float
    {
        return 25000;
    }

    /**
     * @return float
     */
    public function getAverageSpeed(): float
    {
        return 300;
    }

    /**
     * @param BoardingCard $card
     *
     * @return bool
     */
    public function transport(BoardingCard $card): bool
    {
        if ($this->getTotalSeats() <= count($this->seats)) {
            $this->seats[] = $card;
        }
    }

    public function isActive(): bool
    {
        if (count($this->seats) >= $this->getTotalSeats()) {
            return false;
        }

        return parent::isActive();
    }

}