<?php

include 'classes/model/Departure.class.php';
include 'classes/model/Edge.class.php';
include 'classes/model/Graph.class.php';

include 'classes/model/PathNode.class.php';
include 'classes/Dijkstra.php';

printf("Create graph and nodes.\n");
$graph = new Graph();

// path aufgabe 10
$graph->addNode(1);
$graph->addNode(2);
$graph->addNode(3);
$graph->addNode(4);
$graph->addNode(5);
$graph->addNode(6);


echo "\n \n";
echo "Create edges.\n";
// example from exercise presentation.
$line = 2;
$graph->addEdge(1, 2, 1, $line);
$graph->addEdge(1, 3, 2, $line);
$graph->addEdge(2, 4, 2, $line);
$graph->addEdge(2, 5, 5, $line);
$graph->addEdge(4, 5, 1, $line);
$graph->addEdge(4, 6, 4, $line);
$graph->addEdge(5, 6, 1, $line);


echo "\n \n";
printf("Print tree... \n");
$graph->print();


echo "\n \n";
// Find path from 1 to 8.
echo "Create dijkstra... \n";
$searcher = new Dijkstra();

$searcher->dijkstra($graph, $graph->findNode(1) ,2);


echo "Search path... \n";
$pathNodes = $searcher->getPath($graph->findNode(5));

foreach($pathNodes as $pathNode){
    $pathNode->print();
}

?>
