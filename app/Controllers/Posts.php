<?php

class Posts extends Controller
{
    private $post;
    private $usuario;

    public function __construct(){

        if(!Sessao::verificaUsuLogado()){
            Redirect::redirecionar('usuario/login');
        }

        $this->post = $this->model('PostsModel');
        $this->usuario = $this->model('usuarioModel');
    }


    public function index(){
        $dados = [
            "posts" => $this->post->exibirPosts()
        ];

        $this->view('posts/index', $dados);
    }

    public function salvar(){
        $params = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($params)){

            $dados = [
                'titulo' => trim($params['titulo']),
                'texto' => trim($params['texto']),
                'usuario_id' => $_SESSION['usuario_id'],
                'titulo_erro' => '',
                'texto_erro' => ''
            ];

            if(in_array("", $params)){
                if(empty($params['titulo'])){
                    $dados['titulo_erro'] = 'Preencha o campo TITULO.';
                }

                if(empty($params['texto'])){
                    $dados['texto_erro'] = 'Preencha o campo TEXTO.';
                }
            } else{
                if($this->post->salvar($dados)){
                    Sessao::mensagem('post', 'Post cadastrado com sucesso!');
                    Redirect::redirecionar('posts');
                }
            }

        } else{
            $dados = ['titulo' => '',
                      'texto' => '',
                      'titulo_erro' => '',
                      'texto_erro' => ''
            ];
        }
        // var_dump($dados);
        $this->view('posts/cadastrar', $dados);
    }

    public function editar($id){
        $params = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($params)){

            $dados = [
                'titulo' => trim($params['titulo']),
                'texto' => trim($params['texto']),
                'id' => $id,
                'titulo_erro' => '',
                'texto_erro' => ''
            ];


            if(in_array("", $params)){
                if(empty($params['titulo'])){
                    $dados['titulo_erro'] = 'Preencha o campo TITULO.';
                }

                if(empty($params['texto'])){
                    $dados['texto_erro'] = 'Preencha o campo TEXTO.';
                }
            } else{
                if($this->post->editar($dados)){
                    Sessao::mensagem('post', 'Post editado com sucesso!');
                    Redirect::redirecionar('posts/cadastrar');
                } else{
                    die('erro ao editar');
                }
            }

        } else{

            $post = $this->post->exibirPostID($id);

            if($post->id_usuario != $_SESSION['usuario_id']){
                Sessao::mensagem('post', 'Usuario nao pode editar este post!', 'alert alert-danger');
                    Redirect::redirecionar('posts');
            }

            $dados = [
                      'id' => $id,
                      'titulo' => $post->titulo,
                      'texto' => $post->texto,
                      'titulo_erro' => '',
                      'texto_erro' => ''
            ];
        }
         //var_dump($dados);
        $this->view('posts/editar', $dados);
    }

    public function selecionar($id){

        $post = $this->post->exibirPostID($id); 

        $usuario = $this->usuario->exibirUsuarioID($post->id_usuario);

        $dados = [
            'post' => $post,
            'usuario' => $usuario
        ]; 

        $this->view('posts/selecionar', $dados);
    }

    public function excluir($id){

        if(!$this->verificaUsuLogado($id)){

            $id = filter_var($id, FILTER_VALIDATE_INT);

            $metodo = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    
            if($id AND $metodo == 'POST'){

                if($this->post->excluirPost($id)){
                    Sessao::mensagem('post', 'Registro excluído com sucesso');
                    Redirect::redirecionar('posts');
                }
            }
        }else{
            Sessao::mensagem('post', 'Registro não pode ser excluído!', 'alert alert-danger');
            Redirect::redirecionar('posts');
        }

        // if($this->post->excluirPost($id)){
        //     Sessao::mensagem('post', 'Registro excluído com sucesso!');
        //     Redirect::redirecionar('posts');
        // }else{
        //     echo 'erro ao excluir';
        // }
        
    }

    private function verificaUsuLogado($id){

        $post = $this->post->exibirPostID($id);

            if($post->id_usuario != $_SESSION['usuario_id']){
                return true;
            }else{
                return false;
            }
    }
}
