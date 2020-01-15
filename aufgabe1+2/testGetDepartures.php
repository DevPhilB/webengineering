<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test getDepartures from Server</title>
    </head>
    <body>
        <?php
            //setup data
            require_once("classes/Getter.class.php");
            $getter = new Getter();
            $dt = DateTime::createFromFormat("H:i", "15:00");
            $stopId = 93; // Ulm Universität Süd
            $departures = $getter->getDepartures($stopId, $dt);
            $departures->print();
            $lineId = 23; // line 5 with id 23
            $next = $departures->getNext($lineId, $dt);
           

            echo "\nNext departure at stop ".$stopId." after ".$dt->format("H:i")." is at ".$next->getTime()->format("H:i")." with line ".$next->getDisplay()." (line id ".$next->getLine().")<br>";

            echo "The delay for line ".$next->getDisplay()." is: ";
            echo $departures->getDelay($lineId, $dt)." minutes";
        ?>
    </body>
</html>
