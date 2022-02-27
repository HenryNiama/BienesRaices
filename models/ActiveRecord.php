<?php

namespace Model;

class ActiveRecord{

    
    //Base de Datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];


    //Definir la conexion a la BD
    public static function setDB($database){
        self::$db = $database;
    }


    public function crear()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();


        //Insertar en la Base de Datos
        $query = "INSERT INTO ". static::$tabla . " ( " ;
        $query .= implode(", ", array_keys($atributos));
        $query .=" ) VALUES (' ";
        $query .= implode("', '", array_values($atributos));
        $query .= " ')";


        //Como ya esta instanciada y conectada nuestra base de datos con el metodo estatico y $db, entonces:
        $resultado = self::$db->query($query);
        
        //Mensaje de exito:
            if($resultado){
                //Redireccionar al usuario
                header("Location: /admin?resultado=1");
            }
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

        $query = "UPDATE " . static::$tabla  ." SET ";
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
        if (!is_null($this->id)) {//Si hay un ID presente, estamos actualizando....
            $this->actualizar();
        }else{ //Si no hay un ID, entonces, estamos creando un registro
            $this->crear();
        }
    }

    //Eliminar el registro
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla  ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        // debugear($query);
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }


    //Este metodo se encarga de iterar $columnasDB[], identifica y une los atributos de la BD
    public function iterarAtributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {

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
        return static::$errores;
    }


    public function validar()
    {
        //Cada que vayamos a validar, limpiamos el arreglo de errores y generaremos nuevos errores.
        static::$errores = [];
        return static::$errores;
    }


    //Subida de archivos
    public function setImagen($imagen)
    {
        //Elimina la imagen previa
        if (!is_null($this->id)) $this->borrarImagen();

        //Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) $this->imagen = $imagen;

    }

    //Eliminar archivo
    public function borrarImagen()
    {
        //comprobar si existe el archivo(imagen)
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

            if ($existeArchivo) unlink(CARPETA_IMAGENES . $this->imagen);  
    }



    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        
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
                $array[] = static::crearObjeto($registro);//Se pasa el arreglo $registro
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
        $objeto = new static;//Se crea una nuevo objeto, de la misma clase, de Propiedad

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
        $query = "SELECT * FROM " . static::$tabla  . " WHERE id = ${id}";

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

    //Obtiene determinado numero de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM ". static::$tabla . " LIMIT ". $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

}

?>