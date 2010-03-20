<?php

require "../config.php";
require "YQL.php";

$response = YQL::query('select * from geo.places where text="san francisco, ca"');
var_dump($response);
