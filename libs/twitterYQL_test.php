<?php

require "../config.php";
require "twitterYQL.php";

$response = twitterYQL::getUserIds("yahoo");
var_dump($response);


$response = twitterYQL::getUserGeoLocation("alganet");
var_dump($response);


$response = twitterYQL::getGeoInfo("1");
var_dump($response);
