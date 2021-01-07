<?php
require_once __DIR__.'/../vendor/autoload.php';
use App\Controllers\PostController;
$data= require '../config/database.php';
$pdoConn = \App\DB\DbPdo::getInstance($data);
$conn = $pdoConn->getConn();
$stm = $conn->query('select * from posts', \PDO::FETCH_ASSOC);
if($stm){
    foreach ($stm as $row){
        //print_r($row);
    }
}


$controller = new PostController();
$controller->show(1);
$controller->display();