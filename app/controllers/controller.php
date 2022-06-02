<?php
require_once "app/views/view.php";
class Controller {
    public $view;
    public function __construct($view,$parametro,$validar=false){
        $this->view=new View();
        if ($validar) {
            if (!isset($_SESSION)) {
                session_start();
            }
            if (!isset($_SESSION["id_usr"])) {
                $this->view->render("login");
                return;
            }
        }
        if (empty($parametro)) {
            $this->view->render($view);
            return;
        }
        if (method_exists($this,$parametro)) {
            $this->$parametro();
        } else {
            echo "no existe el metodo";
        }
    }
}