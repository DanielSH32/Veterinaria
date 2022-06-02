<?php
include_once "app/models/db.class.php";
class Agotados extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAgotados() {
        return $this->executeQuery("Select id_producto, descripcion, precio, cantidad, categoria, proveedor
         from categorias inner join (proveedores inner join productos using(id_proveedor)) using(id_cate) where
         cantidad<=3 order by descripcion");
    }

    public function getProductosReporte($data){
        $condicion="";
        if ($data["cantidad"]=="3") {
            $condicion.=" and a.cantidad='{$data["cantidad"]}'";
        }
        return $this->executeQuery("Select a.*, b.categoria, c.proveedor from proveedores c inner join 
        (categorias b inner join productos a using(id_cate)) using(id_proveedor) where 1=1
        $condicion");
    }

}