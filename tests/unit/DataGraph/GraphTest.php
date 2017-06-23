<?php

namespace DataGraph;

class GraphTest extends \PHPUnit_Framework_TestCase
{
    /** @var Graph $graph */
    private $graph;

    protected function setUp()
    {
        parent::setUp();
        $this->graph = new Graph();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->graph = null;
    }

    public function testAddNodeShouldAddTheGivenNodeToTheGraph()
    {
        $nodeName = 'NodeOne';
        $node = new Node($nodeName);

        $this->graph->addNode($node);

        $actualNode = $this->graph->getNode($nodeName);
        $this->assertInstanceOf(Node::class, $actualNode);
        $this->assertEquals($nodeName, $actualNode->getName());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage node_already_exists: NodeOne
     */
    public function testAddNodeShouldThrowExceptionWhenNodeAlreadyExistsInTheGraph()
    {
        $nodeName = 'NodeOne';
        $node = new Node($nodeName);

        $this->graph->addNode($node);
        $this->graph->addNode($node);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage node_not_exists: NodeOne
     */
    public function testGetNodeShouldThrowExceptionWhenNodeDoesNotExistsInTheGraph()
    {
        $this->graph->getNode('NodeOne');
    }

    public function testAddEdgeShouldAddTheGivenEdgeToTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $node1 = new Node($node1Name);
        $node2 = new Node($node2Name);
        $this->graph->addNode($node1);
        $this->graph->addNode($node2);
        $edge = new Edge($node1Name, $node2Name);

        $this->graph->addEdge($edge);

        $actualEdge = $this->graph->getEdge($node1Name, $node2Name);
        $this->assertInstanceOf(Edge::class, $actualEdge);
        $this->assertEquals('NodeOne&&NodeTwo', $actualEdge->getName());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage edge_already_exists: NodeOne&&NodeTwo
     */
    public function testAddEdgeShouldThrowExceptionWhenEdgeAlreadyExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $node1 = new Node($node1Name);
        $node2 = new Node($node2Name);
        $this->graph->addNode($node1);
        $this->graph->addNode($node2);
        $edge = new Edge($node1Name, $node2Name);

        $this->graph->addEdge($edge);
        $this->graph->addEdge($edge);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage source_or_target_node_doest_exist: NodeOne, NodeTwo
     */
    public function testAddEdgeShouldThrowExceptionWhenSourceNodeDoesNotExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $node2 = new Node($node2Name);
        $this->graph->addNode($node2);
        $edge = new Edge($node1Name, $node2Name);

        $this->graph->addEdge($edge);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage source_or_target_node_doest_exist: NodeOne, NodeTwo
     */
    public function testAddEdgeShouldThrowExceptionWhenTargetNodeDoesNotExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $node1 = new Node($node1Name);
        $this->graph->addNode($node1);
        $edge = new Edge($node1Name, $node2Name);

        $this->graph->addEdge($edge);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionCode 0
     * @expectedExceptionMessage edge_not_exists: NodeOne&&NodeTwo
     */
    public function testGetEdgeShouldThrowExceptionWhenEdgeDoesNotExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $this->graph->getEdge($node1Name, $node2Name);
    }

    public function testIsNodeExistsShouldReturnTrueWhenTheNodeExistsInTheGraph()
    {
        $nodeName = 'NodeOne';
        $node = new Node($nodeName);
        $this->graph->addNode($node);

        $this->assertTrue($this->graph->isNodeExists($nodeName));
    }

    public function testIsNodeExistsShouldReturnFalseWhenTheNodeDoesNotExistsInTheGraph()
    {
        $nodeName = 'NodeOne';

        $this->assertFalse($this->graph->isNodeExists($nodeName));
    }

    public function testIsEdgeExistsShouldReturnTrueWhenTheEdgeExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';
        $node1 = new Node($node1Name);
        $node2 = new Node($node2Name);
        $this->graph->addNode($node1);
        $this->graph->addNode($node2);
        $edge = new Edge($node1Name, $node2Name);
        $this->graph->addEdge($edge);

        $this->assertTrue($this->graph->isEdgeExists($node1Name, $node2Name));
    }

    public function testIsEdgeExistsShouldReturnFalseWhenTheEdgeDoesNotExistsInTheGraph()
    {
        $node1Name = 'NodeOne';
        $node2Name = 'NodeTwo';

        $this->assertFalse($this->graph->isEdgeExists($node1Name, $node2Name));
    }

    public function testCreateGraphShouldCreateANewGraph()
    {
        $graph = Graph::createGraph();

        $this->assertInstanceOf(Graph::class, $graph);
    }
}
