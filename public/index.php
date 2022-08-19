<?php

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;
session_start();

require '../vendor/autoload.php';


$app = AppFactory::create();

require '../app/routes/home.php';
require '../app/routes/user.php';
$app->add(new MethodOverrideMiddleware());

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($request, $response) {
    $response->getBody()->write('something wrong');
    return $response;
});

$app->run();