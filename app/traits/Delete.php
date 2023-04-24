<?php
namespace app\traits;

trait Delete{
    public function index($field, $value){
        try{
            $prepare = $this->connection->prepare("delete from {$this->table} where {$field} =:{$field}");
            $prepare->bindValue($field, $value);
            return $prepare->execute();
            
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }
    }
}