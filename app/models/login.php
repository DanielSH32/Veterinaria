<?php
include_once "app/models/db.class.php";
class Login extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function validarLogin($user,$pass) {
        //Ejecutamos la consulta
        $result=$this->conexion->query("SELECT * FROM usuarios WHERE usuario='$user' and password=sha1('$pass')");
        //Validamos si devuelve un registro
        if ($record=$result->fetch_assoc()) {
            return $record;
        } else {
            return false;
        }
    }

}