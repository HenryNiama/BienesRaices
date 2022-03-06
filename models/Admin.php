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
}
?>