<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/lexicon.php";
require "models/tags.php";
require "YQL.php";
require "language.php";
require "textrank/textrank.php";
class frontend{
	public static function getTagCloud(){
		
	}
	public static function getNews($tag=NULL){
		if($tag===NULL)
			return $this->getAllNews();
		else
			return $this->getAllNews($tag);
	}
	private function getAllNews(){
		$news = new News();
		$news->where('processed',true);
	}
	private function getNewsFromTags($tag){
		$news = new News();
		$news->where('tag',$tag);
	} 
}