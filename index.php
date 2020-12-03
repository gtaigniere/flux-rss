<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once 'config' . DIRECTORY_SEPARATOR . 'config.php';

use Controller\RssController;

$sgbdHost = CONFIG['db.driver'] . ':host=' . CONFIG['db.host'] . ';dbname=' . CONFIG['db.name'] . ';charset=UTF8';
$db = new PDO($sgbdHost, CONFIG['db.user'], CONFIG['db.password'], CONFIG['pdo.config']);

$ctrl = new RssController($db);
$ctrl->index();
