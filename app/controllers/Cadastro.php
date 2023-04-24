<?php
namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\classes\Flash;
use app\database\models\Produto;



class Cadastro extends Base{
    private $produto;

    public function __construct(){
        $this->produto = new Produto;
    }

    public function index(Request $request, Response $response){
        $message = Flash::get('message');
    
        return $this->getTwig()->render($response, $this->setView('cadastro_produto'),[
            'title' => 'Cadastro de produtos',
            'message' => $message
        ]);
    }

    public function store(Request $request, Response $response, $args){
        
        if($_POST){
            $newProduct = $this->produto->create([
                'codRefProduto'=> $_POST['codProduto'],
                'NomeProduto' => $_POST['descricao'],
                'Fornecedor' => $_POST['fornecedor'], 
                'Valor' => $_POST['valor']
            ]);
            Flash::set('message','Produto cadastrado com sucesso');
            return header('location: localhost/cadastro');
        }else{  
            Flash::set('message', 'Ocorreu algum erro') ;
            return $response->withStatus(404);
           
        }
    }
}