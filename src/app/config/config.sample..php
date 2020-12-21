<?php

define ('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);

const CONFIG = [
    'db.driver' => 'mysql',
    'db.host' => 'localhost',
    'db.name' => '',
    'db.user' => '',
    'db.password' => '',
    'pdo.config' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
];

