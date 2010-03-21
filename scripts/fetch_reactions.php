<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/lexicon.php";
require "models/twitter.php";
require "YQL.php";

$news = new News;
/* already processed */
$news->where("processed", true);
/* that haven't  fetched reactions in more than 5 minutes */
$news->where("updated <", new MongoDate(strtotime("-5 minutes")));

foreach ($news as $item)
{
    $count = count($item->tags);
    if ($count == 0) {
        continue;
    }

    if ($count > 3) {
        $ids = array();
        do {
            $ids[ rand(0,$count-1) ] = 1;
        } while (count($ids) != 3);
        $ids = array_keys($ids);
    } else {
        $ids = array_keys($item->tags);
    }
    
    $query = '';
    foreach ($ids as $id) {
        $query .= "{$item->tags[$id]} ";
    }

    $tweets = YQL::query("select * from twitter.search where q=:1", $query);
    if ($tweets['query']['count'] > 0) {
        foreach ((array)$tweets['query']['results']['results'] as $result) { 
            $twt = new Twitter;
            foreach ((array)$result as $key => $value) {
                $twt->$key = $value;
            }
            $twt->news = $item->getID();
            if (preg_match("/#([^ \.]+)/", $result['text'], $tags)) {
                $item->tags[] = $tags[1];
            }
            try {
                $twt->save();
                try {
                    $geo = YQL::query("select centroid.latitude, centroid.longitude from geo.places(1) where text in (select location from twitter.users where id=:1)", $result['from_user']);
                    if ($geo['query']['count'] == 1) {
                        $centroid = $geo['query']['results']['place']['centroid'];
                        $twt->latitude = $centroid['latitude'];
                        $twt->longitude = $centroid['longitude'];
                        $twt->save();
                    }
                } catch (Exception $e) {}
                $item->tweets++;
            } catch (Exception $e) {}
        }
        var_dump(array($item->url => $item->tweets));
    }
    $item->save(false);
}
