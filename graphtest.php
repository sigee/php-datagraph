<?php

	require 'Graph.php';

	$g = Graph::createGraph(Graph::DIRECTED);
	var_dump($g);

	$g->addNode(Node::createNode('KÁLMÁN'));
	$g->addNode(Node::createNode('ÁBEL'));
	$g->addNode(Node::createNode('NÁNDOR'));
	$g->addNode(Node::createNode('ANDRÁS'));
	$g->addNode(Node::createNode('BÉLA'));

	$g->addEdge(Edge::createEdge('ANDRÁS', 'BÉLA', array('weight'=>8)));
	$g->addEdge(Edge::createEdge('NÁNDOR', 'BÉLA', array('weight'=>2)));
	$g->addEdge(Edge::createEdge('ANDRÁS', 'KÁLMÁN', array('weight'=>15)));
	$g->addEdge(Edge::createEdge('KÁLMÁN', 'NÁNDOR', array('weight'=>30)));
	$g->addEdge(Edge::createEdge('ÁBEL', 'KÁLMÁN', array('weight'=>7)));