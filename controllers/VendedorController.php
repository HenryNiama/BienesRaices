<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad; //Importamos nuestro Modelo
use Model\Vendedor;

class VendedorController{

    public static function index(Router $router)
    {
        $vendedores = Vendedor::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/admin', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function actualizar(Router $router)
    {
        echo "Actualizando vendedores";
    }

    public static function eliminar(Router $router)
    {
        echo "Eliminando vendedores";
    }


}


?>