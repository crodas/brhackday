<?php
require "../config.php";
require "models/news.php";
require "models/twitter.php";

$news = new News;

$arr = array();

foreach ($news->loadByTag($_GET['tag']) as $item) {
	$rss = array("titulo" => $item->title, "url" => $item->url);

$twitter = new Twitter;
$twitter->where("news", $item->getId());

foreach ($twitter as $tweet) {
if ($tweet->latitude == null || $tweet->longitude == null) 
continue;

	$rss['idToMap'][] = array($tweet->latitude, $tweet->longitude);
}

	$arr[] = $rss;
}

echo json_encode(array("Results" => $arr));

//{"Results":[{"titulo":"Teste1","url":"http/\/www.uol.com.br","idtoMap":1},{"titulo":"Teste2","url":"http/\/www.terra.com.br","idtoMap":2}]}
