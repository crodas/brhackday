<?php
require "../config.php";
require "models/tags.php";

$tags = new Tags;
$arrtags = array();
foreach ($tags->find() as $tag) {
    $arrtags[$tag->tag] = $tag->count;
}

echo json_encode($arrtags);
