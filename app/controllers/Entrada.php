<?php
namespace app\controllers;

use app\classes\Flash;
use app\database\models\Estoque;
use app\database\models\Produto;
use app\database\models\Endereco;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Entrada extends Base{
    protected $estoque;
    protected $produto;
    public function __construct(){
        $this->estoque = new Estoque;
        $this->endereco = new Endereco;
        $this->produto = new Produto;
    }

    public function index(Request $request, Response $response){
        $produtos = $this->produto->find();           
        $itens = $this->estoque->find();
        $message = Flash::get('message');
        return $this->getTwig()->render($response, $this->setView('entradas'),[
            'title' => 'Entrada de mercadorias',
            'produtos' => $produtos,
            'message' => $message
        ]);
    }

    public function store(Request $request, Response $response){

        $idCodigo = $this->produto->findBy('CodRefProduto',$_POST['codigoProduto']);
        $enderecos = $this->endereco->findBy('endereco',$_POST['endereco']);
        if($_POST){
           if(!$this->estoque->findBy('idCodigoProduto', $idCodigo->idProduto)){
               $newProduct = $this->estoque->create([
                   'idCodigoProduto'=> $idCodigo->idProduto,
                   'data' => $_POST['dataDeEntrada'],
                   'quantidade' => $_POST['quantidade'], 
                   'endereco' => $enderecos->idEndereco,
                   'movimentacao' => $_POST['movimentacao']
               ]);
           }else{
                $estoqueAtual = $this->estoque->findBy('idCodigoProduto', $idCodigo->idProduto);
                $value = (int) $_POST['quantidade'];
                $this->estoque->update(['fields'=>[
                    'quantidade' => ($estoqueAtual->quantidade += $value) 
                    ],'where'=>['idCodigoProduto' => $idCodigo->idProduto]
                ]);
           }
        } 
        Flash::set('message', 'Entrada de material bem sucedida');


        return header('Location: /entrada');
    }
}