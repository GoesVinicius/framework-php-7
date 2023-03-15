<?php

class Controller {

    public function model($model){
        require_once '../app/Models/' .$model. '.php';
        return new $model;
    }

    public function view($view, $dados = []){
        try{
            $arquivo = ('../app/Views/' .$view. '.php');

            if(!file_exists($arquivo)){
                throw new Exception("A view {$view} não existe.");
            } else{
                require_once $arquivo;
            }
        }catch (Exception $e){
            echo $e->getMessage();
        }
       
    }
}