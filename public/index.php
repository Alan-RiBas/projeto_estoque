<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Slim\Middleware\MethodOverrideMiddleware;
$app = AppFactory::create();

require '../app/routes/site.php';

$MethodOverrideMiddleware = new MethodOverrideMiddleware();
$app->add($MethodOverrideMiddleware);

$app->run();