<?php

namespace DataGraph;

class Graph
{
    /** @var Node[] */
    private $nodes = array();

    /** @var Edge[] */
    private $edges = array();

    /**
     * Graph constructor.
     */
    public function __construct()
    {
    }

    /**
     * Add a new node to the graph
     *
     * @param Node $node
     * @throws \Exception when node is already exists in the graph
     */
    public function addNode(Node $node)
    {
        $nodeName = $node->getName();
        if (in_array($nodeName, array_keys($this->nodes))) {
            throw new \Exception('node_already_exists: ' . $nodeName);
        } else {
            $this->nodes[$nodeName] = $node;
        }
    }

    /**
     * Gets node from graph by name
     *
     * @param string $nodeName
     * @return Node
     * @throws \Exception when node doesn't exists in the graph
     */
    public function getNode($nodeName)
    {
        if (!$this->isNodeExists($nodeName)) {
            throw new \Exception('node_not_exists: ' . $nodeName);
        } else {
            return $this->nodes[$nodeName];
        }
    }

    /**
     * Add a new edge to the graph
     *
     * @param Edge $edge
     * @throws \Exception when edge already exists in the graph or source or target node doesn't exists in the graph
     */
    public function addEdge(Edge $edge)
    {
        $edgeName = $edge->getName();
        if (in_array($edgeName, array_keys($this->edges))) {
            throw new \Exception('edge_already_exists: ' . $edgeName);
        } else {
            $sourceNodeName = $edge->getSourceNode();
            $targetNodeName = $edge->getTargetNode();
            if ($this->isNodeExists($sourceNodeName) === false || $this->isNodeExists($targetNodeName) === false) {
                throw new \Exception('source_or_target_node_doest_exist: ' . $sourceNodeName . ', ' . $targetNodeName);
            } else {
                $this->edges[$edgeName] = $edge;
                $this->getNode($sourceNodeName)->addToSources($targetNodeName);
                $this->getNode($targetNodeName)->addToTargets($sourceNodeName);
            }
        }
    }

    /**
     * Gets edge from the graph by node names
     *
     * @param string $sourceNodeName
     * @param string $targetNodeName
     * @return Edge
     * @throws \Exception when edge doesn't exists in the graph
     */
    public function getEdge($sourceNodeName, $targetNodeName)
    {
        $edgeName = $sourceNodeName . '&&' . $targetNodeName;
        if (!$this->isEdgeExists($sourceNodeName, $targetNodeName)) {
            throw new \Exception('edge_not_exists: ' . $edgeName);
        } else {
            return $this->edges[$edgeName];
        }
    }

    /**
     * Checks if node exists or not
     *
     * @param string $nodeName
     * @return bool
     */
    public function isNodeExists($nodeName)
    {
        if (in_array($nodeName, array_keys($this->nodes))) {
            return true;
        }
        return false;
    }

    /**
     * Checks if edge exists or not
     *
     * @param string $sourceNodeName
     * @param string $targetNodeName
     * @return bool
     */
    public function isEdgeExists($sourceNodeName, $targetNodeName)
    {
        $edgeName = $sourceNodeName . '&&' . $targetNodeName;
        if (in_array($edgeName, array_keys($this->edges))) {
            return true;
        }
        return false;
    }

    /**
     * @return Graph
     */
    public static function createGraph()
    {
        return new Graph();
    }

}