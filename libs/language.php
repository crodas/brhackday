<?php 

// get_language$($text) {{{
function get_language($text)
{
    $tc = new TextCat;
    $tc->setDirectory(dirname(__FILE__).'/texts/');
    $result = $tc->getCategory($text);
    if (is_array($result)) {
        $result = $result[0];
    }
    unset($tc);
    return $result;
}
// }}}

