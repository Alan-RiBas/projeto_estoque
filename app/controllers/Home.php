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
            
            $produtos = $this->produto->findBy('idProduto',$item->idCodigoProduto, true);
            $enderecos = $this->endereco->findBy('idEndereco', $item->endereco);
            
            // $slot = [
            //     "codProduto" => "{$produtos->CodRefProduto}",
            //     "data" => "{$item->data}",
            //     "quantidade" => "{$item->quantidade}",
            //     "endereco" => "{$produtos->fornecedor}",
            //     "descricao" => "{$produto->NomeProduto}"

            // ];
        }
        return $this->getTwig()->render($response, $this->setView('home'),[
            'title' => 'Home',
            'enderecos' => $enderecos,
            'produtos' => $produtos,
            'itens' => $itens,
        ]);
    }

    
}