<?php
class DashboardController extends Controller {
    
    //Metodo constructor
    public function __construct($parametro) {
        parent::__construct("dashboard",$parametro,true);
    }
}