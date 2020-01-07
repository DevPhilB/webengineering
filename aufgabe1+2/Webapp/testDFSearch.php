<?php

include 'classes/model/Departure.class.php';
include 'classes/model/Edge.class.php';
include 'classes/model/Graph.class.php';
// include 'classes/model/Line.class.php';
// include 'classes/model/Node.class.php';
include 'classes/model/PathNode.class.php';
include 'classes/DFSearch.php';

printf("Create graph and nodes.\n");
$graph = new Graph();
// Added twice node 1 should not be possible.
$graph->addNode(1);
$graph->addNode(1);
echo "\n";
$graph->addNode(2);
$graph->addNode(3);
$graph->addNode(4);
$graph->addNode(5);
$graph->addNode(6);
$graph->addNode(7);
$graph->addNode(8);

echo "\n \n";
echo "Create edges.\n";
// Default value for cost and line has to be 1.
$cost = 1;
$line = 1;
// Added twice the same edge should not be possible.
$graph->addEdge(1, 2, $cost, $line);
$graph->addEdge(1, 2, $cost, $line);
echo "\n";
$graph->addEdge(1, 3, $cost, $line);
$graph->addEdge(2, 5, $cost, $line);
$graph->addEdge(3, 4, $cost, $line);
$graph->addEdge(3, 6, $cost, $line);
$graph->addEdge(4, 2, $cost, $line);
$graph->addEdge(4, 7, $cost, $line);
$graph->addEdge(4, 8, $cost, $line);
$graph->addEdge(5, 6, $cost, $line);
$graph->addEdge(6, 2, $cost, $line);
$graph->addEdge(6, 7, $cost, $line);
$graph->addEdge(7, 5, $cost, $line);
$graph->addEdge(7, 8, $cost, $line);
$graph->addEdge(8, 3, $cost, $line);

echo "\n \n";
printf("Print tree... \n");
$graph->print();


echo "\n \n";
// Find path from 1 to 8.
echo "Search path... \n";
$searcher = new DFSearch();
echo "\n \n";
$solution = $searcher->dfsearch($graph, 1 , 8);
echo "\n \n";
$solution = $searcher->dfsearch($graph, 1 , 5);

foreach($solution as $path){
    $path->print();
}

echo "\n \n";
// No path from 6 to 1.
$searcher->dfsearch($graph, 2 , 1);
?>
