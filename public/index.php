<?php
    //inicia a sessao
    session_start();
    //inclui arquivos essenciais
    include './../app/config.php';
    include './../app/autoload.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NOME ?></title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- carregando arquivos de estilos -->
    <link rel="stylesheet" href="<?= APP ?>/public/css/estilos.css">
</head>
<body>
    <?php
        //cabeçalho
        include '../app/Views/header.php';
        //carrega a rota
        $rotas = new Rota();
        //rodape
        include '../app/Views/footer.php';
    ?>

    <!-- js do bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- arquivo JS interno -->
    <script src="<?= APP ?>/public/js/index.js"></script> 
</body>
</html>