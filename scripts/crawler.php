<?php
require "../config.php";
require "models/sources.php";
require "YQL.php";

/*
$source = new Sources;
$source->name = "Google News";
$source->rss  = "http://news.google.com/news?pz=1&cf=all&ned=en&hl=en&topic=h&num=3&output=rss";
$source->save();
*/

$sources = new Sources;
$sources->where("last_crawl <", new MongoDate(strtotime("-1 minutes")));
$sources->where("last_crawl <", new MongoDate());

foreach ($sources as $source) {
    $results = YQL::query("SELECT * FROM rss WHERE url = :1", $source->rss);
    var_dump($results->results);
    $source->save();
}

