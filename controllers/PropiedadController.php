<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad; //Importamos nuestro Modelo
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;



//El Controlador, se comunica con el Modelo, el Modelo con la Base de Datos, por ultimo, el Controlador comunica
//Los resultados que dio el Modelo, a la Vista.

class PropiedadController{


    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();

        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
        ]);
    }


    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            /*SUBIDA DE ARCHIVOS */
           
            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

            //Setear la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {//Si existe la imagen, entonces lo seteamos

                //Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);//Este es el archivo/imagen

                //Guardamos el nombre de la imagen en nuestra base de datos, no el archivo
                $propiedad->setImagen($nombreImagen); 
            }


        //Validar
        $errores = $propiedad->validar();


        if (empty($errores)) {
            
            //Crear la carpeta para subir imagenes
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            //Ahora, guardamos la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);//Este metodo es de la libreria de Intervention Image

            //Crea en la base de datos
            $propiedad->guardar();

        }
        }


        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }



    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/public/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();


        //Metodo POST para actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // debugear($_POST);

            //Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //Validacion
            $errores = $propiedad->validar();
            
            //Subida de Archivos

            //Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)). ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {//Si existe la imagen, entonces lo seteamos

                //Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);//Este es el archivo/imagen

                //Guardamos el nombre de la imagen en nuestra base de datos, no el archivo
                $propiedad->setImagen($nombreImagen); 
            }

            //Revisar que el array de errores esté vacío
            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();

            }

        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if ($id) {
    
                $tipo = $_POST['tipo'];
    
                if (validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
    
            }
        }
    }

}

?>