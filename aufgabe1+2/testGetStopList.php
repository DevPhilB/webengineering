<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test getStopList from Server</title>
    </head>
    <body>
        <?php
            //setup data
            require_once("classes/Getter.class.php");
            $getter = new Getter();
            $stops = $getter->getStopList();
            echo "Stops (sortiert nach stop): <br>";
            foreach ($stops as $id => $stop) {
                echo "Stop ".$id.": ".$stop."<br>\n";
            }
            echo "<br><br>\n\n";
            ksort($stops);
            echo "Stops (sortiert nach id): <br>\n";
            foreach ($stops as $id => $stop) {
                echo "Stop ".$id.": ".$stop."<br>\n";
            }
        ?>
    </body>
</html>
