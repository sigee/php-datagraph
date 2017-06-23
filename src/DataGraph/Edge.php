<?php

namespace DataGraph;

class Edge
{
    /** @var string The name of the Edge */
    private $name;

    /** @var array Edge data */
    private $data = array();

    /** @var string The name of the source node */
    private $sourceNode;

    /** @var string The name of the target node */
    private $targetNode;

    /**
     * Edge constructor.
     *
     * @param string $sourceNodeName
     * @param string $targetNodeName
     * @param array $initData
     */
    public function __construct($sourceNodeName, $targetNodeName, $initData = array())
    {
        $this->name = $sourceNodeName . '&&' . $targetNodeName;
        if (is_array($initData)) {
            $this->data = $initData;
        }
        $this->sourceNode = $sourceNodeName;
        $this->targetNode = $targetNodeName;
    }

    /**
     * Returns the source node name
     *
     * @return string
     */
    public function getSourceNode()
    {
        return $this->sourceNode;
    }

    /**
     * Returns the target node name
     *
     * @return string
     */
    public function getTargetNode()
    {
        return $this->targetNode;
    }

    /**
     * Returns the edge name
     *
     * @return string
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * Creates a new Edge
     *
     * @param string $sourceNodeName
     * @param string $targetNodeName
     * @param array $initData
     * @return Edge
     */
    public static function createEdge($sourceNodeName, $targetNodeName, $initData = null)
    {
        $edge = new Edge($sourceNodeName, $targetNodeName, $initData);
        return $edge;
    }
}
