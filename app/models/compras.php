<?php
include_once "app/models/db.class.php";
class Compras extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select a.id_compra, a.no_factura, c.descripcion, b.cantidad, b.precio, a.fecha, 
        d.proveedor from proveedores d inner join productos c using(id_proveedor) inner join detallecompra b 
        using(id_producto) inner join compras a using(no_factura) order by no_factura");
    }
    public function save($data,$img){
        return $this->executeInsert("insert into compras set no_factura='{$data["no_fact"]}',
        total_compra='{$data["total"]}', fecha='{$data["fecha"]}', id_proveedor='{$data["id_proveedor"]}',
        foto='{$img}'");
    }

    public function saveProducto($data){
        return $this->executeInsert("insert into detallecompra set no_factura='{$data["no_fact"]}',
        id_producto='{$data["id_producto"]}', cantidad='{$data["cantidad"]}', precio='{$data["precio"]}'");
    }

    public function getCompraByNumero($des){
        return $this->executeQuery("'{Select * from compras where no_factura=$des}'");
    }

    public function update($data,$img){
        return $this->executeInsert("update detallecompra set descripcion='{$data["descripcion"]}',
        precio='{$data["precio"]}', cantidad='{$data["cantidad"]}', id_cate='{$data["id_cate"]}',
        id_proveedor='{$data["id_proveedor"]}', 
        foto=if('{$img}'='',foto,'{$img}'), 
        where id_producto='{$data["id_producto"]}'");
    }

    public function getOneCompra($id){
        return $this->executeQuery("Select b.id_compra, b.no_factura, d.descripcion, c.cantidad, c.precio, 
        b.fecha, a.proveedor from productos d inner join detallecompra c using(id_producto) inner join compras b 
        using(no_factura) inner join proveedores a using(id_proveedor) where id_compra='{$id}'");
    }

    public function deleteCompra($id){
        return $this->executeInsert("delete from detallecompra where no_fact='$id'");
        
    }

    public function getComprasReporte($data){
        $condicion="";
        if ($data["id_proveedor"]!="0") {
            $condicion.=" and d.id_proveedor='{$data["id_proveedor"]}'";
        }
        if ($data["fecha"]!="") {
            $condicion.=" and a.fecha>='{$data["fecha"]}'";
        }
        if ($data["fecha2"]!="") {
            $condicion.=" and a.fecha<='{$data["fecha2"]}'";
        }
        return $this->executeQuery("Select a.id_compra, a.no_factura, c.descripcion, b.cantidad, b.precio, a.fecha, 
        d.proveedor from proveedores d inner join productos c using(id_proveedor) inner join detallecompra b 
        using(id_producto) inner join compras a using(no_factura) where 1=1 $condicion");
    }
}