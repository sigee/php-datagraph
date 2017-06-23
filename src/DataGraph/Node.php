<?php

namespace DataGraph;

class Node
{
    /** @var string The name of the node */
    private $name;

    /** @var array Node data */
    private $data = array();

    /** @var string[] */
    private $edgesSourceOf = array();

    /** @var string[] */
    private $edgesTargetOf = array();

    /**
     * Node constructor.
     *
     * @param string $name
     * @param array $initData
     */
    public function __construct($name, $initData = array())
    {
        $this->name = $name;
        if (is_array($initData)) {
            $this->data = $initData;
        }
    }

    /**
     * Returns the node name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $edgeName
     */
    public function addToSources($edgeName)
    {
        array_push($this->edgesSourceOf, $edgeName);
    }

    /**
     * @param string $edgeName
     */
    public function addToTargets($edgeName)
    {
        array_push($this->edgesTargetOf, $edgeName);
    }

    /**
     * @return array
     */
    public function getSources()
    {
        return $this->edgesTargetOf;
    }

    /**
     * @return array
     */
    public function getTargets()
    {
        return $this->edgesSourceOf;
    }

    /**
     * Creates a new Node
     *
     * @param string $name
     * @param array $initData
     * @return Node
     */
    public static function createNode($name, $initData = null)
    {
        return new Node($name, $initData);
    }
}