<?php
require_once("model/Graph.class.php");
require_once("model/Line.class.php");
require_once("model/Departure.class.php");
require_once("Departures.class.php");

// 1. a)
class Getter
{
    private $basicLink = "http://morgal.informatik.uni-ulm.de:8000/line/";

    // 1. a)
    function requestData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // 1. b)
    function getStopList()
    {
        return $this->requestData($this->basicLink . "stop/");
    }

    // 1. c)
    function getGraph()
    {
        $graph = new Graph();
        // Creates nodes.
        $stopList = json_decode($this->getStopList(), true);
        foreach ($stopList["stops"] as $key => $value) {
            $graph->addNode($key);
        }

        $data = json_decode($this->requestData($this->basicLink . "data/"), true);
        $edges = $data["lines"]; // all edges
        foreach ($edges as $edge) {
            // $edge["id"]; // start node.
            // $edge["display"]; // display
            // $edge["heading"]; // end node from line
            $line = new Line(1, $edge["display"], $edge["heading"]);

            $trips = $edge["trip"];
            foreach ($trips as $trip) {
                // $trip["stop"];  // end line for node
                // $trip["time"]; // dont know low number 1 or , maybe costs?
                $graph->addEdge($edge["id"],  $trip["stop"], 1, $line);
            }
        }
        return $graph;
    }

    // 1. e) 
    function getDepartures($stopId, $time){
        // Time should have format XX:XX
        // sample: http://morgal.informatik.uni-ulm.de:8000/line/stop/2/departure/?start=22:33
        $departureJson = $this->requestData($this->basicLink . "stop/". $stopId . "/departure/?start=". $time);
        $departureList = json_decode($departureJson, true);

        $departuresArray = array();
        foreach($departureList as $dep){
            $dateTime = $dep["time"]; // TODO: Convert to date time format.
            $departure = new Departure($dep["line"], $dep["display"], $dateTime);
            $departuresArray[] = $departure;
        }

       return new Departures($departuresArray);
    }
}
$gtter = new Getter();
// $ret = $gtter->getGraph();

// echo "Graph: </br>\n";
// $ret->print();

$gtter->getDepartures("2","22:33")->print();
?>