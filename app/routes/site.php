<?php
namespace app\routes;

use app\controllers\Home;
use app\controllers\Saida;
use app\controllers\Entrada;
use app\controllers\Cadastro;
use app\controllers\CadastroProduto;

$app->get('/', Home::class . ":index");
$app->get('/cadastro', Cadastro::class . ":index");
$app->post('/cadastro', Cadastro::class . ":store");
$app->get('/entrada', Entrada::class . ":index");
$app->post('/entrada', Entrada::class . ":store");
$app->get('/saida', Saida::class . ":index");
$app->post('/saida', Saida::class . ":store");