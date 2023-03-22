<div class="col-xl-4 col-md-6 mx-auto p-5 my-5">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Entrar
        </div>
        <div class="card-body">
        <?=Sessao::mensagem('usuario')?>
            <p class="card-text"><small class="text-muted">Preecha os dados para fazer seu login</small></p>

            <form name="login" method="POST" action="<?= URL ?>/usuario/login" class="mt-4">

                <div class="form-group">
                    <label for="email">E-mail: <sup class="text-danger">*</sup></label>
                    <input type="text" name="email" id="email" value="<?= $dados['email'] ?>" class="form-control <?= $dados['email_erro'] ? 'is-invalid' : '' ?>" >

                    <div class="invalid-feedback"> <?= $dados['email_erro'] ?> </div>

                </div>
                

                <div class="form-group">
                    <label for="senha">Senha: <sup class="text-danger">*</sup></label>
                    <input type="password" name="senha" id="senha" value="<?= $dados['senha'] ?>" class="form-control <?= $dados['senha_erro'] ? 'is-invalid' : '' ?>" >

                    <div class="invalid-feedback"> <?= $dados['senha_erro'] ?> </div>

                </div>

                <div class="row my-3">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-dark btn-block">
                    </div>
                    <div class="col">
                        <a href="<?= URL ?>/usuario/cadastrar"><small>Ainda não tem uma conta? Faça seu cadastro </small></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>