<?php

namespace App;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
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


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar()
    {
        if (!$this->titulo) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "Debes anadir un titulo.";
        }

        if (!$this->precio) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "El precio es obligatorio.";
        }

        if (strlen($this->descripcion) < 50 || !$this->descripcion) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres.";
        }

        if (!$this->habitaciones) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "El numero de habitaciones es obligatorio.";
        }

        if (!$this->wc) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "El Número de baños es obligatorio.";
        }

        if (!$this->estacionamiento) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "El Número de lugares de estacionamiento es obligatorio.";
        }

        if (!$this->vendedorId) {//Si no hay titulo, es decir, esta vacio.
            self::$errores[] = "Elige un vendedor.";
        }

        if (!$this->imagen) {
            self::$errores[] = 'La Imagen de la Propiedad es Obligatoria';
        }

        return self::$errores;
    }
}

?>