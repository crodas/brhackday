<?php

class Tags extends ActiveMongo
{
    public $tag;
    public $lang;
    public $count;

    static $validates_presence_of = array(
        'tag', 'lang'
    );

    function setup()
    {
        $this->addIndex(array("tag" => 1, "lang" => 1), array("unique" => 1));
    }

}
