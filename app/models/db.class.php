<?php
class BaseDeDatos {
    //Propiedades heredadas
    protected $conexion;
    protected $isConnected=false;
    
    //Metodos
    public function conectar()  {
        //Conectarse a la base de datos
        $this->conexion=new mysqli("localhost","root","catolica","lamascota");
        if ($this->conexion->connect_errno) {
            echo "Error de conexion:{$this->conexion->connect_error}";
            $this->isConnected=false;
        } else {
            $this->isConnected=true;
        }
        return $this->isConnected;
    }

    public function executeQuery($query) {
        $result=$this->conexion->query($query);
        //Devuelte un vector con los registros
        $records=array();
        while ($record=$result->fetch_assoc()) {
            $records[]=$record;
        }
        return $records;
    }

    public function executeInsert($query){
        $result=$this->conexion->query($query);
        echo $this->conexion->error;
        //Devuelve el ID del campo insertado
        return $this->conexion->insert_id;
    }
}