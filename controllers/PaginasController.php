<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;


class PaginasController{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);

        $inicio = true;//Esta es para que se ubique el hero, de la pagina principal

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar('/public/propiedades');      
        
        //Buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        //Si quisiera hacer este blog importante, deberia agregar un nuevo modelo llamado Blog
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {//Si quisiera hacer el blog dinamico, esta entrada debe usar active record, y usar el metodo de find, aqui.
        $router->render('paginas/entrada');
    }

    public static function contacto()
    {
        echo "Desde Contacto";
    }

}

?>