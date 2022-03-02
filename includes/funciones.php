<?php

//Aqui vamos a tener algunas variables o constantes
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/public/imagenes/');


//Aqui se coloca algunas funciones que se van a reutilizar en algunos templates

function incluirTemplate( string $nombre,  bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}


function estaAutenticado() 
{  
    session_start();
    
    if (!$_SESSION['login']) {
        header('Location : /');
    }
}

function debugear($variable)
{
    echo "<pre>";
        var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar / Sanitizar el HTMl
function s($html) : string
{
    $s = htmlspecialchars($html);
    return $s;    
}

//Validar tipo de Contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
    //In array sirve para buscar un valor, dentro de un array. Devuelve true or false
}

//Mostrar los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje ='';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;      
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}


function validarORedireccionar(string $url)
{
    //Validar la URL por ID valido.
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {//Si es que es false, u otro codigo raro, inyeccion, etc
        header("Location: ${url}");
    }

    return $id;
}