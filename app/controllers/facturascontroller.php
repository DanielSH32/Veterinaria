<?php
include_once "app/models/facturas.php";
class FacturasController extends Controller {
    private $factura;
    public function __construct($parametro) {
        $this->factura=new Facturas();
        parent::__construct("facturas",$parametro,true);
    }

    public function getAll() {
        $records=$this->factura->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function getOneProducto(){
        $records=$this->factura->getOneProducto($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true, 'records'=>$records);
        }else{
            $info=array('success'=>false, 'msg'=>'El producto no existe.');
        }
        echo json_encode($info);
    }


    public function deleteProducto(){
        $records=$this->factura->deleteProducto($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Producto eliminado con exito");
        echo json_encode($info);
    }

}