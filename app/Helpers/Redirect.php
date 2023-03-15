<?php

class Redirect
{
    public static function redirecionar($url){
        header("location:".URL.DIRECTORY_SEPARATOR.$url);
    }
}
