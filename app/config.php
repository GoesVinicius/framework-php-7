<?php
//variaveis de conexao com o banco de dados
define('DB', ['HOST' => 'localhost',
              'USER' => 'root',
              'PASSWORD' => '',
              'DB_NAME' => 'framework',
              'PORT' => '3306']);

//constante do diretorio raiz
define('APP', dirname(__FILE__)); 

//constante da URL do sistema
define('URL', 'http://localhost/framework');

//constante do nome do sistema
define('APP_NOME', 'Curso de PHP 7 com MVC');

//constante de versao
define('APP_VERSAO', '1.0.0');
// echo APP .'<hr>'. URL;
