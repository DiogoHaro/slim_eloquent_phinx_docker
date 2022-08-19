<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$config = [
    "driver" => "mysql",
    "host" => "curso-slim_mysql_1",
    "database" => "slim",
    "username" => "root",
    "password" => "root"
];

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();
