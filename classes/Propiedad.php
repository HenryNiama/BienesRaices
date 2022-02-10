<?php

namespace App;

class Propiedad{

    //Base de Datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //Errores
    protected static $errores = [];

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
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '1';
    }


    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // debugear($atributos);

        // $string = implode(", ", array_keys($atributos));
        // debugear($string);
        // debugear(array_keys($atributos));

        //Insertar en la Base de Datos
        $query = "INSERT INTO propiedades ( " ;
        $query .= implode(", ", array_keys($atributos));
        $query .=" ) VALUES (' ";
        $query .= implode("', '", array_values($atributos));
        $query .= " ')";
        // debugear($query);


        //Como ya esta instanciada y conectada nuestra base de datos con el metodo estatico y $db, entonces:
        $resultado = self::$db->query($query);
        
        return $resultado;
    }

    public function actualizar()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Este array va a ir al objeto en memoria y va a ir uniendo atributos con valores
        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE propiedades SET ";
        $query.=  join(', ', $valores);
        $query.= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query.= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado){
            //echo "Insertado Correctamente";
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
        
    }

    public function guardar()
    {
        if (isset($this->id)) {//Si hay un ID presente, estamos actualizando....
            $this->actualizar();
        }else{ //Si no hay un ID, entonces, estamos creando un registro
            $this->crear();
        }
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


    //Validacion
    public static function getErrores(){
        return self::$errores;
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
            self::$errores[] = 'La Imagen es Obligatoria';
        }


        return self::$errores;
    }


    //Subida de archivos
    public function setImagen($imagen)
    {
        //Elimina la imagen previa
        if (isset($this->id)) {
            //comprobar si existe el archivo(imagen)
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

            if ($existeArchivo) unlink(CARPETA_IMAGENES . $this->imagen);                     
        }

        //Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }



    public static function all()
    {
        $query = "SELECT * FROM propiedades";
        
        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function consultarSQL($query)
    {
        //Consultar la base de datos
            $resultado = self::$db->query($query);

        //Iterar los resultados
            $array = [];
            
            while($registro = $resultado->fetch_assoc()){
                $array[] = self::crearObjeto($registro);//Se pasa el arreglo $registro
            }

            //Se obtiene un $array de $objeto(s)
            //debugear($array);

        //Liberar la memoria
            $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        //Se crea un objeto vacio:
        $objeto = new self;//Se crea una nuevo objeto, de la misma clase, de Propiedad

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        //debugear($objeto);
        return $objeto;

    }

    //Busca una registro por su id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = ${id}";

        $resultado = self::consultarSQL($query);
        
        // debugear(array_shift($resultado));//array_shift retorna el primer elemento de 1 arreglo.
        
        return array_shift($resultado);

    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario.
    public function sincronizar($args = []){//Recibe un array, como default, un arreglo vacio
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

}

?>