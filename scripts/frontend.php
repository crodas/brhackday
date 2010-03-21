<?php
require "../config.php";
require "models/sources.php";
require "models/news.php";
require "models/tags.php";

class frontend{
	public static function getTagCloud(){
		$tags=new Tags();
		return $tags->where('processed',true);
	}
	public static function getNews($tag=NULL){
		if($tag===NULL)
			return $this->getAllNews();
		else
			return $this->getAllNews($tag);
	}
	private function getAllNews(){
		$news = new News();
		return $news->where('processed',true);
		
	}
	private function getNewsFromTags($tag){
		$news = new News();
		return $news->where('tag',$tag);
	} 
}