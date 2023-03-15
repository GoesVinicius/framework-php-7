<?php

Class Valida {

    public static function valiaNome($nome){
        if(!preg_match('/^([áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/', $nome)){
            return true;
        } else{
            return false;
        }

    }

    public static function validaEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else{
            return false;
        }
    }

    public static function validaData($data){
        if(isset($data)){
            return date('d/m/Y H:i', strtotime($data));
        } else{
            return false;
        }
       
    }
}