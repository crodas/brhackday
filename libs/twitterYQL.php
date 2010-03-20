<?php
require_once "";
class twitterYQL extends YQL{
	public static function getUserIds($tag){
		$query="select from_user_id from twitter.search where q = \"{$tag}\"";
		return self::query($query);
	}
	
	public static function getUserGeoLocation($userId){
		$query="select meta from twitter.user.profile where id=\"{$userId}\" and meta.property = \"geo:location\"";
		return self::query($query);
	}
	
	
}