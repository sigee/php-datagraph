<?php
require('vendor/autoload.php');

use DataGraph\Graph;
use DataGraph\Node;
use DataGraph\Edge;

// FIND PATH IN GRAPH


// ((( it is my example graph that will be used in more scripts )))
$nodes = array('GABOR', 'ARMIN', 'BELA', 'BENCE', 'ANDRAS', 'BALAZS', 'TODOR', 'TIHAMER',
    'ZOLTAN', 'UBUL', 'KALMAN', 'AGOSTON', 'GYORGY', 'GEZA', 'FERENC');

$edges = array(
    array('GABOR', 'ARMIN'), array('BELA', 'ARMIN'), array('ARMIN', 'BENCE'),
    array('BENCE', 'ANDRAS'), array('BENCE', 'BALAZS'), array('ANDRAS', 'TODOR'),
    array('TODOR', 'TIHAMER'), array('TIHAMER', 'BALAZS'),
    array('BALAZS', 'UBUL'), array('BALAZS', 'KALMAN'), array('KALMAN', 'FERENC'),
    array('FERENC', 'GEZA'), array('UBUL', 'GYORGY'), array('GYORGY', 'GEZA'),
    array('UBUL', 'AGOSTON'), array('UBUL', 'ZOLTAN')
);

$g = Graph::createGraph();

foreach ($nodes as $nodeName) {
    $g->addNode(Node::createNode($nodeName));
}

foreach ($edges as $edge) {
    list($source, $target) = $edge;
    $g->addEdge(Edge::createEdge($source, $target));
}


// FIND A PATH (FIRST FOUND, NOT THE SHORTEST ONE)
function find_path(Graph $graph, $start, $end, $path = array())
{
    //echo "$start $end ".json_encode($path)."<br />";
    array_push($path, $start);
    if ($start == $end) {
        return $path;
    } else {
        $targets = $graph->getNode($start)->getTargets();
        foreach ($targets as $start) {
            $rpath = find_path($graph, $start, $end, $path);
            if (is_array($rpath)) {
                return $rpath;
            }
        }
    }
}


echo "<pre>";
var_dump(find_path($g, 'GABOR', 'ZOLTAN'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'ARMIN', 'TIHAMER'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'ANDRAS', 'GEZA'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'FERENC', 'AGOSTON'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'BALAZS', 'BELA'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'BALAZS', 'UBUL'));
echo "</pre>";
echo "<hr />";

echo "<pre>";
var_dump(find_path($g, 'BELA', 'GEZA'));
echo "</pre>";
echo "<hr />";
