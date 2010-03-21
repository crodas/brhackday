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
    "OGlobo" => array("http://oglobo.globo.com/rss/plantao.xml", "'//div[@id=\"ltintb\"]/h3/text()', '//div[@id=\"ltintb\"]/p'"),
    "CNN Latest" => array("http://rss.cnn.com/rss/cnn_latest.rss", "'//div[@id=\"cnnContentContainer\"]/h1/text()', '//div[@class=\"cnn_strycntntlft\"]/p'"),
    "CNN" => array("http://rss.cnn.com/rss/cnn_topstories.rss","'//div[@id=\"cnnContentContainer\"]/h1/text()', '//div[@class=\"cnn_strycntntlft\"]/p'"),
    "New York Times" => array("http://feeds.nytimes.com/nyt/rss/HomePage", "'//h1[@class=\"articleHeadline\"]/text()', '//div[@class=\"articleBody\"]/p'"),
    "BBC Portuguese" => array("http://www.bbc.co.uk/portuguese/index.xml", "'//div[@class=\"g-container\"]/h1/text()', '//div[@class=\"bodytext\"]/p'"),
    "BBC Mundo" => array("http://www.bbc.co.uk/mundo/index.xml", "'//div[@class=\"g-container\"]/h1/text()', '//div[@class=\"bodytext\"]/p'"),
    "BBC" => array("http://www.bbc.co.uk/worldservice/full.xml", "'//div[@class=\"g-container\"]/h1/text()', '//div[@class=\"bodytext\"]/p'"),
	"Lancenet"=>"http://www.lancenet.com.br/export/rss/noticias.xml",
	"Uol"=> array("http://rss.home.uol.com.br/index.xml", "'//div[@class=\"integra\"]/h2/text()', '//div[@class=\"integra\"]/p'"),
	//"Estadao"=> array("http://www.estadao.com.br/rss/ultimas.xml", ""),
	"FolhaSp"=> array("http://feeds.folha.uol.com.br/folha/brasil/rss091.xml", "'//div[@id=\"articleNew\"]/h1/text()', '//div[@id=\"articleNew\"]/p'"),
	"IdgNow"=> array("http://idgnow.uol.com.br/RSS2/index.html", "'//div[@class=\"post\"]/h2/text()', '//div[@class=\"content\"]/p'"),
	"R7"=> array("http://www.r7.com/data/rss/brasil.xml", "'//h3[@id=\"h3_newstitle\"]/text()', '//div[@id=\"texto\"]'"),
	"EBand"=> array("http://www.band.com.br/rss/jornalismo.xml", "'//div[@id=\"cabecalho\"]/h1', '//div[@id=\"texto\"]'"),
	"JovemNerd"=> array("http://jovemnerd.ig.com.br/feed/","'//div[@class=\"post\"]/h2/text()', '//div[@class=\"entry\"]/p'"),
);

foreach ($sources as $name => $info) {
    $source = new Sources;
    $source->name  = $name;
    $source->rss   = $info[0];
    $source->xpath = $info[1]; 
    $source->save(false);
}

