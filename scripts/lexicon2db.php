#!/usr/bin/php
<?php
require "../config.php";
require "../libs/models.php";
ini_set('memory_limit', '64M');

$file = $argv[1];
$lang = $argv[2];

$content = bzdecompress(file_get_contents($argv[1]));
$r = new Lexicon;
$r->lang = $lang;
$r->deleteAll();

foreach (explode("\n", $content) as $line) {
    $info = explode(" ", $line);
    if (count($info) < 2) {
        continue;
    }
    $r = new Lexicon;
    $r->lang  = $lang;
    $r->token = strtolower($info[0]);
    $r->type  = $info[1];
    if (count($info) > 2) {
        $r->extra = array_slice($info, 2);
    }
    $r->save();
    unset($r);
}

