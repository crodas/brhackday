<?php

// configuration issues

// use a global proxy
#define("GLOBAL_PROXY", "10.99.0.100:128");
define("GLOBAL_PROXY_AUTH", "cesar.rodas:164cr2010");

// setup include path
define("BASEDIR", dirname(__FILE__));
set_include_path(get_include_path().PATH_SEPARATOR.BASEDIR);
set_include_path(get_include_path().PATH_SEPARATOR.BASEDIR."/libs/");
set_include_path(get_include_path().PATH_SEPARATOR.BASEDIR."/libs/ActiveMongo/lib/");


// required libries

require "ActiveMongo.php";

ActiveMongo::connect("brhackday");
