<?php
include_once "app/models/db.class.php";
class Clientes extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_cliente, nombre, apellido, DUI, direccion, email, telefono
         from clientes");
    }

    public function save($data){
        return $this->executeInsert("insert into clientes set nombre='{$data["nombre"]}',
        apellido='{$data["apellido"]}', DUI='{$data["dui"]}', direccion='{$data["direccion"]}',
        email='{$data["email"]}', telefono='{$data["telefono"]}'");
    }

    public function getUserByNombre($nombre, $apellido){
        return $this->executeQuery("Select id_cliente, nombre, apellido from clientes where nombre='{$nombre}' and 
        apellido='{$apellido}'");
    }

    public function update($data){
        return $this->executeInsert("update clientes set nombre='{$data["nombre"]}',
        apellido='{$data["apellido"]}', DUI='{$data["dui"]}', direccion='{$data["direccion"]}',
        email='{$data["email"]}', telefono='{$data["telefono"]}' where id_cliente='{$data["id_cliente"]}'");
    }

    public function getOneCliente($id){
        return $this->executeQuery("Select id_cliente, nombre, apellido, DUI, direccion, email, telefono
        from clientes where id_cliente='{$id}'");
    }

    public function deleteCliente($id){
        return $this->executeInsert("delete from clientes where id_cliente='$id'");
        
    }

}