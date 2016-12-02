<?php

/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/3/16
 * Time: 1:40 AM
 */
namespace Paul\Transport\Transportation;

use Paul\Transport\Coordinator\BoardingCard;
use Paul\Transport\Transportation\Vehicle\Plane;

/**
 * Class AirportTest
 * @package Paul\Transport\Transportation
 */
class AirportTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Airport
     */
    private $airport;

    protected function setUp()
    {
        parent::setUp();

        $this->airport = new Airport('Test Airport');
    }

    public function testConstructor()
    {
        static::assertEquals('Test Airport', $this->airport->getName());
    }

    public function testAddVehicle()
    {
        $plane = $this->createMock(Plane::class);
        $plane->method('getUuid')->willReturn('XXYY');
        $result = $this->airport->addVehicle($plane);

        static::assertTrue($result, 'Must be able to add new plane');

        $xVehicle = $this->createMock(VehicleInterface::class);
        $result   = $this->airport->addVehicle($xVehicle);

        static::assertFalse($result, 'Airport should not be able to add unverified vehicle');
    }

    public function testGetAvailableVehicle()
    {
        $plane = $this->createMock(Plane::class);
        $plane->method('getUuid')->willReturn('XXYY');
        $plane->method('isActive')->willReturn(true);
        $this->airport->addVehicle($plane);
        static::assertEquals('XXYY', $this->airport->getAvailableVehicle()->getUuid());
    }

    /**
     * @expectedException \Paul\Transport\Transportation\Exception\NoTransportationException
     * @expectedExceptionMessage There are no plane available
     */
    public function testGetAvailableVehicleINull()
    {
        $plane = $this->createMock(Plane::class);
        $plane->method('getUuid')->willReturn('XXYY');
        $plane->method('isActive')->willReturn(false);
        $this->airport->addVehicle($plane);

        $this->airport->getAvailableVehicle()->getUuid();
    }

    public function testReceiveTicketQuest()
    {
        $bookingLocation = $this->createMock(Location::class);
        $planeLocation   = $this->createMock(Location::class);
        $planeLocation->method('distanceTo')->with($bookingLocation)->willReturn(1000);

        $plane = $this->createMock(Plane::class);
        $plane->method('getUuid')->willReturn('XXYY');
        $plane->method('isActive')->willReturn(true);
        $plane->expects(static::once())->method('transport');
        $plane->method('getCurrentLocation')->willReturn($planeLocation);
        $plane->method('getMaxDistance')->willReturn(1200);

        $this->airport->addVehicle($plane);

        $boardingPlane = $this->airport->receiveTicketRequest($bookingLocation);

        static::assertInstanceOf(BoardingCard::class, $boardingPlane, 'Must return a boarding plane');
        static::assertEquals($plane, $boardingPlane->getVehicle(), 'Must return same plane');
        static::assertEquals($bookingLocation, $boardingPlane->getDestination(), 'Must return same destination');
    }

    /**
     * @expectedException \Paul\Transport\Transportation\Exception\NoTransportationException
     * @expectedExceptionMessage There are no plane can reach this destination
     */
    public function testReceiveTicketQuestWithoutAnyTicketReachDestination()
    {
        $bookingLocation = $this->createMock(Location::class);
        $planeLocation   = $this->createMock(Location::class);
        $planeLocation->method('distanceTo')->with($bookingLocation)->willReturn(1000);

        $plane = $this->createMock(Plane::class);
        $plane->method('getUuid')->willReturn('XXYY');
        $plane->method('isActive')->willReturn(true);
        $plane->expects(static::never())->method('transport');
        $plane->method('getCurrentLocation')->willReturn($planeLocation);
        $plane->method('getMaxDistance')->willReturn(900);

        $this->airport->addVehicle($plane);

        $this->airport->receiveTicketRequest($bookingLocation);
    }
}
