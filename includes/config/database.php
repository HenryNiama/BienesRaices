<?php

function conectarBD() : mysqli
{
    $db = mysqli_connect('localhost', 'root', '1720', 'bienes_raices'); 
    
    if (!$db) {
        echo "Error. No se puede conectar a la Base de Datos del sistema.";
        exit;//Se encarga de que las siguientes lineas no se ejecuten.
    }

    return $db;
}

?>