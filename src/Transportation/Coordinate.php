<?php
/**
 * Created by PhpStorm.
 * User: paulnguyen
 * Date: 12/2/16
 * Time: 11:16 PM
 */

namespace Paul\Transport\Transportation;


class Coordinate
{
    /**
     * @var float
     */
    private $lat;

    /**
     * @var float
     */
    private $lon;

    /**
     * Coordinate constructor.
     *
     * @param float $lat
     * @param float $lon
     */
    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }


    /**
     * @param Coordinate $destination
     *
     * @return float
     */
    public function distanceTo(Coordinate $destination): float
    {
        $fromLat = $this->lat;
        $fromLon = $this->lon;
        $toLat   = $destination->getLat();
        $toLon   = $destination->getLon();

        $theta = $fromLon - $toLon;
        $dist  = sin(deg2rad($fromLat)) * sin(deg2rad($toLat)) + cos(deg2rad($fromLat)) * cos(deg2rad($toLat)) * cos(
                deg2rad($theta)
            );
        $dist  = acos($dist);
        $dist  = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;

        return ($miles * 1.609344);
    }

}