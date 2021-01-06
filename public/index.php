<?php

use App\Controllers\PostController;

require_once __DIR__.'/../vendor/autoload.php';
$controller = new PostController();
$controller->show(1);
$controller->display();