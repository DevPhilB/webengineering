<?php
include_once 'model/Departure.class.php';
include_once 'model/Edge.class.php';
include_once 'model/Graph.class.php';
include_once 'model/Line.class.php';
include_once 'model/Node.class.php';
include_once 'model/PathNode.class.php';

// 2. b)

class DFSearch
{
    public $solutionFound = false;
    public $pathNodes = array();

    public function __constructor()
    {
        $this->solutionFound = false;
    }

    public function dfsearch($graph, $startId, $endId)
    {
        $startNode = $graph->findNode($startId);
        $endNode = $graph->findNode($endId);
        $this->dfsearchRec($graph, $startNode, $endNode, false);
        $this->solutionFound = false;
        $solution = $this->pathNodes;
        $this->pathNodes = array();
        return $solution;
    }

    function dfsearchRec($graph, $startNode, $endNode, $visited)
    {
        if ($this->solutionFound) {
            return;
        }
        if ($visited) {
            return;
        }
        if ($startNode->getId() == $endNode->getId()) {
            // new PathNode($startId, $startId);
            echo "Path found.\n";
            $this->solutionFound = true;
            return;
        } else {
            echo "From " . $startNode->getId() . " to " . $endNode->getId() . ". \n";
            $this->pathNodes[] = $startNode;
        }



        foreach ($startNode->getEdges() as $edge) {
            $this->dfsearchRec($graph, $edge->getEndNode(), $endNode, $this->isAlreadyNodeVisit($edge->getEndNode()));
        }
    }

    function isAlreadyNodeVisit($newNode)
    {
        if (is_array($this->pathNodes) || is_object($this->pathNodes)) {
            foreach ($this->pathNodes as $node) {
                if ($node->getId() == $newNode->getId()) {
                    echo "Node " . $newNode->getId() . " already visit \n";
                    return true;
                }
            }
            return false;
        }
    }
}
