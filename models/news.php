<?php

class News extends ActiveMongo
{
    public $source;
    public $title;
    public $content;
    public $url;
    public $processed;
    public $languages;

    static $validates_presence_of = array(
        'source',
        'title', 
        'content',
        'url'
    );

    function before_create(&$obj)
    {
        /* Putting the new News in our processing queue */
        $obj['processed'] = false;
        $obj['created']   = new MongoDate;
    }

    function before_validate(&$obj)
    {
        $obj['updated'] = new MongoDate;
    }
    
    function setup()
    {
        $this->addIndex(array("source" => 1));
        $this->addIndex(array("url" => 1), array("unique" => 1));
        $this->addIndex(array("processed" => 1));
        $this->addIndex(array("processed" => 1, "updated" => 1, "created" => 1));
    }

function loadByTag($tag) {
	$col = $this->_getCollection();
	$cursor = $col->find(array('tags' => $tag, 'processed' => true));
	$cursor->limit(20);
	$this->setCursor($cursor);

	return $this;
}

}
