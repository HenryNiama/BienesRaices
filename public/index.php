<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;


    $router = new Router();

    // debugear(PropiedadController::class); Devuelve en namespace de donde se encuentra esta funcion.
    //Se identifica en que clase se encuentra el metodo

    //Definimos las rutas:
    $router->get('/admin', [PropiedadController::class, 'index']);
    $router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

    $router->comprobarRutas();

?>