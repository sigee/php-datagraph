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
			$name = $node->getName();
			if (in_array($name, array_keys($this->nodes))) {
				throw new Exception('node_already_exists: '.$name);	
			} else {
				$this->nodes[$name] = $node;	
			}
		}
		
		public function getNode($name) {
			$node = $this->nodes[$name];
			if (is_null($node)) {
				throw new Exception('node_not_exists: '.$name);
			} else {
				return $node;	
			}
		}
		
		public function addEdge(Edge $edge) {
			$name = $edge->getName();
			if (in_array($name, array_keys($this->edges))) {
				throw new Exception('edge_already_exists: '.$name);	
			} else {
				$sourceNode = $edge->getSourceNode();
				$targetNode = $edge->getTargetNode();
				if ($this->isNodeExists($sourceNode) === false || $this->isNodeExists($targetNode) === false) {
					throw new Exception('source_or_target_node_doest_exist: '.$sourceNode.', '.$targetNode);	
				} else {
					$this->edges[$name] = $edge;
					$this->getNode($sourceNode)->addToSources($targetNode);
					$this->getNode($targetNode)->addToTargets($sourceNode);
				}
			}
		}
		
		public function getEdge($sNodeName, $tNodeName) {
			$name = $sNodeName.'&&'.$tNodeName;
			$edge = $this->edges[$name];
			if (is_null($edge)) {
				throw new Exception('edge_not_exists: '.$name);
			} else {
				return $edge;	
			}
		}
		
		public function isNodeExists($name) {
			if (in_array($name, array_keys($this->nodes))) {
				return true;	
			}
			return false;
		}
		
		public function isEdgeExists($sNodeName, $tNodeName) {
			$name = $sNodeName.'&&'.$tNodeName;
			if (in_array($name, array_keys($this->edges))) {
				return true;	
			}
			return false;
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
		
		public function getName() {
			return $this->name;	
		}
		
		public function addToSources($edgeName) {
			array_push($this->edgesSourceOf, $edgeName);
		}
		
		public function addToTargets($edgeName) {
			array_push($this->edgesTargetOf, $edgeName);
		}
		
		public function getSources() {
			return $this->edgesTargetOf;	
		}
		
		public function getTargets() {
			return $this->edgesSourceOf;	
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
		
		public function getSourceNode() {
			return $this->sourceNode;	
		}
		
		public function getTargetNode() {
			return $this->targetNode;	
		}
		
		public function getName() {
			return $this->name;	
		}
		
		public static function createEdge($sNodeName, $tNodeName, $initdata=null) {
			$edge = new Edge($sNodeName, $tNodeName, $initdata);
			return $edge;
		}
	}


