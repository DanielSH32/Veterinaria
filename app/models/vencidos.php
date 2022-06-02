<?php
include_once "app/models/db.class.php";
class Vencidos extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getVencidos() {
        return $this->executeQuery("Select id_producto, descripcion, precio, cantidad, vencimiento, proveedor 
        from categorias inner join (proveedores inner join productos using(id_proveedor)) 
        using(id_cate) where vencimiento<=CURRENT_DATE and cantidad>0 order by descripcion");
    }

    public function getProductosReporte($data){
        $condicion="";
        if ($data["cantidad"]=="0") {
            $condicion.=" and cantidad>'{$data["cantidad"]}'";
        }
        return $this->executeQuery("Select id_producto, descripcion, precio, cantidad, vencimiento, proveedor 
        from categorias inner join (proveedores inner join productos using(id_proveedor)) 
        using(id_cate) where vencimiento<=CURRENT_DATE $condicion");
    }

}