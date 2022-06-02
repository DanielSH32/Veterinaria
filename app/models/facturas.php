<?php
include_once "app/models/db.class.php";
class Facturas extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_producto, descripcion, precio from productos order by descripcion");
    }

    public function getOneProducto($id){
        return $this->executeQuery("Select id_producto, descripcion, precio  
        from categorias inner join (proveedores inner join productos using(id_proveedor)) 
        using(id_cate) where id_producto='{$id}'");
    }

    public function getVentasReporte($data){
        $condicion="";
        if ($data["fecha"]!="") {
            $condicion.=" and b.fecha>='{$data["fecha"]}'";
        }
        if ($data["fecha2"]!="") {
            $condicion.=" and b.fecha<='{$data["fecha2"]}'";
        }
        return $this->executeQuery("Select a.nombre, a.apellido, b.num_factura, b.fecha, c.cantidad, d.descripcion, 
        d.precio from productos d inner join detallefactura c using(id_producto) inner join facturas b using(num_factura) 
        inner join clientes a using(id_cliente) where 1=1 $condicion");
    }

}
