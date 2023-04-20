<?php

// error_reporting(0);
// ini_set('error_reporting', 0);
const LOG = true;

function phpErro($erro, $msg, $arquivo, $linha)
{

    switch ($erro) {
        case 2;
            $estilo = 'alert-warning';
            break;
        case 8;
            $estilo = 'alert-danger';
            break;
        case 1;
        case 256;
        case 2002;
        case 1045;
        case 1049;
            $estilo = 'alert-danger';
            break;
        default:
            $estilo = '';
    }

    echo "<p class=\"alert {$estilo} m-2\"> <strong>Erro:</strong> {$msg} <strong>no arquivo</strong> {$arquivo} <strong>na linha</strong> <strong class=\"text-danger\"> {$linha} </strong></p>";
    //var_dump($erro);

    if(LOG){
        $logs = "Erro: {$msg} no arquivo {$arquivo} na linha {$linha}\n";

        error_log($logs, 3, "".dirname(__FILE__)."/logs/phperro.log");
    }

    if($erro == 1 OR $erro == 256){
        die();
    }
}

set_error_handler('phpErro');
