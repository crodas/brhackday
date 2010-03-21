<?php

class Twitter extends ActiveMongo
{
    public $from_user;
    public $news;
    public $id;


    static $validates_presence_of = array(
        'from_user', 'news', 'id',
    );

    function setup()
    {
        $this->addIndex(array("id" => 1), array("unique"=>1));
    }

}
