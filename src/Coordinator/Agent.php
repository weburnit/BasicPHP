<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 9:23 PM
 */

namespace Paul\Transport\Coordinator;

use Paul\Transport\Transportation\Exception\NoTicketException;
use Paul\Transport\Transportation\Exception\NoTransportationException;
use Paul\Transport\Transportation\Location;
use Paul\Transport\Transportation\StationInterface;

class Agent
{
    /**
     * @var BoardingCard[]
     */
    private $cards;

    /**
     * @var StationInterface[]
     */
    private $stationContracts;

    /**
     * @var array
     */
    private $graph;

    /**
     * Agent constructor.
     */
    public function __construct()
    {
        $this->cards            = [];
        $this->stationContracts = [];
        $this->graph            = [];
    }

    /**
     * Sign a contract with a specific station
     *
     * @param StationInterface $station
     *
     * @return $this
     */
    public function contractWith(StationInterface $station)
    {
        $this->stationContracts[$station->getName()] = $station;

        return $this;
    }

    /**
     * @param StationInterface $station
     *
     * @return bool
     */
    public function isContractWith(StationInterface $station):bool
    {
        return (bool) ($this->stationContracts[$station->getName()] ?? false);
    }

    /**
     * @param Location $location
     *
     * @return BoardingCard
     * @throws \Paul\Transport\Transportation\Exception\NoTransportationException
     * @throws \Paul\Transport\Transportation\Exception\NoTicketException
     */
    public function requestTicket(Location $location)
    {
        foreach ($this->stationContracts as $company) {
            try {
                $boardingCard = $company->receiveTicketRequest($location);

                return $boardingCard;
            } catch (NoTransportationException $e) {
                throw new NoTicketException('No available ticket for this company:'.$company->getName());
            }
        }
        throw new NoTransportationException('There no contracts in this agent');
    }

    /**
     * @param BoardingCard $card
     *
     * @return $this
     */
    public function addCard(BoardingCard $card)
    {
        $rootHash = spl_object_hash($card->getVehicle()->getCurrentLocation());

        $this->cards[$rootHash] = $card;
        $this->graph[$rootHash] = spl_object_hash($card->getDestination());

        return $this;
    }

    /**
     * @return array|BoardingCard[]
     */
    public function resolve()
    {
        $nodes = array_keys($this->graph);

        $edges = array_values($this->graph);

        $this->graph = [];

        $rootHash = current(array_diff($nodes, $edges));

        $resolveCards = [];

        for ($index = 0; $index < count($nodes); $index++) {
            $node = $this->cards[$rootHash] ?? null;
            if ($node) {
                $resolveCards[] = $node;
                $rootHash       = spl_object_hash($node->getDestination());
            }
        }

        $this->cards = $resolveCards;

        return $this->cards;
    }

    /**
     * @return string
     */
    public function printItinerary(): string
    {
        $document = '';
        foreach ($this->cards as $key => $card) {
            $document .= sprintf('%d. %s', ((int) $key) + 1, $card->getDescription().PHP_EOL);
        }
        $document .= sprintf('%d. %s', count($this->cards) + 1, 'You have arrived at your final destination');

        $this->cards = [];

        return $document;
    }
}