<?php

abstract class BaseRank extends SimplePageRank
{
    private $_text;
    protected $language;

    // getText {{{
    /**
     *  Get current text 
     *
     *  @return string Current text 
     */
    final function getText()
    {
        return $this->_text;
    }
    /* }}} */

    //setText {{{
    /**
     *  Set Text to work with. 
     *
     * 
     */
    final function setText($text) 
    {
        $this->_text = $text;

        return $this->parseText($text);
    }
    /* }}} */

    // getWords {{{
    protected function getWords($text)
    {
        preg_match_all($this->getWordRegex(), $text, $words);
        $words = $words[1];
        return $words;
    }
    // }}}

    // getWordRegex {{{
    protected function getWordRegex()
    {
        return "/(([0-9]+(\,\.?[0-9]+)?)|[0-9a-záéíóúñ\-]+|[\);:,\.]?)[ \r\t\n]/i";
    }
    //}}}

    // addElement {{{
    /**
     *  Add "link" reference from an elemnet A to another 
     *  element B 
     *
     */
    final function addElement($source, $dest, $value=1)
    {
        if ($source==$dest) 
            return;
        $graph    = & $this->graph;
        $outlinks = & $this->outlinks;
        if (!isset($graph[$dest][$source])) {
            $graph[$dest][$source] = 0;
        }
        $graph[$dest][$source] += $value;
        if (!isset($outlinks[$source])) {
            $outlinks[$source] = 0;
        }
        $outlinks[$source] +=  $value;
    }
    /* }}} */

    // pagerank {{{
    final protected function pagerank(&$tscores)
    {
        $graph    = & $this->graph;
        $scores   = & $this->nodes;
        $outlinks = & $this->outlinks;
        foreach ($graph as $node => $links) {
            $score = 0;
            foreach ($links as $id => $val) {
                if (!isset($graph[$id])) {
                    continue;
                }
                $score += $val * $scores[$id] / $outlinks[$id];
            }
            $score          = 0.15 + 0.85 * $score;
            $tscores[$node] = $score;
        }
    }
    //}}}

    // calculate() {{{
    final function calculate($postphase = true)
    {
        $this->reset();
        $this->generateGraph();
        $this->main();
        if ($postphase) {
            $this->postProcessing();
        } else {
            $this->keywords = & $this->graph;
        }
        return $this->getCandidates();
    }
    //}}}

    final function setLanguage($lang)
    {
        $this->language = TR_Language::get($lang);
    }

    abstract public function dump();
    abstract public function getCandidates();
    abstract protected function parseText($text);
    abstract protected function generateGraph();
    abstract protected function postProcessing();

}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: sw=4 ts=4 fdm=marker
 * vim<600: sw=4 ts=4
 */
