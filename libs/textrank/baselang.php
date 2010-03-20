<?php

abstract class TR_Language
{
    private static $_ldir = 'languages';
    private static $_loaded = array();

    public function getStopwords()
    {
        return array();
    }

    public function isValid($word)
    {
        return strlen($word) > 2;
    }

    public function getStemmedWord($word)
    {
        return $word;
    }

    final public static function get($name)
    {
        self::load($name);
        $class = 'TR_Lang_'.$name;
        return new $class;
    }

    function setText($text)
    {
    }

    final public static function load($name)
    {
        $file = self::$_ldir.'/'.strtolower($name).'.php'; 
        if ($file[0] != '/') {
            $file = dirname(__FILE__)."/{$file}";
        }
        if (!is_readable($file)) {
            throw new LangException;
        }
        if (isset(self::$_loaded[$file])) {
            return;
        }
        require $file;
        if (!class_exists('tr_lang_'.$name)) {
            throw new LangException;
        }
        self::$_loaded[$file] = true;
    }


}

?>
