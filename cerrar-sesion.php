<?php
    session_start();

    //Para cerrar la sesion reiniciamos el arreglo de session a uno vacio
    $_SESSION = [];
        //var_dump($_SESSION);

    header('Location: /');    

?>