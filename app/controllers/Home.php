<?php

namespace app\controllers;

use app\classes\Flash;
use app\database\models\Estoque;
use app\database\models\Produto;
use app\database\models\Endereco;


class Home extends Base{
    private $estoque;
    private $produto;
    private $endereco;

    public function __construct(){
        $this->estoque = new Estoque;
        $this->produto = new Produto;
        $this->endereco = new Endereco;
    }

    public function index($request, $response){

        $itens = $this->estoque->find();

        foreach($itens as $item ){
            $item->produto = $this->produto->findBy('idProduto',$item->idCodigoProduto);
            $item->end = $this->endereco->findBy('idEndereco', $item->endereco);
        }

        return $this->getTwig()->render($response, $this->setView('home'),[
            'title' => 'Home',
            'itens' => $itens,
        ]);
    }
}