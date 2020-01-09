<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test Load Graph from Server</title>
    </head>
    <body>
        <?php
            //setup data
            require_once("classes/Getter.class.php");
            $getter = new Getter();
            $graph = $getter->getGraph();
            echo "Graph: <br>";
            $graph->print();
        ?>
    </body>
</html>
