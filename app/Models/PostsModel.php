<?php

class PostsModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function exibirPosts(){

        $this->db->query("SELECT *,
                            p.id as postID,
                            p.dt_criacao as postDtCriacao,
                            u.id as usuarioID,
                            u.dt_criacao as usuDtCriacao
                         FROM posts p 
                         INNER JOIN usuarios u ON
                            p.id_usuario = u.id
                          ORDER BY p.id DESC");

        return $this->db->resultados();
    }

    public function exibirPostID($id){

        $this->db->query("SELECT *
                          FROM posts p 
                          WHERE p.id = :id");

        $this->db->bind('id', $id);

        return $this->db->resultado();
    }

    public function salvar($dados){

        $this->db->query("INSERT INTO posts(id_usuario, titulo, texto) VALUES(:id_usuario, :titulo, :texto)");

        $this->db->bind("id_usuario", $dados['usuario_id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executa()){
            return true;
        } else{
            return false;
        }
    }

    public function editar($dados){

        $this->db->query("UPDATE posts SET titulo = :tiulo, texto = :texto WHERE id = :id");

        $this->db->bind("id", $dados['id']);
        $this->db->bind("titulo", $dados['titulo']);
        $this->db->bind("texto", $dados['texto']);

        if($this->db->executa()){
            return true;
        } else{
            return false;
        }
    }
}
