<?php

namespace App;

class Propiedad{

    //Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;


    //Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';

    }

    public function guardar()
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // debugear($atributos);

        //Insertar en la Base de Datos
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId)
                  VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', 
                '$this->vendedorId')";
        
        //debugear($query);
        //Como ya esta instanciada y conectada nuestra base de datos con el metodo estiativo y $db, entonces:
        $resultado = self::$db->query($query);

        debugear($resultado);
    }

    //Este metodo se encarga de iterar $columnasDB[], identifica y une los atributos de la BD
    public function iterarAtributos()
    {
        $atributos = [];

        foreach (self::$columnasDB as $columna) {

            if($columna === 'id') continue;

            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    //Sanitiza cada uno de los atributos que vienen del formulario con ayuda del metodo iterarAtributos
    public function sanitizarAtributos()
    {
        $atributos = $this->iterarAtributos();
        //debugear($atributos);

        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        // debugear($sanitizado);
        return $sanitizado;
    }


}

?>