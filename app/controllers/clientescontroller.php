<?php
include_once "app/models/clientes.php";
class ClientesController extends Controller {
    private $cliente;
    public function __construct($parametro) {
        $this->cliente=new Clientes();
        parent::__construct("clientes",$parametro,true);
    }

    public function getAll() {
        $records=$this->cliente->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function getOneCliente(){
        $records=$this->cliente->getOneCliente($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true, 'records'=>$records);
        }else{
            $info=array('success'=>false, 'msg'=>'El cliente no existe.');
        }
        echo json_encode($info);
    }

    public function save(){        
        if ($_POST["id_cliente"]=="0") {
            $datosCliente=$this->cliente->getUserByNombre($_POST["nombre"], $_POST["apellido"]);
            if (count($datosCliente)>0) {
                $info=array('success'=>false,'msg'=>"El cliente ya existe");
            }else {
                $records=$this->cliente->save($_POST);
                $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
            }
            
        }else{
            $records=$this->cliente->update($_POST);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
        }
        echo json_encode($info);
    }

    public function deleteCliente(){
        $records=$this->cliente->deleteCliente($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Cliente eliminado con exito");
        echo json_encode($info);
    }

}