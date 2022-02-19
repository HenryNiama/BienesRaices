<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la base de Datos
$db = conectarBD();

use App\ActiveRecord;

ActiveRecord::setDB($db);

