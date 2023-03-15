<?php

class UsuarioModel {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function verificaEmail($email){
        $this->db->query("SELECT email FROM usuarios WHERE email = :email");

        $this->db->bind("email", $email);

        if($this->db->resultado()){
            return true;
        } else{
            return false;
        }
    }

    public function salvar($dados){

        $this->db->query("INSERT INTO usuarios(nome, email, senha) VALUES(:nome, :email, :senha)");

        $this->db->bind("nome", $dados['nome']);
        $this->db->bind("email", $dados['email']);
        $this->db->bind("senha", $dados['senha']);

        if($this->db->executa()){
            return true;
        } else{
            return false;
        }
    }

    public function verificaLogin($email, $senha){

        $this->db->query("SELECT * FROM usuarios WHERE email = :email");

        $this->db->bind("email", $email);

        if($this->db->resultado()){
            $resultado = $this->db->resultado();
            if(password_verify($senha, $resultado->senha)){
                return $resultado;
            } else{
                return false;
            }
        } else{
            return false;
        }
    }

    public function exibirUsuarioID($id){

        $this->db->query("SELECT *
                          FROM usuarios u 
                          WHERE u.id = :id");

        $this->db->bind('id', $id);

        return $this->db->resultado();
    }
}