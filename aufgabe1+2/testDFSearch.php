<?php
error_reporting( E_ALL );  // Melde alle PHP Fehler

require_once 'classes/model/Node.class.php';
require_once 'classes/model/Edge.class.php';
require_once 'classes/model/Graph.class.php';
require_once 'classes/DFSearch.php';

// Kanten
$edges = array(
  [1, 2],
  [1, 3],
  [2, 5],
  [3, 4],
  [3, 6],
  [4, 7],
  [4, 8],
  [4, 2],
  [5, 6],
  [6, 7],
  [6, 2],
  [7, 8],
  [7, 5],
  [8, 3]
);


$graph = new Graph();

for ($id = 1; $id <= 8; $id++) {
    $graph->addNode($id);
}

foreach($edges as $edge){
  $graph->addEdge($edge[0], $edge[1], 1, 1);
}

echo "Graph: </br>";
$graph->print();

//Wegfindung
echo "<br>Pfad von 1 nach 8:<br>";
$path = dfsearch($graph, "1", "8");
printPath($path);

echo "<br>Pfad von 7 nach 1:<br>";
$path = dfsearch($graph, "7", "1");
printPath($path);

function printPath($path) {
    if($path != -1){
      foreach($path as $pathNode){
        echo "from " . $pathNode->getId() . " on line " . $pathNode->getLine() . " with cost " . $pathNode->getCost() . "<br>";
      }
    } else{
      echo "Fehler: Keine Verbindung möglich!<br><br>";
    }
}
?>
