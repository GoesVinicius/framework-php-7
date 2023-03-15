<div class="container py-5">
    <div class="card">
    <?=Sessao::mensagem('post')?>
        <div class="card-header bg-info text-white">
            POSTAGENS
            <div class="float-end">
                <a href="<?= URL ?> /posts/salvar" class="btn btn-light">Adicionar</a>
            </div>
        </div>
        <div class="card-body">
            <?php foreach ($dados['posts'] as $post) : ?>
                <div class="card m-3">
                    <div class="card-header bg-secondary text-white font-weight-bold">
                    <?= $post->titulo ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $post->texto ?></p>
                        <a href="<?= URL.'/posts/selecionar/'.$post->postID?>" class="btn btn-sm btn-outline-info float-end">Ler mais...</a>
                    </div>
                    <div class="card-footer text-muted">
                        <small>Escrito por: <?= $post->nome ?> em <?= Valida::validaData($post->postDtCriacao) ?></small>
                    </div>
                </div>

            <?php endforeach ?>
        </div>
    </div>
</div>