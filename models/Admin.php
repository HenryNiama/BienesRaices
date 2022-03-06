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

}
?>