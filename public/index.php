<?php

use App\Controllers\PostController;

chdir(dirname(__DIR__));
require_once __DIR__.'/../app/Controllers/PostController.php';
$controller = new PostController();
$controller->show(1);
$controller->display();