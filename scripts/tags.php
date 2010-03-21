<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/lexicon.php";
require "YQL.php";
require "language.php";
require "textrank/textrank.php";

$news = new News;
$news->where("processed", true);

foreach ($news as $item) {
    var_dump($item->url, $item->tags);
}
