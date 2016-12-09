<?php
header("Content-type:text/html;charset=utf-8");
require  'vendor/autoload.php';
define("__CONFIG__",require('Config/config.php'));
System\App::getInstance()->run();
