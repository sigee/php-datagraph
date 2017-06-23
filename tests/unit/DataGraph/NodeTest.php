<?php

namespace DataGraph;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testCreateNodeShouldCreateANewNode()
    {
        $nodeName = 'NodeOne';

        $node = Node::createNode($nodeName);

        $this->assertInstanceOf(Node::class, $node);
        $this->assertEquals($nodeName, $node->getName());
    }
}
