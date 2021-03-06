<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "YQL.php";
require "text_processing.php";

$sources = new Sources;
//$sources->where("last_crawl <", new MongoDate(strtotime("-1 minutes")));
$sources->where("last_crawl <", new MongoDate(strtotime("1 minutes")));

foreach ($sources as $source) {
    echo "{$source->rss}\n";
    try {
        $results = YQL::query("SELECT * FROM rss WHERE url = :1", $source->rss);
        if (@is_array($results['query']['results']['item'])) {
            foreach ($results['query']['results']['item'] as $id => $news) {
                if (@is_array($news['description'])) {
                    $news['description'] = r_implode("\n", $news['description']);
                }

                $n = new News;
                $n->source   = $source->getID(); 
                $n->title    = $news['title'];
                $n->content  = trim(strip_tags($news['description']));
                $n->url      = $news['link'];
                try {
                    $n->save(true);
                    $content = YQL::query("SELECT * FROM html WHERE url = :1 and xpath in({$source->xpath})", $news['link']);
                    if (@is_array($content['query']['results'])) {
                        $n->text = clean_html($content['query']['results']);
                        $n->save();
                    }
                } catch (Exception $e) {}
            }
        }
        $source->save();
        print "\tOK\n";
    } catch (Exception $e) {
        print "\tFailed (".$e->getMessage().")\n";
    }
}

