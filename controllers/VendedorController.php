<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;  //Importamos nuestro Modelo

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

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();


        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
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