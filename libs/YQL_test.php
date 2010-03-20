<?php

require "../config.php";
require "YQL.php";

$response = YQL::query("select * from geo.places where text='san francisco, ca'");
echo "<h1>single</h1>";
var_dump($response);

$responses = YQL::multiQuery(
    array(
        "select * from geo.places where text='san francisco, ca'", 
        'show tables'
    )
);

echo "<h1>multi</h1>";
var_dump($responses);
