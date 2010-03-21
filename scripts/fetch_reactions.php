<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/lexicon.php";
require "YQL.php";

$news = new News;
/* already processed */
$news->where("processed", true);
/* that haven't  fetched reactions in more than 5 minutes */
$news->where("updated <", new MongoDate(strtotime("-5 minutes")));
/* That haven't been created not more than a day */
$news->where("created >", new MongoDate(strtotime("-1 day")));

foreach ($news as $item)
{
    var_dump(array($item->title, $item->tags));
}
