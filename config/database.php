<?php
return [
    'driver' => 'mysql', 
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'mvc',
    'options' => [
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];