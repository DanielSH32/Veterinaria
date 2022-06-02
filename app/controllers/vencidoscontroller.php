<?php
include_once "app/models/vencidos.php";
class VencidosController extends Controller {
    private $vencido;
    public function __construct($parametro) {
        $this->vencido=new Vencidos();
        parent::__construct("vencidos",$parametro,true);
    }

    public function getVencidos() {
        $records=$this->vencido->getVencidos();
        $info=array('success'=>true,'records'=>$records);
        echo json_encode($info);
    }

    public function getReporte(){
        $registros=$this->vencido->getProductosReporte($_GET);
        //encabezado
        $htmlheader="<h1>Veterinaria La Mascota";
        $htmlheader.="<h3>Listado de productos vencidos</h3>";
        //cuerpo
        $html="<table width='100%' border='1'><thead><tr>";
        $html.="<th>Corr</th>";
        $html.="<th>Descripcion</th>";
        $html.="<th>Precio</th>";
        $html.="<th>Cantidad</th>";
        $html.="<th>Vencimiento</th>";
        $html.="<th>Proveedor</th>";
        $html.="</tr></thead><tbody>";
        foreach ($registros as $key => $value){
            $html.="<tr>";
            $html.="<td>".($key+1)."</td>";
            $html.="<td>{$value["descripcion"]}</td>";
            $html.="<td>{$value["precio"]}</td>";
            $html.="<td>{$value["cantidad"]}</td>";
            $html.="<td>{$value["vencimiento"]}</td>";
            $html.="<td>{$value["proveedor"]}</td>";
            $html.="</tr>";
        }
        $html.="</tbody></table>";
        $mpdfConfig=array(
            'mode'=>'utf-8',
            'format'=>'Letter',
            'default_font_size'=>0,
            'default_font'=>'',
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>40,
            'margin_header'=>10,
            'margin_footer'=>10,
            'orientation'=>'P'
        );
        $mpdf= new \Mpdf\Mpdf($mpdfConfig);
        $mpdf->SetHTMLHeader($htmlheader);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}