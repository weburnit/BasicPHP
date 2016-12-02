<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/3/16
 * Time: 1:21 AM
 */

namespace Tests\Paul\Transport\Coordinator;


use Paul\Transport\Coordinator\BoardingCard;
use Paul\Transport\Transportation\Location;
use Paul\Transport\Transportation\Vehicle\Bus;
use Paul\Transport\Transportation\Vehicle\Plane;
use Paul\Transport\Transportation\Vehicle\Train;

class BoardingCardTest extends \PHPUnit_Framework_TestCase
{
    public function testTrainDescription()
    {
        $madrid = new Location('Madrid', 12, 13);
        $train  = new Train('train', '78A', 300);
        $train->setCurrentLocation($madrid);
        $bacelona      = new Location('Barcelona', 12, 13);
        $trainBoarding = new BoardingCard($train, $bacelona, 'Sit in seat 45B');

        static::assertEquals(
            'Take train 78A from Madrid to Barcelona. Sit in seat 45B',
            $trainBoarding->getDescription()
        );
    }

    public function testBusDescription()
    {
        $bacelona   = new Location('Barcelona', 12, 13);
        $airportBus = new Bus('Airport bus', '3254-A', 50);
        $airportBus->setCurrentLocation($bacelona);
        $geronaAirport = new Location('Gerona Airport', 15, 16);
        $busTicket     = new BoardingCard($airportBus, $geronaAirport, 'No seat assignment');

        static::assertEquals(
            'Take the Airport bus 3254-A from Barcelona to Gerona Airport. No seat assignment',
            $busTicket->getDescription()
        );
    }

    public function testPlaneDescription()
    {
        $geronaAirport = new Location('Gerona Airport', 15, 16);
        $airplane      = new Plane('Plane', 'SK455', 250);
        $airplane->setCurrentLocation($geronaAirport);
        $stockholm = new Location('Stockholm', 17, 18);
        $airTicket = new BoardingCard($airplane, $stockholm, 'Gate 45B, seat 3A. Baggage drop at ticket counter 344');

        static::assertEquals(
            'From Gerona Airport, take Plane SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344',
            $airTicket->getDescription()
        );
    }
}