<?php
namespace app\controllers;

use app\classes\Flash;
use app\database\models\Estoque;
use app\database\models\Produto;
use app\database\models\Endereco;

class Saida extends Base{

    private $estoque;
    private $produto;
    private $endereco;

    public function __construct(){
        $this->estoque = new Estoque;
        $this->produto = new Produto;
        $this->endereco = new Endereco;
    }


    public function index($request, $response){
        $message = Flash::get('message');
        var_dump($message);
        return $this->getTwig()->render($response, $this->setView('saida'),[
            'title' => 'Saída de mercadorias',
            'message' => $message
        ]);
    }


    public function store($request, $response){

        $idCodigo = $this->produto->findBy('CodRefProduto',$_POST['codigoProduto']);
        $enderecos = $this->endereco->findBy('endereco',$_POST['endereco']);
        if($_POST){
           if(!$this->estoque->findBy('idCodigoProduto', $idCodigo->idProduto)){
                Flash::set('message', 'O material está com quantidade insuficiente','warning');
           }else{
                $estoqueAtual = $this->estoque->findBy('idCodigoProduto', $idCodigo->idProduto);
                $value = (int) $_POST['quantidade'];
                $this->estoque->update(['fields'=>[
                    
                    'movimentacao' => 'saida',
                    'quantidade' => ($estoqueAtual->quantidade -= $value) 
                    ],'where'=>['idCodigoProduto' => $idCodigo->idProduto]
                ]);
           }
        } 
        Flash::set('message', 'Saída de material bem sucedida');


        return header('Location: /saida');

    }
}