<?php

	require 'Graph.php';

	$g = Graph::createGraph(Graph::DIRECTED);
	var_dump($g);

	$g->addNode(Node::createNode('KÁLMÁN'));
	$g->addNode(Node::createNode('ÁBEL'));
	$g->addNode(Node::createNode('NÁNDOR'));
	$g->addNode(Node::createNode('ANDRÁS'));
	$g->addNode(Node::createNode('BÉLA'));
	//$g->addNode(Node::createNode('BÉLA')); /* testing duplication error */

	$g->addEdge(Edge::createEdge('ANDRÁS', 'BÉLA', array('weight'=>8)));
	$g->addEdge(Edge::createEdge('NÁNDOR', 'BÉLA', array('weight'=>2)));
	$g->addEdge(Edge::createEdge('ANDRÁS', 'KÁLMÁN', array('weight'=>15)));
	$g->addEdge(Edge::createEdge('KÁLMÁN', 'NÁNDOR', array('weight'=>30)));
	$g->addEdge(Edge::createEdge('ÁBEL', 'KÁLMÁN', array('weight'=>7)));
	//$g->addEdge(Edge::createEdge('ÁBEL', 'KÁLMÁN', array('weight'=>7))); /* testing duplication error */
	//$g->addEdge(Edge::createEdge('ÁBEL', 'BALÁZS', array('weight'=>80))); /* testing for not existing node */

	echo "<hr />";

	var_dump($g);

	echo "<hr />";

	var_dump($g->isNodeExists('BÉLA')); // should be TRUE
	var_dump($g->isNodeExists('KÁLMÁN')); // should be TRUE
	var_dump($g->isNodeExists('BALÁZS')); // should be FALSE

	echo "<hr />";

	var_dump($g->isEdgeExists('NÁNDOR', 'BÉLA')); // should be TRUE
	var_dump($g->isEdgeExists('BÉLA', 'NÁNDOR')); // should be TRUE if UNDIRECTED GRAPH, should be FALSE if DIRECTED GRAPH
	var_dump($g->isEdgeExists('KÁLMÁN', 'BÉLA')); // should be FALSE
	var_dump($g->isEdgeExists('BALÁZS', 'ZOLTÁN')); // should be FALSE

	echo "<hr />";

	$n = $g->getNode('ANDRÁS');
	var_dump($n->getSources()); // empty in DIRECTED GRAPH (there arent any edge to this node)
	var_dump($n->getTargets()); // 'BÉLA' and 'KÁLMÁN' in DIRECTED GRAPH (there are edges from this node to BÉLA and KÁLMÁN)

	echo "<hr />";

	$n = $g->getNode('NÁNDOR');
	var_dump($n->getSources());
	var_dump($n->getTargets());
