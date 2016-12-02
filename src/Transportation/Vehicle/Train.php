<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:24 PM
 */

namespace Paul\Transport\Transportation\Vehicle;

use Paul\Transport\Coordinator\BoardingCard;

class Train extends AbstractVehicle
{
    /**
     * @return float
     */
    public function getMaxDistance(): float
    {
        return 5000;
    }

    /**
     * @return float
     */
    public function getAverageSpeed(): float
    {
        return 80;
    }

    /**
     * @param BoardingCard $card
     *
     * @return bool
     */
    public function transport(BoardingCard $card): bool
    {
        echo sprintf('Bus %s is moving to %s', $this->getName(), $card->getDestination()->getName());
    }
}