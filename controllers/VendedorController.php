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

        //Cuando haya un request method en POST, entonces:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Creamos una nueva instancia de Vendedor
            $vendedor = new Vendedor($_POST['vendedor']);
            //debugear($vendedor); Ya es un objeto
    
            //Validar que no halla campos vacios
            $errores = $vendedor->validar();
    
            //Si no hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
            
        }


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