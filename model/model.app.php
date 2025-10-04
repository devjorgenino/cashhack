<?php
require_once("classes/classes.data.php");
class App_Model {
    public $bd;
    public $referencia;
    public $passwd;
    public $data;
    public $res;
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
    public function eliminar($sql){
        $this->dbServer->connect();
        $res=$this->dbServer->getQuery($sql);
        $res=pg_affected_rows($res);
        return $res;
    }
    //FUNCIONES BASICAS
    //movimientos
    public function modificar_mov($array,$id){
        $query="UPDATE bancos.movimientos_info SET nota='".$array['nota']."',  subcategoria=".$array['dsubCategoria']."";
        $query.=" WHERE id=".$array['idMovimiento']." ";
       return pg_affected_rows($this->modificar($query));
    }
    public function listar_SubCategoria($id){
        $query= "SELECT * FROM bancos.subcategorias where categoria=".$id;
        $query.= " order by codigo";
        return $this->consultas($query);
    }
    public function cargarMovimientosId($id){   
        $query= "SELECT * ,(SELECT string_agg(concat('<option value=\"',id,'\">',titulo,'</option>'), '') FROM bancos.subcategorias where categoria=um.titulon group by categoria ) as opciones FROM bancos.v_usuario_movimientos um";
        $query.= " WHERE idmov=".intval($id);
        $query.= " ORDER BY fecha DESC";
        $resp =$this->consultas($query);
        $resp[0]['monto'] = number_format($resp[0]['monto'], 2,',','.');
        return $resp;
    }
    public function cargarMovimientos($id){   
        $query= "SELECT * FROM bancos.v_usuario_movimientos";
        $query.= " WHERE usuario=".intval($id);
        $query.= " ORDER BY fecha DESC";
        $resp =$this->consultas($query);
        if ($resp != -1) {
            $row=$resp;
        } else {
            $row = [];
        }
       for ($i=0; $i <count($row) ; $i++) {
                $row[$i]['monto'] = number_format($row[$i]['monto'], 2,',','.');
            }
        return json_encode($row);
    }
    public function CSVmercantil($f) {
        $linea = 0;
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array=[];
        $monto = "";
        while (!feof($archivo)) {
          $datos= fgets($archivo);
          $datos= utf8_decode($datos);
          $dato=preg_split("/[\t]/",$datos);
          if (count($dato) > 1):
          $tmp = strtolower(trim($dato[1]));
          if (($tmp != 'saldo inicial') && ($tmp != 'saldo final')):
            $arreglo['fecha']=strtolower(trim($dato[0]));
            $desc = explode('-',$tmp);
            $arreglo['tipo']=strtolower(trim($desc[0]));
            $arreglo['descripcion']=strtolower(trim($desc[1]));
            $arreglo['referencia']=strtolower(trim($dato[2]));
            $arreglo['referencia_2']=strtolower(trim($dato[2]));
            $arreglo['tipo']="";
            if ($dato[3] != ""):
                $monto = trim($dato[3]);
            else:
                $monto = trim($dato[4]);
            endif;
            if(substr($monto, -3, 1)=='.'):
                $monto = str_replace(',' , '.' , $monto);
            else:
                $monto = str_replace('.' , '' , $monto);
                $monto = str_replace(',' , '.' , $monto);
            endif;
            $arreglo['monto'] = floatval($monto);
            array_push($array,$arreglo);
          endif;
        endif;
        }
        fclose($archivo);
        return json_encode($array);
    }
    public function CSVbancrecer($f) {
        $campos = ['fecha'=>14, 'tipo'=>13,'refrencia'=>14, 'descripcion'=>34, 'monto'=>13, 'saldo'=>0];
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array = [];
        $i=1;
        while (!feof($archivo)) {
            $dato = null;
            $datos = fgets($archivo);
            $datos= utf8_decode($datos);
                if($i>1):
                     if (utf8_decode(trim($datos)) != ""):
                        $datos=str_replace('"' , '' , $datos);
                        $dato = $this->getLineData(",", $datos, $campos);
                        $arreglo['fecha']=strtolower(trim($dato[0]));
                        $arreglo['referencia']=strtolower(trim($dato[1]));
                        $arreglo['referencia_2']=strtolower(trim($dato[1]));
                        $arreglo['descripcion']=strtolower(trim($dato[2]));
                        if($dato[3]==''):
                            $monto=$dato[4].','.$dato[5];
                            $monto = str_replace('.' , '' , $monto);
                            $monto = str_replace(',' , '.' , $monto);
                            $monto=floatval($monto);
                        else:
                            $monto=$dato[3].','.$dato[4];
                            $monto = str_replace('.' , '' , $monto);
                            $monto = str_replace(',' , '.' , $monto);
                            $monto=floatval($monto)*(-1);
                        endif;
                        $arreglo['monto'] = floatval($monto);
                        //$arreglo['monto'] =strtolower(trim($dato[3])).','.strtolower(trim($dato[4])).','.strtolower(trim($dato[5]));
                        array_push($array,$arreglo);
                    endif;
                endif;
                $i++;
        }
        fclose($archivo);
        return json_encode($array);
    }
    public function CSVbancaribe($f) {
        $campos = ['fecha'=>14, 'tipo'=>13,'refrencia'=>14, 'descripcion'=>34, 'monto'=>13, 'saldo'=>0];
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array = [];
        $i=1;
        while (!feof($archivo)) {
            $dato = null;
            $datos = fgets($archivo);
            $datos= utf8_decode($datos);
                if($i>1):
                     if (utf8_decode(trim($datos)) != ""):
                        $dato = $this->getLineData(";", $datos, $campos);
                        $arreglo['fecha']=strtolower(trim($dato[0]));
                        $arreglo['referencia']=strtolower(trim($dato[1]));
                        $arreglo['referencia_2']=strtolower(trim($dato[1]));
                        $arreglo['descripcion']=strtolower(trim($dato[2]));
                        $arreglo['tipo']="";
                        $monto = trim($dato[4]);
                        $monto = str_replace('.' , '' , $monto);
                        $monto = str_replace(',' , '.' , $monto);
                        if(trim($dato[3])=='D'):
                            $monto=floatval($monto)*(-1);
                        else:
                            $monto=floatval($monto);
                        endif;
                        $arreglo['monto'] = floatval($monto);
                        array_push($array,$arreglo);
                    endif;
                endif;
                $i++;
        }
        fclose($archivo);
        return json_encode($array);
    }
    public function CSVbod($f) {
        $campos = ['fecha'=>14, 'tipo'=>13,'refrencia'=>14, 'descripcion'=>34, 'monto'=>13, 'saldo'=>0];
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array = [];
        $i=1;
        while (!feof($archivo)) {
            $dato = null;
            $datos = fgets($archivo);
            $datos= utf8_decode($datos);
                if($i>8):
                     if (utf8_decode(trim($datos)) != ""):
                        $dato = $this->getLineData("fixed2", $datos, $campos);//preguntar a bernardo
                        $arreglo['fecha']=strtolower(trim($dato[0]));
                        $arreglo['referencia']=strtolower(trim($dato[2]));
                        $arreglo['referencia_2']=strtolower(trim($dato[2]));
                        $arreglo['descripcion']=strtolower(trim($dato[3]));
                        $arreglo['tipo']=strtolower(trim($dato[3]));
                        $monto = trim($dato[4]);
                        $arreglo['monto'] = floatval($monto);
                        array_push($array,$arreglo);
                    endif;
                endif;
                $i++;
        }
        fclose($archivo);
        return json_encode($array);
    }
    public function CSVbnc($f) {
        $campos = ['fecha'=>11, 'refrencia'=>12, 'descripcion'=>66, 'monto'=>27, 'saldo'=>30];
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array = [];
        $i=1;
        while (!feof($archivo)) {
            $dato = null;
            $datos = fgets($archivo);
	        $datos= utf8_decode($datos);
                if($i>3):
                     if (utf8_decode(trim($datos)) != ""):
                            $dato = $this->getLineData("tab", $datos, $campos);
                            $dato =explode(";",$dato); 
                            if(strtolower(trim($dato[5]))!='saldo inicial'):
                            $arreglo['fecha']=strtolower(trim($dato[0]));
                            $arreglo['referencia']=strtolower(trim($dato[2]));
                            $arreglo['referencia_2']=strtolower(trim($dato[10]));
                            $arreglo['descripcion']=strtolower(trim($dato[6]));
                            $arreglo['tipo']="";
                            if($dato[7]==0):
                                $monto = trim($dato[8]);
                            else:
                                $monto = trim($dato[7]);
                            endif;
                            $monto = str_replace('.' , '' , $monto);
                            $monto = str_replace(',' , '.' , $monto);
                            $arreglo['monto'] = floatval($monto);
                            array_push($array,$arreglo);
                        endif;
                    endif;
                endif;
                $i++;
        }
        fclose($archivo);
        return json_encode($array);
    }
    public function CSVBanesco($f) {
        $campos = ['fecha'=>11, 'refrencia'=>12, 'descripcion'=>66, 'monto'=>27, 'saldo'=>30];
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $array = [];
        if (!feof($archivo)):
            $datos = fgets($archivo);
            $datos= utf8_decode($datos);
            $tmp = preg_replace("/[\t]/", ";", $datos);
            if (count($tmp) > 1):
                $sep = 'tab';
            else:
                $tmp = explode(';',$datos);
                if (count($tmp) > 1):
                    $sep = ';';
                else:
                    $sep = 'fixed';
                endif;
            endif;
        endif;
        if($f==1){
            feof($archivo);
            fgets($archivo);
        }
        while (!feof($archivo)) {
            $dato = null;
                $datos = fgets($archivo);
                if (utf8_decode(trim($datos)) != ""):
                    $dato = $this->getLineData($sep, $datos, $campos);
                    $dato=str_replace(';','',$dato);
                    $arreglo['fecha']=strtolower(trim($dato[0]));
                    $arreglo['referencia']=strtolower(trim($dato[1]));
                    $arreglo['referencia_2']=strtolower(trim($dato[1]));
                    $arreglo['descripcion']=strtolower(trim($dato[2]));
                    $arreglo['tipo']="";
                    $monto = trim($dato[3]);
                    $monto = str_replace('.' , '' , $monto);
                    $monto = str_replace(',' , '.' , $monto);
                    $arreglo['monto'] = floatval($monto);
                    array_push($array,$arreglo);
                endif;
        }
        fclose($archivo);

        return json_encode($array);
    }
    public function primeraLinea(){
        $datos=null;
        $archivo = fopen('csv/' . $_SESSION['usuario'] . '.csv', 'r');
        $cabecera="";
        if (!feof($archivo)):
            $datos = fgets($archivo);
            $cabecera =utf8_encode($datos);
        endif;
        fclose($archivo);
        return $cabecera;
    }
    private function getLineData($sep, $datos, $campos) {
        switch ($sep):
            case 'tab':
                $dato = preg_replace("/[\t]/", ";", $datos);
                break;
            case ';':
                $dato = explode(';',$datos);
                break;
            case ',':
                    $dato = explode(',',$datos);
                    break;
            case ',':
                $dato = explode(' ',$datos);
                break;
            case 'fixed':
                $start = 0;
                foreach ($campos as $key=>$val):
                    $dato[] = str_replace('ó','o',trim(substr($datos, $start, $val)));
                    $start+=$val;
                endforeach;
                break;
            case 'fixed2':
                $start = 0;
                foreach ($campos as $key=>$val):
                    $dato[] = trim(substr($datos, $start, $val));
                    $start+=$val;
                endforeach;
                break;
        endswitch;
        return $dato;
    }
    public function insertarMovimientos(){
        $sql="INSERT INTO bancos.movimientos (codigo,referencia,referencia_2,fecha,monto,divisa,tipo,operacion,descripcion,cuenta,usuario) "; 
        $sql.="VALUES".$this->data;
        $sql.="ON CONFLICT (referencia,usuario,fecha,cuenta,monto)DO NOTHING returning movimientos.id;";
        $this->dbServer->connect();
        $res=$this->dbServer->getQuery($sql);
        $this->res=$res=pg_affected_rows($res);
        if($this->model->res>0):
        $this->data=$res=pg_fetch_assoc($res);
        endif;
    }
    public function consultar_cuentas($id){   
        $query="select * from bancos.v_cuenta_descripcion as b
        WHERE usuario=$id and tipo=1 and (select count(*) from maestros.identificar_banco where id_banco=b.idb) >0 ";
        return $this->consultas($query);
    }
    public function BuscarBancoId($id){   
        $query = "SELECT * FROM bancos.v_cuenta_descripcion";
        $query .= " WHERE id=".$id;
        return $this->consultas($query);
    }
    //movimientos
    //productos
    public function BuscarCuentasDetalle($id) {
        $query = "select bc.id,bc.referencia,SUBSTRING( bc.referencia, 5, 19) as cuentaReal,bc.divisa,bc.tipo,bc.banco,bc.saldo,(select tipo from bancos.bancos  where id=bc.banco) as tipo_bancos, (select tipo from maestros.divisas  where id=bc.divisa) as tipo_divisa from bancos.cuentas bc";
        $query .= " WHERE bc.id=".$id."";
        return $this->consultas($query);
    }
    public function modificar_estatus($array, $id){
        $query='UPDATE bancos.cuentas SET estatus=( CASE WHEN estatus=1 THEN 2 ELSE 1 END)';
        $query.= ' WHERE id='.$array['id'].' and usuario='.$id;
        return pg_affected_rows($this->modificar($query));
    }
    public function eliminar_cuenta($array, $id){
        $query= 'DELETE FROM bancos.cuentas';
        $query.= ' WHERE id='.$array['id'].' and usuario='.$id;
        return $this->eliminar($query);
    }
    public function consultarCuenta_id($array,$id){
        $query= 'SELECT id,estatus,(SELECT razon_comercial from bancos.bancos where id=bancos.cuentas.banco) as nombre, referencia, fecha_creacion FROM bancos.cuentas ';
        $query.= 'where id='.$array['id'].' and usuario='.$id;
        return $this->consultas($query);
    }
    public function consultarCuenta($id){   
        $query= 'SELECT * FROM bancos.v_usuariocuenta';
        $query.= ' WHERE idusuario='.intval($id).'order by idcuenta desc';
        $resp =$this->consultas($query);
        if ($resp ==-1) {
            return [];
        } else {
            return  $resp;
        }
    }
    public function registrar_cuenta($array,$id){   

        $query= "insert into bancos.cuentas (codigo, referencia, estatus, fecha_mod, activo,
        numero, aba, iban, bic, tipo, divisa, banco, saldo_inicial, titulo, saldo, fecha_saldo, swift, usuario)
        values(
        '".$array['codigoB']."',
        '".$_REQUEST['codigo'].$array['numCuenta']."',
        1 ,
        '".date('Y-m-d')."' ,
        true,
        '".$array['codigoB'].$array['numCuenta']."',
        'aba' ,
        'iban' ,
        'bic' ,
        ".$array['tipoCuenta']." ,
        ".$array['divisa']." ,
        ".$array['banco']." ,
        ".$array['montoCuenta']." ,
        'titulo' ,
        ".$array['montoCuenta']." ,
        '".date('Y-m-d')."' ,
        'swift',
        ".$id." )";
        return $this->insertar($query);
    }
    public function validar_cuenta($array,$id){   
        $query= "SELECT * FROM bancos.v_usuarioCuenta";
        $query.= " WHERE numero='".$array['codigoB'].$array['numCuenta']."' and cod='".$array['codigoB']."' and idusuario=".$id;    
        return $this->consultas($query);
    }
    public function cargarDivisaTipo($id){   
        $query= "SELECT * FROM maestros.divisas";
        $query.= " where tipo='".$id."'";
        return $this->consultas($query);
    }
    public function BuscarProductos() {
        $query = "SELECT * FROM  maestros.productos";
        $query .= " WHERE activo='true'";
        $resp =$this->consultas($query);
        return $resp;
    }
    public function cargarBancosTipo($id){   
        $query= "SELECT * FROM bancos.bancos";
        $query.= " where tipo=".$id;
        return $this->consultas($query);
    }
    public function validar_cuenta_editar($array,$id){   
        $query= "SELECT * FROM bancos.v_usuarioCuenta";
        $query.= " WHERE numero='".$array['codigoBe'].$array['numCuentae']."' and cod='".$array['codigoBe']."' and idcuenta!=".$array['id'];    
        return $this->consultas($query);
    }
    public function modificar_cuenta($array,$id){
        $query= "UPDATE bancos.cuentas SET";
        $query.= "
        codigo= '".$array['codigo']."',
        referencia='".$array['codigoBe'].$array['numCuentae']."',
        numero='".$array['codigoBe'].$array['numCuentae']."',
        banco=".$array['bancoe'].",
        tipo=".$array['tipoCuentaE'].",
        saldo=".floatval($array['montoCuentae']).",
        fecha_saldo= '".date('Y-m-d')."'
        where id =".$array['id'];   
        return pg_affected_rows($this->modificar($query));
    }
    //productos
}
?>
