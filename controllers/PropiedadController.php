<?php

namespace Controllers;
use MVC\Router;

//El Controlador, se comunica con el Modelo, el Modelo con la Base de Datos, por ultimo, el Controlador comunica
//Los resultados que dio el Modelo, a la Vista.

class PropiedadController{

    public static function index(Router $router)
    {
        $router->render('propiedades/admin');
    }

    public static function crear()
    {
        echo "Crear propiedad:";
    }

    public static function actualizar()
    {
        echo "Actualizar propiedad:";
    }
}

?>