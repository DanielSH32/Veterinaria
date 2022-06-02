<?php
include_once "app/models/compras.php";
class ComprasController extends Controller {
    private $compra;
    public function __construct($parametro) {
        $this->compra=new Compras();
        parent::__construct("compras",$parametro,true);
    }

    public function getAll() {
        $records=$this->compra->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function getOneCompra(){
        $records=$this->compra->getOneCompra($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true, 'records'=>$records);
        }else{
            $info=array('success'=>false, 'msg'=>'La compra no existe.');
        }
        echo json_encode($info);
    }

    public function save(){
        $img="";
        if (isset($_FILES)) {
            if (is_uploaded_file($_FILES["foto"]["tmp_name"])) {
                if (($_FILES["foto"]["type"]=="image/png") || ($_FILES["foto"]["type"]=="image/jpeg")) {
                    copy($_FILES["foto"]["tmp_name"], __DIR__."/../../public_html/fotos/".$_FILES["foto"]["name"])
                    or die("No se pudo copiar el archivo.");
                    $img=URL."public_html/fotos/".$_FILES["foto"]["name"];
                }
            }
        }
        if ($_POST["id_fact"]=="0") {
            $datosCompra=$this->compra->getCompraByNumero($_POST["no_fact"]);
            if (count($datosCompra)>0) {
                $info=array('success'=>false,'msg'=>"La factura ya existe");
            }else {
                $records=$this->compra->save($_POST,$img);
                $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
            }
            
        }else{
            $records=$this->compra->update($_POST,$img);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
        }
        echo json_encode($info);
    }

    public function saveProducto(){
        if ($_POST["id_producto"]=="0") {
            $records=$this->compra->saveProducto($_POST);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
            
        }else{
            $records=$this->compra->updateProducto($_POST);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
        }
        echo json_encode($info);
    }

    public function deleteCompra(){
        $records=$this->compra->deleteCompra($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Compra eliminada con exito");
        echo json_encode($info);
    }

}