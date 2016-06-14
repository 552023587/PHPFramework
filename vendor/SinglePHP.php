<?php
header("Content-type:text/html;charset=utf-8");
require  'Config/config.php';
require  'vendor/autoload.php';
System\App::getInstance()->run();
