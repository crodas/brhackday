<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "YQL.php";

$sources = new Sources;
$sources->where("last_crawl <", new MongoDate(strtotime("-1 minutes")));

foreach ($sources as $source) {
    $results = YQL::query("SELECT * FROM rss WHERE url = :1", $source->rss);
    if (is_array($results['query']['results']['item'])) {
        foreach ($results['query']['results']['item'] as $id => $news) {
            $n = new News;
            $n->source  = $source->getID(); 
            $n->title   = $news['title'];
            $n->content = $news['description'];
            $n->url     = $news['link'];
            $n->save(false);
        }
    } 
    $source->save();
}

