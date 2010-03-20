<?php

class SimplePagerank 
{
    protected $graph;
    protected $nodes;
    protected $outlinks;

    public function addElement($source, $dest)
    {
        $graph    = & $this->graph;
        $outlinks = & $this->outlinks;

        $graph[$dest][] = $source;

        if (!isset($outlinks[$source])) {
            $outlinks[$source] = 0;
        }
        $outlinks[$source] += 1;
    }

    final public function setInitialValue($node, $value)
    {
        $this->nodes = $value;
    }

    final public function getReferencesTo($id)
    {
        $graph = & $this->graph;
        if (!isset($graph[$id])) {
            return false;
        }
        return $graph[$id];
    }

    final public function Init()
    {
        $graph = & $this->graph;
        $nodes = & $this->nodes;
        foreach ($graph as $id => &$links) {
            if (!isset($nodes[$id])) {
                $nodes[$id] = 0.15;
            }
            foreach ($links as $node) {
                if (!isset($nodes[$node])) {
                    $nodes[$node] = .15;
                }
            }
        }
    }

    final public function reset()
    {
        $this->graph = null;
        $this->nodes = null;
    }

    final public function subs($a, $b)
    {
       $array = array();
        foreach ($a as $i => $v) {
            if (!isset($b[$i])) {
                $array[$i] = $v;
            }
            $array[$i] = $v - $b[$i]; 
        }
        return $array;
    }

    final public function dot($a, $b)
    {
        $val = 0;
        foreach ($a as $i => $v) {
            if (!isset($b[$i])) {
                continue;
            }
            $val += $b[$i]  * $v;
        }
        return $val;
    }

    protected function convergence($current, $convergence)
    {
        $total = count($current);
        $diff  = $this->subs($current,$this->nodes);
        return (sqrt($this->dot($diff, $diff))/$total < $convergence);
    }

    protected function pagerank(&$tscores)
    {
        $graph    = & $this->graph;
        $scores   = & $this->nodes;
        $outlinks = & $this->outlinks; 
        foreach ($graph as $node => $links) {
            $score = 0;
            foreach ($links as $id) {
                $score += $scores[$id] / $outlinks[$id];
            }
            $score          = 0.15 + 0.85 * $score;
            $tscores[$node] = $score;
        }
    }

    final public function main($max=100, $convergence=0.0001)
    {
        $this->init();
        $graph   = & $this->graph;
        $scores  = & $this->nodes;
        $done    = false;

        for ($i=0; $i < $max && !$done; $i++) {
            $tscores = array();
            $this->pagerank($tscores);
            if ($i >  0) {
                $done = $this->convergence($tscores, $convergence);
            }
            $scores = $tscores;
        }
        arsort($scores);
        return $scores;
    }
    
    function getRanking()
    {
        return $this->nodes;
    }
    
}

