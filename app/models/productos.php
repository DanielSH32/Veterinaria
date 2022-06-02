<?php
include_once "app/models/db.class.php";
class Productos extends BaseDeDatos {

    //Crear el metodo constructor
    public function __construct() {
        parent::conectar();
    }

    public function getAll() {
        return $this->executeQuery("Select id_producto, descripcion, precio, cantidad, categoria, proveedor
         from categorias inner join (proveedores inner join productos using(id_proveedor)) using(id_cate)
          order by descripcion");
    }

    public function save($data,$imgp,$imgm,$imgg){
        return $this->executeInsert("insert into productos set descripcion='{$data["descripcion"]}',
        precio='{$data["precio"]}', cantidad='{$data["cantidad"]}', id_cate='{$data["id_cate"]}',
        id_proveedor='{$data["id_proveedor"]}', fotop='{$imgp}', fotom='{$imgm}', fotog='{$imgg}'");
    }

    public function getUserByDescripcion($des){
        return $this->executeQuery("Select id_producto, descripcion from productos where descripcion='{$des}'");
    }

    public function update($data,$imgp,$imgm,$imgg){
        return $this->executeInsert("update productos set descripcion='{$data["descripcion"]}',
        precio='{$data["precio"]}', cantidad='{$data["cantidad"]}', id_cate='{$data["id_cate"]}',
        id_proveedor='{$data["id_proveedor"]}', 
        fotop=if('{$imgp}'='',fotop,'{$imgp}'), 
        fotom=if('{$imgm}'='',fotom,'{$imgm}'), 
        fotog=if('{$imgg}'='',fotog,'{$imgg}') where id_producto='{$data["id_producto"]}'");
    }

    public function getOneProducto($id){
        return $this->executeQuery("Select id_producto, descripcion, precio, cantidad, categoria, proveedor, 
        fotop, fotom, fotog from categorias inner join (proveedores inner join productos using(id_proveedor)) 
        using(id_cate) where id_producto='{$id}'");
    }

    public function deleteProducto($id){
        return $this->executeInsert("delete from productos where id_producto='$id'");
        
    }

    public function getProductosReporte($data){
        $condicion="";
        if ($data["id_proveedor"]!="0") {
            $condicion.=" and c.id_proveedor='{$data["id_proveedor"]}'";
        }
        if ($data["id_cate"]!="0") {
            $condicion.=" and b.id_cate='{$data["id_cate"]}'";
        }
        return $this->executeQuery("Select a.*, b.categoria, c.proveedor from proveedores c inner join 
        (categorias b inner join productos a using(id_cate)) using(id_proveedor) where a.cantidad>0 
        $condicion");
    }
}