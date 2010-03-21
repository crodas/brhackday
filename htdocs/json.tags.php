<?php
require "../config.php";
require "libs/tags.php";

$tags = new Tags;
$arrtags = array();
foreach ($tags->find() as $tag) {
    $arrtags[$tag->tag] = $tag->count;
}

echo json_encode($arrtags);
