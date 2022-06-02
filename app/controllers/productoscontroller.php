<?php
include_once "app/models/productos.php";
class ProductosController extends Controller {
    private $producto;
    public function __construct($parametro) {
        $this->producto=new Productos();
        parent::__construct("productos",$parametro,true);
    }

    public function getAll() {
        $records=$this->producto->getAll();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function getOneProducto(){
        $records=$this->producto->getOneProducto($_GET["id"]);
        if (count($records)>0) {
            $info=array('success'=>true, 'records'=>$records);
        }else{
            $info=array('success'=>false, 'msg'=>'El producto no existe.');
        }
        echo json_encode($info);
    }

    public function save(){
        $imgp="";
        $imgm="";
        $imgg="";
        
        if (isset($_FILES)) {
            //imagen pequena
            if (is_uploaded_file($_FILES["fotop"]["tmp_name"])) {
                if (($_FILES["fotop"]["type"]=="image/png") || ($_FILES["fotop"]["type"]=="image/jpeg")) {
                    copy($_FILES["fotop"]["tmp_name"], __DIR__."/../../public_html/fotos/".$_FILES["fotop"]["name"])
                    or die("No se pudo copiar el archivo.");
                    $imgp=URL."public_html/fotos/".$_FILES["fotop"]["name"];
                }
            }
             //imagen mediana
             if (is_uploaded_file($_FILES["fotom"]["tmp_name"])) {
                if (($_FILES["fotom"]["type"]=="image/png") || ($_FILES["fotom"]["type"]=="image/jpeg")) {
                    copy($_FILES["fotom"]["tmp_name"], __DIR__."/../../public_html/fotos/".$_FILES["fotom"]["name"])
                    or die("No se pudo copiar el archivo.");
                    $imgm=URL."public_html/fotos/".$_FILES["fotom"]["name"];
                }
            }
             //imagen grande
             if (is_uploaded_file($_FILES["fotog"]["tmp_name"])) {
                if (($_FILES["fotog"]["type"]=="image/png") || ($_FILES["fotog"]["type"]=="image/jpeg")) {
                    copy($_FILES["fotog"]["tmp_name"], __DIR__."/../../public_html/fotos/".$_FILES["fotog"]["name"])
                    or die("No se pudo copiar el archivo.");
                    $imgg=URL."public_html/fotos/".$_FILES["fotog"]["name"];
                }
            }
        }
        if ($_POST["id_producto"]=="0") {
            $datosProducto=$this->producto->getUserByDescripcion($_POST["descripcion"]);
            if (count($datosProducto)>0) {
                $info=array('success'=>false,'msg'=>"El producto ya existe");
            }else {
                $records=$this->producto->save($_POST,$imgp,$imgm,$imgg);
                $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
            }
            
        }else{
            $records=$this->producto->update($_POST,$imgp,$imgm,$imgg);
            $info=array('success'=>true,'msg'=>"Registro Guardado con éxito");
        }
        echo json_encode($info);
    }

    public function deleteProducto(){
        $records=$this->producto->deleteProducto($_GET["id"]);
        $info=array('success'=>true,'msg'=>"Producto eliminado con exito");
        echo json_encode($info);
    }

}