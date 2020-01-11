<?php


// 1. d)
class Departures
{
    private $departureList;
    //constructor wants a departure array as parameter 
    function __construct($pdepartureList)
    {
        $this->departureList = $pdepartureList;
    }

    // gets id and datetime object
    function getNext($line, $time)
    {

        foreach ($this->departureList as $depature) {
            // TODO: Implement comparation from time and getTime()
            if ($depature->getLine() == $line && $depature->getTime() == $time) {
                return $depature;
            }
        }

        // returns depature object from array, if no object return null.
        return null;
    }

    // returns time till the next depature
    function getDelay($line, $time)
    {
        // Use date time and DateInterval
    }

    // Prints the departure array.
    function print()
    {
        foreach ($this->departureList as $departure) {
            $departure->print();
        }
    }
}
