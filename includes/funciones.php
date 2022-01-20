<?php
//Aqui se coloca algunas funciones que se van a reutilizar en algunos templates

require 'app.php';

function incluirTemplate( string $nombre,  bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}