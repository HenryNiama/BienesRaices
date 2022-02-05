<?php

//Aqui vamos a tener algunas variables o constantes
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');



//Aqui se coloca algunas funciones que se van a reutilizar en algunos templates

function incluirTemplate( string $nombre,  bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : bool
{  
    session_start();

    $auth = $_SESSION['login'];
    
    if ($auth) {
        return true;
    }
    
    return false;

}