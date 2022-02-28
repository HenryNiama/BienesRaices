<?php


namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];



    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }


    public function comprobarRutas()
    {
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // debugear($metodo);
        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
            
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


    
}

?>