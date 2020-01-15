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

    // 1. d) returns depature object from array, if no object return null.
    function getNext($lineId, $time)
    {

        $minutes = $this->getDelay($lineId, $time);
        if ($minutes > 0) {
            return $this->getDepObject($lineId);
        }
        return null;
    }

    // 1. d) return minutes as int.
    function getDelay($line, $time)
    {

        $diff = $time->diff($this->getDepObject($line)->getTime());
        $minutes = $diff->i;
        if ($diff->invert == 0) {
            return intval($minutes);
        } else {
            return intval($minutes) * -1;
        }
    }

    // returns depature based on the id.
    function getDepObject($lineId)
    {
        foreach ($this->departureList as $departure) {
            if ($departure->getLine() == $lineId) {
                return $departure;
            }
        }
    }

    // prints the departure array.
    function print()
    {
        foreach ($this->departureList as $departure) {
            $departure->print();
        }
    }
}
