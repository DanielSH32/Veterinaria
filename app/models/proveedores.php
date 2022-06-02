<?php
include_once "app/models/db.class.php";
class Proveedores extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_proveedor, proveedor, contacto, telefono from proveedores order by id_proveedor");
    }

    public function getAllOrderByName() {
        return $this->executeQuery("Select id_proveedor, proveedor, contacto, telefono from proveedores order by proveedor");
    }

    public function save($data){
        return $this->executeInsert("insert into proveedores set proveedor='{$data["proveedor"]}', contacto='{$data["contacto"]}',
        telefono='{$data["telefono"]}'");
    }

    public function getProveedorByName($proveedor){
        return $this->executeQuery("Select id_proveedor, proveedor, contacto, telefono from proveedores where proveedor='{$proveedor}'");
    }

    public function getOneProveedor($id){
        return $this->executeQuery("Select id_proveedor, proveedor, contacto, telefono from proveedores where id_proveedor='{$id}'");
    }

    public function update($data){
        return $this->executeInsert("update proveedores set proveedor='{$data["proveedor"]}', contacto='{$data["contacto"]}',
        telefono='{$data["telefono"]}' where id_proveedor='{$data["id_proveedor"]}'");
    }

    public function deleteProveedor($id){
        return $this->executeInsert("delete from proveedores where id_proveedor='$id'");
        
    }
}