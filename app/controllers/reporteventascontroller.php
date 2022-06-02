<?php
include_once "app/models/facturas.php";
include_once "vendor/autoload.php";
class ReporteVentasController extends Controller {
    private $venta;
    //Metodo constructor
    public function __construct($parametro) {
        $this->venta=new Facturas();
        parent::__construct("reporteventas",$parametro,true);
    }

    public function getReporte(){
        $registros=$this->venta->getVentasReporte($_GET);
        
        //encabezado
        $htmlheader="<img src='icon.png' width='250' height='100' align=center>";
        $htmlheader.="<h2><b>Reporte de ventas</b></h2>";
        //cuerpo
        $html="<table width='100%' border='1'><thead><tr>";
        $html.="<th>Corr</th>";
        $html.="<th>No Factura</th>";
        $html.="<th>Cliente</th>";
        $html.="<th>Apellido</th>";
        $html.="<th>Productos</th>";
        $html.="<th>Cantidad</th>";
        $html.="<th>precio</th>";
        $html.="<th>Fecha</th>";
        $html.="</tr></thead><tbody>";
        foreach ($registros as $key => $value){
            $html.="<tr>";
            $html.="<td>".($key+1)."</td>";
            $html.="<td>{$value["num_factura"]}</td>";
            $html.="<td>{$value["nombre"]}</td>";
            $html.="<td>{$value["apellido"]}</td>";
            $html.="<td>{$value["descripcion"]}</td>";
            $html.="<td>{$value["cantidad"]}</td>";
            $html.="<td>{$value["precio"]}</td>";
            $html.="<td>{$value["fecha"]}</td>";
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
            'margin_top'=>50,
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