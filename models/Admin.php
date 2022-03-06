<?php

namespace Model;


class Admin extends ActiveRecord{

    //Base de datos
    //Ojo que cada tabla de la Base de datos, tiene un modelo asociado.
    //Y este Modelo Admin, tiene la tabla asociada de Usuarios.
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null; 
        $this->email = $args['email'] ?? ''; 
        $this->password = $args['password'] ?? ''; 
    }

    //El metodo validar, es propio de cada modelo, es decir, hay un validar() para cada modelo.
    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$errores[] = 'El Password es Obligatorio'; 
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        //Revisar si un usuario existe  o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        // debugear($resultado); Revisamos los resultados que arroja
        if (!$resultado->num_rows) {//Si no hay ningun num_rows, es decir es 0, entonces:
            self::$errores[] = 'El Usuario No existe';
            return; //Este return; hace que el codigo deje de ejecutarse
        }

        //En caso contrario, de que si exista el resultado, entonces:
        return $resultado;
    }
}
?>