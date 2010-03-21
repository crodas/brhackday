<?php

class Tags extends ActiveMongo
{
    public $tag;
    public $lang;
    public $count;

    static $validates_presence_of = array(
        'tag'
    );

function show_popular() {
	$col = $this->_getCollection();
	$cursor = $col->find();
	$cursor->limit(15);
	$cursor->sort(array("count" => -1, "tag" => -1));

	$this->setCursor($cursor);

	return $this;;

	$this->setCursor($cursor);

	return $this;
}

    function setup()
    {
        $this->addIndex(array("tag" => 1), array("unique" => 1));
    }

}
