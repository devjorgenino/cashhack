<?php
require_once("classes/classes.data.php");
class Home_Model {
    public $bd;
    public $referencia;
    public $passwd;
    public $activo=true;

    public function __construct() {
        $this->dbServer = new Data("cashhack");
    }
    //FUNCIONES BASICAS
    public function insertar($sql){
        $this->dbServer->connect();
        $res=$this->dbServer->getQuery($sql);
        $res=pg_affected_rows($res);
        return $res;
    }
    public function consultas($sql){
        $this->dbServer->connect();
        $res=$this->dbServer->getQuery($sql);
            if (pg_num_rows($res) > 0) {
                $ret=pg_fetch_all($res);
            } else {
                $ret = -1;
            }
            return $ret;
    }
    public function modificar($sql){
        $this->dbServer->connect();
        $res=$this->dbServer->getQuery($sql);
        return $res;
    }
    //FUNCIONES BASICAS
    public function login() {
        $query="select * from seguridad.usuarios where referencia=LOWER('".$this->referencia."') and passwd='".MD5($this->passwd)."' and activo='".$this->activo."' ";
        return $this->consultas($query);
    }
    public function validarUser($id) {
        $query="select * from seguridad.usuarios where referencia='".$id."' ";

        return $this->consultas($query);
    }
    public function recuperar_clave($id) {
        $query="select * from seguridad.usuarios where referencia=LOWER('".$id."')";
        return $this->consultas($query);
    }
    public function reset_clave($id,$pass) {
        $query="UPDATE seguridad.usuarios SET passwd=MD5('".$pass."') ";
        $query.="where referencia=LOWER('".$id."')";
        return $this->modificar($query);
    }
    public function registrarUser($array){
       $sql= "INSERT INTO seguridad.usuarios (codigo,referencia,nombre,apellido,estatus,activo,passwd,email,telefono,ciudad,pais,zona_postal,fecha_creacion,empresa)
       VALUES ('".$array['usuario']."', '".$array['usuario']."', '".$array['nombre']."', '".$array['usuario']."', 0, true, MD5('".$array['clave']."'), '".$array['correo']."', NULL, 134, 1, NULL, now(), 0)";
      return $this->insertar($sql);
    }
}
?>
