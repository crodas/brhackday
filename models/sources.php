<?php

class Sources extends ActiveMongo
{
    public $name;
    public $rss;
    public $xpath;

    static $validates_presence_of = array(
        'name', 'rss', 'xpath',
    );

    function before_validate(&$doc)
    {
        $doc['last_crawl'] = new MongoDate;
    }

    function setup()
    {
        $this->addIndex(array("rss" => 1), array("unique" => true));
        $this->addIndex(array("last_crawl" => 1));
    }
}
