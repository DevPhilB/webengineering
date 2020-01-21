<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WebEng 2019 - Dijkstra Vorarbeiten</title>
</head>

<body>
    <?php
    //setup data
    require_once("classes/Dijkstra.php");
    $d = new Dijkstra();
    $dt = new DateTime();
    // see http://www.php.net/manual/en/function.date.php
    echo "original time: " . $dt->format('H:i:s') . "<br>\n";
    $ndt = $d->addTime($dt, 5); // add 5 min
    echo "original time after add: " . $dt->format('H:i:s') . "<br>\n";
    echo "new time after adding 5 min: " . $ndt->format('H:i:s') . "<br>\n";

    $s = file_get_contents('graph');
    $graph = unserialize($s);
    $endNode = $graph->findNode("70");
    $result = $d->getPath($endNode);
    echo "<br>Pfad (s=93, e=70): <br>\n";
    foreach ($result as $pathNode) {
        echo $pathNode->getId() . " (cost: " . $pathNode->getCost() . ", line: " . $pathNode->getLine()->getDisplay() . ") <br>\n";
    }

    $costs = array("3", "5", "1", "7");
    $process = array();
    for ($i = 0; $i < count($costs); $i++) {
        $process[$i] = new Node($i);
        $process[$i]->setCost($costs[$i]);
    }
    $min = $d->extractMinimum($process);
    echo "<br>Min Kosten: " . $min->getCost() . " min ID: " . $min->getId() . " . <br>";
    ?>

</body>

</html>