<?php

class Lexicon extends ActiveMongo
{
    public $lang;
    public $token;
    public $type;
    public $extra;

    static $validates_presence_of = array(
        'lang',
        'token',
        'type',
    );

    function setup()
    {
        $this->addIndex(array("lang" => 1));
    }
}
