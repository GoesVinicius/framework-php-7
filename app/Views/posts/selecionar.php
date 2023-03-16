<div class="container">
    <div class="p-5 m-5 bg-light rounded border shadow">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $dados['post']->titulo ?></li>
            </ol>
        </nav>

        <div class="card text-center">
            <div class="card-header bg-secondary text-white font-weight-bold">
                <?= $dados['post']->titulo ?>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $dados['post']->texto ?></p>
            </div>
            <div class="card-footer text-muted">
                <small>
                    Escrito por: <b><?= $dados['usuario']->nome ?></b> em <i><?= Valida::validaData($dados['post']->dt_criacao) ?></i>
                </small>
            </div>

            
            <?php if($dados['post']->id_usuario == $_SESSION['usuario_id']){ ?>
                <ul class="list-inline">
                    <li class="list-inline-item">
                    <a href="<?= URL .'/posts/editar/'. $dados['post']->id ?>" class="btn btn-sm btn-outline-warning my-2">Editar</a>
                    </li>
                    
                    <li class="list-inline-item">
                        <form action="<?= URL .'/posts/excluir/'. $dados['post']->id ?>" method="POST">
                            <input type="submit" class="btn btn-sm btn-outline-danger" value="Excluir">
                        </form>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>