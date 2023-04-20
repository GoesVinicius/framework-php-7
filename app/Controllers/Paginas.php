<?php

class Paginas extends Controller{

   public function index(){

      if(Sessao::verificaUsuLogado()){
         Redirect::redirecionar('posts');
     }

      $this->view('paginas/home');
   }

   public function sobre(){
    
   }

   public function contato(){
      $this->view('paginas/contato');
   }

   public function error(){

      $dados = [
         'titulo' => '404 NOT FOUND'
      ];

      $this->view('paginas/error404', $dados);
   }
}