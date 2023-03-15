<?php

class Usuario extends Controller
{
    public $usuario;

    public function __construct()
    {
        $this->usuario = $this->model('UsuarioModel');
    }

    public function login(){

        $params_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(isset($params_form)){
            $dados = [
                'email' => trim($params_form['email']),
                'senha' => trim($params_form['senha']),
                'email_erro' => '',
                'senha_erro' => '',
            ];

            if (in_array("", $params_form)) {

                if (empty($params_form['email'])) {
                    $dados['email_erro'] = 'Preencha o campo EMAIL.';
                }

                if (empty($params_form['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo SENHA.';
                }
            } else {
               if(Valida::validaEmail($params_form['email'])) {
                    $dados['email_erro'] = 'o email informado é invalido.';

                } else {
                    $loginUsuario = $this->usuario->verificaLogin($params_form['email'], $params_form['senha']);

                    if($loginUsuario){
                        $this->criaSessaoUsuario($loginUsuario);
                    } else{
                        Sessao::mensagem('usuario', 'Email ou senha invalidos', 'alert alert-danger');
                    }
                }
            
            }
        } else{
            $dados = [
                
                'email' => '',
                'senha' => '',
                'email_erro' => '',
                'senha_erro' => '',
               
            ];
           
        }
        
        $this->view('usuarios/login', $dados);
    }

    public function cadastrar()
    {
        $params_form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($params_form)) {
            $dados = [
                'nome' => trim($params_form['nome']),
                'email' => trim($params_form['email']),
                'senha' => trim($params_form['senha']),
                'confirma_senha' => trim($params_form['confirma_senha']),
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
            ];

            if (in_array("", $params_form)) {

                if (empty($params_form['nome'])) {
                    $dados['nome_erro'] = 'Preencha o campo NOME.';
                }

                if (empty($params_form['email'])) {
                    $dados['email_erro'] = 'Preencha o campo EMAIL.';
                }

                if (empty($params_form['senha'])) {
                    $dados['senha_erro'] = 'Preencha o campo SENHA.';
                }

                if (empty($params_form['confirma_senha'])) {
                    $dados['confirma_senha_erro'] = 'Preencha o campo CONFIRMAR SENHA.';
                }
            } else {
                if (Valida::valiaNome($params_form['nome'])) {
                    $dados['nome_erro'] = 'nome informado é invalido.';

                } elseif (Valida::validaEmail($params_form['email'])) {
                    $dados['email_erro'] = 'o email informado é invalido.';

                } elseif ($this->usuario->verificaEmail($params_form['email'])) {
                    $dados['email_erro'] = 'o email informado já esta cadastrado.';

                } elseif (strlen($params_form['senha'] < 6)) {
                    $dados['senha_erro'] = 'A senha precisa ter no mínimo 6 caracteres.';

                } elseif ($params_form['senha'] != $params_form['confirma_senha']) {
                    $dados['confirma_senha_erro'] = 'As senhas são diferentes.';

                } else {
                    $dados['senha'] = password_hash($params_form['senha'], PASSWORD_DEFAULT);

                    if ($this->usuario->salvar($dados)) {
                        Sessao::mensagem('usuario', 'Cadastro realizado com sucesso!');
                        Redirect::redirecionar('usuario/login'); 
                    } else {
                        die('Erro ao salvar dados.');
                    }

                }
            }

        } else {
            $dados = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'nome_erro' => '',
                'email_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
            ];
        }

        $this->view('usuarios/cadastrar', $dados);
    }

    private function criaSessaoUsuario($param_usuario){
        $_SESSION['usuario_id'] = $param_usuario->id;
        $_SESSION['usuario_nome'] = $param_usuario->nome;
        $_SESSION['usuario_email'] = $param_usuario->email;

        Redirect::redirecionar('posts/');
    }

    public function logOut(){
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);

        session_destroy();

       Redirect::redirecionar('usuario/login');
    }
}