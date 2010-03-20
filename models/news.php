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
    }
    
    function setup()
    {
        $this->addIndex(array("source" => 1));
        $this->addIndex(array("url" => 1), array("unique" => 1));
        $this->addIndex(array("processed" => 1));
    }
}
