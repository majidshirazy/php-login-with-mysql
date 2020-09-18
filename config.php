<?php

$database_config = (object) [
    'host'    => 'localhost',
    'user'    => 'root',
    'pass'    => 'advhcd',
    'dbname'  => 'mytestdb'
];
$db = new mysqli($database_config->host, $database_config->user, $database_config->pass, $database_config->dbname);
