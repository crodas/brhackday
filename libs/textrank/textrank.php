<?php
define("TEXTRANK_PATH", dirname(__FILE__));

require_once TEXTRANK_PATH."/pagerank.php";
require_once TEXTRANK_PATH."/baserank.php";
require_once TEXTRANK_PATH."/baselang.php";
require_once TEXTRANK_PATH."/exceptions.php";

/**
 *  TextRank
 *
 *  This class implements the TextRank Algorithm described
 *  in http://crodas.org/weird-but-cool-pageranks-usage.php
 *
 *  Basically it build a graph of co-ocurrence words and then
 *  calculates the Pagerank over the graph, ranking importants
 *  words.
 *
 *  @author crodas
 *  
 *
 */
class TextRank extends BaseRank
{
    /**
     *  Array contain
     *
     */
    private $_text;
    private $_mini_text;
    private $_window = 2;
    /** 
     *  Text to ID, index
     *  
     *  @private
     */
    private $_text2id;
    /** 
     *  ID to Text, index
     *  
     *  @private
     */
    private $_id2text;
    private $_min = null;
    protected $keywords;

    // parseText($text) {{{
    function parseText($text)
    {
        /* Fetch all words from the text */
        $words = $this->getWords($text);
        if (count($words) < MIN_WORD) {
            throw new MinWordsException();
        }

        $this->language->setText($words);

        /* prepare indexes for fast lookup */
        $iWords = array_unique($words);

        /* word to ID */
        $iWords = array_combine($iWords, range(1, count($iWords)));

        /* ID to word */
        $irWords = array_combine($iWords, array_keys($iWords));

        foreach ($words as &$w) {
            $w = $iWords[$w];
        }

        $this->_text    = $words;
        $this->_text2id = $iWords;
        $this->_id2text = $irWords;
    }
    // }}}

    // setWindowSize($window) {{{
    final function setWindowSize($window)
    {
        if ((int)$window > 0) {
            $this->_window = (int)$window;
            return true;
        }
        return false;
    }
    // }}}

    // generateGraph() {{{
    protected function generateGraph()
    {
        $window  = $this->_window;
        $words   = &$this->_text;
        $iWords  = &$this->_text2id;
        $irWords = &$this->_id2text;
        $pzText  = &$this->_mini_text;

        $pzText = array();

        $prev  = array();
        $e     = 1;
        $valid = array();

        if (is_int($this->_min) && $this->_min > count($words)) {
            throw new MinWordsException();
        }
        
        foreach ($words as $pos=>$wid) {
            $word = $irWords[$wid];
            if (!isset($valid[$word])) {
                $valid [$word] = $this->language->isValid($word);
            }

            if (!$valid[$word]) {
                continue;
            }
            $pzText[$e] = array($wid, $pos);
            foreach ($prev as $pprev) {
                if ($pprev == $wid) continue;
                $this->addElement($pprev, $wid, 1);
                $this->addElement($wid, $pprev, 1);
            }
            if ($e++ >= $window) {
                $push = array_shift($prev);
            }
            $prev[] = $wid;
        }
    }
    // }}}

    // getCandidates() {{{
    function getCandidates()
    {
        $irWords = & $this->_id2text;
        $key     = array();
        foreach ($this->keywords as $id => $pr) {
            $value       = $irWords[$id];
            $key[$value] = $pr;
            if (count($key)==10) break;
        }
        return $key;
    }
    // }}} 

    // postProcessing() {{{
    protected function postProcessing()
    {
        $result = $this->getRanking();
        $graph  = & $this->graph;
        $iWords = & $this->_id2text;
        $max    = 10;
        $pzText = & $this->_mini_text;

        $result   = current(array_chunk($result, (int)count($result)/3, 1));
        $keywords = array();

        foreach ($pzText as $pos => $info) {
            if (isset($result[$info[0]])) {
                $keywords[$info[1]] = $info[0];
            }
        }

        ksort($keywords);
        $tmp    = array();
        $last   = null;
        $kwords = array();
        $punct  = str_split(',!;?])');
        $todel  = array();

        // search for multiwords keywords {{{
        foreach ($keywords as $pos => $wid) {
            if (!is_int($last) || $last+1 != $pos || array_search($iWords[$wid], $punct)!==false) {
                if (count($tmp) > 1) {
                    $kword = '';
                    $rank  = 0;
                    foreach ($tmp as $w) {
                        $kword .= $iWords[$w].' ';
                        if (isset($result[$w])) {
                            $rank  += $result[$w];
                            $todel[$w] = 1;
                        }
                    }
                    $kword = trim($kword);
                    if (!isset($kwords[$kword]))
                        $kwords[$kword] = 0;
                    $kwords[$kword] += $rank/count($tmp); 
                }
                $tmp = array();
            }
            $last = $pos;
            $tmp[] = $wid;
        } 
        if (count($tmp) > 1) {
            $kword = '';
            $rank  = 0;
            foreach ($tmp as $w) {
                $kword .= $iWords[$w].' ';
                if (isset($result[$w])) {
                    $rank  += $result[$w];
                    $todel[$w] = 1;
                }
            }
            $kword = trim($kword);
            if (!isset($kwords[$kword]))
                $kwords[$kword] = 0;
            $kwords[$kword] += $rank/count($tmp); 
        }
        // }}}

        foreach ($todel as $key=>$val) {
            unset($result[$key]);
        }

        foreach ($kwords as $key=>$pr) {
            $iWords[] = $key;
            $last     = count($iWords); 
            $result[$last] = $pr;
        }


        arsort($result);
        $this->keywords = $result;
    }
    // }}}

    // code() {{{
    /**
     *  DUMP the information in a readable HTML code
     *
     */
    function dump()
    {
        $irWords = & $this->_id2text;
        $result  = $this->keywords;
        $out     = & $this->outlinks;
        $i = 0;
        foreach ($result as $id => $pr) {
            $value = $irWords[$id];
            print $i.") $value [PR=$pr,docid=$id]  <br/><br/>\n";
            if (++$i == 50) break;
        }
    }
    // }}}

    // setMinWords() {{{
    final function setMinWords($min)
    {
        if (is_int($min) && $min > 0) {
            $this->_min = $min;
        }
    }
    // }}}

    // getGraph() {{{
    function getGraph()
    {
        return array($this->graph, $this->_id2text, );
        $graph = array();
        $words = & $this->_id2text;
        foreach ($this->graph as $key => $val) {
            $graph[ $words[$key] ] = array();
            
            $tmp = & $graph[ $words[$key] ];
            foreach ($val as $key => $val) {
                $tmp[] = $words[$key];
            }
        }
        return $graph;
    }
    // }}}

    function getKeywordsLocation($keys)
    {
        $pzWords = & $this->_text2id;
        $graph   = $this->getRanking();
        $result  = array();
        foreach ($keys as $key) {
            if (isset($pzWords[$key])) {
                $wordid       = $pzWords[$key];
                $result[$key] = isset($graph[$wordid]) ? $graph[$wordid] : 0.15;
            } else { 
                $result[$key] = -1;
            }
        }
        arsort($result);
        return $result;
    }

}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: sw=4 ts=4 fdm=marker
 * vim<600: sw=4 ts=4
 */
