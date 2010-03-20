<?php

require "../config.php";
require "twitterYQL.php";

$response = twitterYQL::getUserIds("yahoo");
var_dump($response);


$response = twitterYQL::getUserGeoLocation("alganet");
var_dump($response);


$response = twitterYQL::getGeoInfo("sao paulo sp brazil");
var_dump($response);
