<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../src/app/config/config.php';

use App\Router\Router;

$router = new router($_GET, $_POST);
$router->route();
