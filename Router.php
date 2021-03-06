<?php

//Los Modelos vienes la carpeta de models, y parten desde el ActiveRecord
//El Modelo interactua directamente con la Base de Datos.

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];


    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas()
    {
        session_start();
        
        $auth = $_SESSION['login'] ?? null;
        // debugear($auth);

        //Arreglo de rutas Protegidas:
        $rutas_protegidas = ['/propiedades/admin', '/vendedores/admin', '/propiedades/crear', '/propiedades/actualizar', 
        '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];
        

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];


        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{//Si es que es POST, entonces:
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }


        //Proteger las rutas:
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
            header('Location: /public');
            
        }



        //La URL existe y hay una funcion asociada
        if ($fn) {
            /*
            Usamos call_user_fun porque no sabemos cual va a ser la funcion que se va a ejecutar ya que
            depende mucho de que URL visite el usuario.
            El $this guarda la instancia del Router que contiene todas las URL
            */
            call_user_func($fn, $this);
        }else{
            echo "No existe la Pagna 404";
        }
    }


    //Muestra una vista
    public function render($view, $datos = [])
    {

        //El siguiente iterador, va a generar nombres de variables con el nombres de los keys
        //del arreglo asociativo que existe en la funcion index en PropiedadController.
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        //Iniciamos un almacenamiento en memoria
        ob_start();
        
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();//Lo limpiamos

        include __DIR__  . "/views/layout.php";
    }

    
}

?>