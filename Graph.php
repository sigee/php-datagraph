<?php
	// 2017.01.08
	// mokuska@dataglobe.eu

	class Graph {
	
		private $type;
		private $nodes = array();
		private $edges = array();
		
		const UNDIRECTED = 0;
		const DIRECTED = 1;
		
		public function __construct($type = self::UNDIRECTED) {
			$this->type = $type;
		}
		
		public function addNode(Node $node) {
		}
		
		public function getNode($name) {
		}
		
		public function addEdge(Edge $edge) {
		}
		
		public function getEdge($sNodeName, $tNodeName) {
		}
		
		public function isNodeExists($name) {
		}
		
		public function isEdgeExists($sNodeName, $tNodeName) {
		}
		
		public static function createGraph($type = null) {
			$graph = new Graph($type);
			return $graph;
		}
	}


	class Node {
		
		private $name;
		private $data = array();
		private $edgesSourceOf = array();
		private $edgesTargetOf = array();
		
		public function __construct($name, $initdata=array()) {
			$this->name = $name;
			if (is_array($initdata)) {
				$this->data = $initdata;
			}
		}
		
		public static function createNode($name, $initdata=null) {
			$node = new Node($name, $initdata);
			return $node;
		}
	}


	class Edge {
		
		private $name;
		private $data = array();
		private $sourceNode;
		private $targetNode;
		
		public function __construct($sNodeName, $tNodeName, $initdata=array()) {
			$this->name = $sNodeName . '&&' . $tNodeName;
			if (is_array($initdata)) {
				$this->data = $initdata;
			}
			$this->sourceNode = $sNodeName;
			$this->targetNode = $tNodeName;
		}
		
		public static function createEdge($sNodeName, $tNodeName, $initdata=null) {
			$edge = new Edge($sNodeName, $tNodeName, $initdata);
			return $edge;
		}
	}


