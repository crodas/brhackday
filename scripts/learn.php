<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/tags.php";
require "models/lexicon.php";
require "YQL.php";
require "language.php";
require "textrank/textrank.php";

$news = new News;
$news->where("processed", false);

foreach ($news as $item) {
    $text = null;
    if (isset($item->text)) {
        $text = $item->text;
    } else if (isset($item->content)) {
        $text = $item->content;
    } else {
        continue;
    }
    $lang = get_language($text);
    $pr = new TextRank;
    try {
        $pr->setMinWords(30);
        $pr->setWindowSize(2);
        $pr->setLanguage($lang);
        $pr->setText(strtolower($text));
        $pr->calculate();
        $keywords = array_keys($pr->getCandidates());

        $item->processed = true;
        $item->tags      = $keywords;
        $item->lang      = $lang;
        $item->save();
        
        $tag = new Tags;
        foreach ($keywords as $k) {
            $tag->reset();
            $tag->where("tag", $k);
            if (!$tag->valid() || $tag->count() == 0) {
                $tag->tag = $k;
                $tag->save();
            }
            $tag->count++;
            $tag->save();
        }

    } catch (Exception $e) {
    }
}
