<?php
include 'classes/model/Departure.class.php';
include 'classes/model/Edge.class.php';
include 'classes/model/Graph.class.php';
include 'classes/model/Line.class.php';
include 'classes/model/Node.class.php';
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
// Default value for cost and line = 9
// Added twice the same edge should not be possible.
$graph->addEdge(1, 2, 9, 9);
$graph->addEdge(1, 2, 9, 9);
echo "\n";
$graph->addEdge(1, 3, 9, 9);
$graph->addEdge(2, 5, 9, 9);
$graph->addEdge(3, 4, 9, 9);
$graph->addEdge(3, 6, 9, 9);
$graph->addEdge(4, 2, 9, 9);
$graph->addEdge(4, 7, 9, 9);
$graph->addEdge(4, 8, 9, 9);
$graph->addEdge(5, 6, 9, 9);
$graph->addEdge(6, 2, 9, 9);
$graph->addEdge(6, 7, 9, 9);
$graph->addEdge(7, 5, 9, 9);
$graph->addEdge(7, 8, 9, 9);
$graph->addEdge(8, 3, 9, 9);

echo "\n \n";
printf("Print tree... \n");
$graph->print();

?>
