<?php

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\LoginController;


    $router = new Router();

    //ZONA PRIVADA
    // debugear(PropiedadController::class); Devuelve en namespace de donde se encuentra esta funcion.
    //Se identifica en que clase se encuentra el metodo.
    //Ojo, no puede haber urls con la misma direccion

    //Definimos las rutas para Propiedad:
    $router->get('/propiedades/admin', [PropiedadController::class, 'index']);
    $router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
    $router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
    $router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

    //Definimos las rutas para Vendedor:
    $router->get('/vendedores/admin', [VendedorController::class, 'index']);
    $router->get('/vendedores/crear', [VendedorController::class, 'crear']);
    $router->post('/vendedores/crear', [VendedorController::class, 'crear']);
    $router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
    $router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
    $router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);


    //ZONA PUBLICA
    //Zona Libre para los visitantes de este negocio

    //En este caso, la pagina principal va a quedar como '/' Ya cuando tenga un dominio, etc.
    ///Va a tener el nombre del dominio
    $router->get('/', [PaginasController::class, 'index']);
    $router->get('/nosotros', [PaginasController::class, 'nosotros']);
    $router->get('/propiedades', [PaginasController::class, 'propiedades']);
    $router->get('/propiedad', [PaginasController::class, 'propiedad']);
    $router->get('/blog', [PaginasController::class, 'blog']);//Esta estatico, DEBER, hacerlo dinamico, como los de arriba.
    $router->get('/entrada', [PaginasController::class, 'entrada']);
    $router->get('/contacto', [PaginasController::class, 'contacto']);
    $router->post('/contacto', [PaginasController::class, 'contacto']);


    //Login y Autenticacion
    $router->get('/login', [LoginController::class, 'login']);
    $router->post('/login', [LoginController::class, 'login']);
    $router->get('/logout', [LoginController::class, 'logout']);








    $router->comprobarRutas();

?>