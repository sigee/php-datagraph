<?php

namespace DataGraph;

use PHPUnit\Framework\TestCase;

class EdgeTest extends TestCase
{
    public function testEdgeNameShouldBeGeneratedFromNodeNames()
    {
        $node1 = 'NodeOne';
        $node2 = 'NodeTwo';

        $edge = new Edge($node1, $node2);

        $this->assertEquals($node1 . '&&' . $node2, $edge->getName());
    }

    public function testCreateEdgeShouldCreateANewEdge(){
        $node1 = 'NodeOne';
        $node2 = 'NodeTwo';

        $edge = Edge::createEdge($node1, $node2);

        $this->assertInstanceOf(Edge::class, $edge);
    }
}
