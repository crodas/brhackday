<?php
require "../config.php";
require "models/tags.php";

$tags = new Tags;
$arrtags = array();
foreach ($tags->show_popular() as $tag) {
    $arrtags[]= array("tag" => $tag->tag, "forca" => $tag->count);
}

echo json_encode(array("tags" => $arrtags));
