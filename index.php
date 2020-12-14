<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\FluxController;

$ctrl = new FluxController();
$ctrl->index();
