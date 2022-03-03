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
        $id = validarORedireccionar('/public/vendedores/admin');       
        $errores = Vendedor::getErrores();

        //Obtener datos del vendedor a Actualizar
        $vendedor = Vendedor::find($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los valores
            $args = $_POST['vendedor'];
    
            //Sincronizar el objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);
    
            //validacion
            $errores = $vendedor->validar();
    
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
   

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar el ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                //Valida el tipo a eliminar (Vendedor)
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }

        }
    }


}


?>