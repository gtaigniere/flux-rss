<?php

require_once '../vendor/autoload.php';
require_once '../src/app/config/config.php';


use App\Controller\FluxController;

$ctrl = new FluxController();
$ctrl->index();
