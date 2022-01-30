<?php

//Importar la conexion
require 'includes/config/database.php';
$db = conectarBD();

//Crear un emai y password
$email = "correo@correo.com";
$password = "123456";

//Query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${password}');";
    //echo $query;

//Agregarlo a la base de datos
mysqli_query($db, $query);




?>