<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once 'config' . DIRECTORY_SEPARATOR . 'config.php';

use Config\MyPDO;
use Controller\RssController;

$db = new MyPDO();

$ctrl = new RssController($db);
$ctrl->index();
