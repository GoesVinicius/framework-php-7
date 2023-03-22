 <header class="">

        <nav class="navbar navbar-expand-lg navbar bg-dark" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?= URL ?>/paginas/index">FrameWork</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>/post">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/paginas/sobre">Sobre nós</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>/paginas/contato">contato</a>
        </li>
      </ul>
      <div class="d-flex">

      <?php if (isset($_SESSION['usuario_id'])) { ?>

<div class="div-control me-2">
    <p class="text-secondary-emphasis me-2"><small>Olá, <?= $_SESSION['usuario_nome']; ?>, Seja bem-vindo(a)</small></p>
</div>

<a class="btn btn-outline-danger" href="<?= URL ?> /usuario/logOut">sair</a>

<?php } else { ?>
<div class="div-control me-2">
<a class="btn btn-outline-light" href="<?= URL ?>/usuario/cadastrar" data-tooltip="tooltip" title="Não tem uma conta? Cadastre-se">Cadastre-se</a>
</div>

<a class="btn btn-outline-light" href="<?= URL ?>/usuario/login" data-tooltip="tooltip" title="Tem uma conta? Faça login">Entrar</a>
<?php } ?>
</form>
</div>
</div>
</nav>

</header>
