<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "YQL.php";

// simple way to delete all collections and add rss to fetch

Sources::drop();
News::drop();

ActiveMongo::install();

$sources = array(
    "OGlobo" => "http://oglobo.globo.com/rss/plantao.xml",
    "Terra"  => "http://rss.terra.com.br/0,,EI1,00.xml",
    "Portal Brasil News" => "http://feeds.feedburner.com/PortalBrasilNews",
    "CNN Latest" => "http://rss.cnn.com/rss/cnn_latest.rss",
    "CNN" => "http://rss.cnn.com/rss/cnn_topstories.rss",
    "New York Times" => "http://feeds.nytimes.com/nyt/rss/HomePage",
    "BBC Portuguese" => "http://www.bbc.co.uk/portuguese/index.xml",
    "BBC Mundo" => "http://www.bbc.co.uk/mundo/index.xml",
    "BBC" => "http://www.bbc.co.uk/worldservice/full.xml",
	"Lancenet"=>"http://www.lancenet.com.br/export/rss/noticias.xml",
	"Uol"=>"http://rss.home.uol.com.br/index.xml",
	"Estadao"=>"http://www.estadao.com.br/rss/ultimas.xml",
	"FolhaSp"=>"http://feeds.folha.uol.com.br/folha/brasil/rss091.xml",
	"IdgNow"=>"http://idgnow.uol.com.br/RSS2/index.html",
	"R7"=>"http://www.r7.com/data/rss/brasil.xml",
	"EBand"=>"http://www.band.com.br/rss/jornalismo.xml",
	"JovemNerd"=>"http://jovemnerd.ig.com.br/feed/"
);

foreach ($sources as $name => $rss) {
    $source = new Sources;
    $source->name = $name;
    $source->rss  = $rss;
    $source->save(false);
}

