<?php
include_once "app/models/proveedores.php";
class ProveedoresController extends Controller {
    private $proveedor;
    public function __construct($parametro) {
        $this->proveedor=new Proveedores();
        parent::__construct("proveedores",$parametro,true);
    }

    public function getAll() {
        $records=$this->proveedor->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function save(){
        if ($_POST["id_proveedor"]=="0") {
            $datosProveedor=$this->proveedor->getProveedorByName($_POST["proveedor"]);
            if (count($datosProveedor)>0) {
                $info=array('success'=>false,'msg'=>"El proveedor ya existe");
            }else {
                $records=$this->proveedor->save($_POST);
                $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
            } 
        }else{
            $records=$this->proveedor->update($_POST);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
        }
        echo json_encode($info);
    }

    public function getOneProveedor(){
        $records=$this->proveedor->getOneProveedor($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true, 'records'=>$records);
        }else{
            $info=array('success'=>false, 'msg'=>'El proveedor no existe.');
        }
        echo json_encode($info);
    }

    public function deleteProveedor(){
        $records=$this->proveedor->deleteProveedor($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Proveedor eliminado con exito");
        echo json_encode($info);
    }

}