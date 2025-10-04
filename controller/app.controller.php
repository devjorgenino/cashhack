<?php
require_once 'model/model.app.php';

class app_Controller
{

	private $model;
	public  $res;
	public  $resp;

	public function __CONSTRUCT()
	{
		$this->model = new App_Model();
	}
	/* Contabilidad  */
	public function contabilidad(){
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.menu.php';
		require_once 'view/view.contabilidad.php';
		require_once 'view/view.footer.php';
	}
	/* Contabilidad */
	/* Conciliacion  */
	public  function conciliacion(){
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.menu.php';
		require_once 'view/view.conciliacion.php';
		require_once 'view/view.footer.php';
	}
	/* Conciliacion */
	/*Movimientos*/
	public function guradarNota(){
		session_start();
		session_name("cashhack");
		if(!empty($_REQUEST['nota'])  or !empty($_REQUEST['idMovimiento']) ):
			$res=$this->model->modificar_mov($_REQUEST,$_SESSION['usuario']);
			echo $res;
			echo $this->alertas(2, "Datos Guardados");
		else:
			echo $this->alertas(2, "Faltan Datos");
		endif;
	}
	public function ver_movimiento(){
		$data = new \stdClass();
		sleep(1);
		if( isset($_REQUEST['id'])):
			$data->resp=1;
			$data->data = $this->model->cargarMovimientosId($_REQUEST['id']);
		else:
			$data->resp=-1;
		endif;

		echo json_encode($data);
	}
	public function dataTablaMovimiento()
	{
		session_start();
		session_name("cashhack");
		$data = $this->model->cargarMovimientos($_SESSION['usuario']);
		echo '{ "data":' . $data . '}';
	}
	public function errorIndentificar(){
		echo '<script>
				$("#fib").html("Error Archivo No Valido Para El Banco Selecionando");
				$("#fib").attr("class","cboncoi");
				setTimeout(function() {
					$("#imovimietos").modal("hide");;
				}, 3000);
			</script>';
	}
	public function bancaribeIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if(utf8_decode(substr($resp,1,4))==='0114'){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}else{
				$this->errorIndentificar();
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function bancrecerIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if(utf8_decode(substr($resp,0,34))==='"FECHA","REFERENCIA","DESCRIPCION"'){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}else{
				$this->errorIndentificar();
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function bodIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if(utf8_decode(substr($resp,0,34))==="Consulta de movimientos de cuentas"){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}else{
				$this->errorIndentificar();
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function bncIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if(utf8_decode(substr($resp,0,4))==="0191"){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}else{
				$this->errorIndentificar();
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function banescoIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if(utf8_decode(substr($resp,0,30))==="Código Cuenta Cliente: 0134"){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}elseif(trim(utf8_decode(substr($resp,0,46)))==="Fecha      Referencia  Descripción"){
				echo '<script>
						$("#fib").html("Archivo Valido | F:002");
					</script>';
					$form=2;
			}elseif(trim(utf8_decode(substr($resp,0,46)))==="Fecha     ;Referencia ;Descripción"){
				echo '<script>
						$("#fib").html("Archivo Valido | F:003");
					</script>';
					$form=3;
			}else{
			echo '<script>
						$("#fib").html("Error Archivo No Valido Para El Banco Selecionando");
						$("#fib").attr("class","cboncoi");
						setTimeout(function() {
							$("#imovimietos").modal("hide");;
						}, 3000);
					</script>';
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function mercantilIdentificar(){
		$form=null;
		$resp=$this->model->primeraLinea();
			if($this->validar_fecha_espanol(trim($resp))){
				$form=1;
				echo '<script>
						$("#fib").html("Archivo Valido | F:001 ");
					</script>';
			}else{
				$this->errorIndentificar();
			}
		if($form!=null){
			echo '<script>continuarCarga('.$this->res[0]['idb'].','.$form.','.$this->res[0]['id'].',"'.$_SESSION['nombre'].'","'.$this->res[0]['cuenta'].'","'.$this->res[0]['razon_comercial'].'")</script>';
		}
	}
	public function PrepararMovimientos($mov,$t){
		for ($i = 0; $i < count($mov); $i++) {
			if (floatval($mov[$i]->monto) >= 0.00) :
				$mov[$i]->tipo = 1;
			else :
				$mov[$i]->tipo = 2;
			endif;
			if($t==1){
			$tmp = explode('/', $mov[$i]->fecha);
			if (count($tmp) < 1) :
				$tmp = explode('-', $mov[$i]->fecha);
			endif;
			$fecha = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
			}else{
				$fecha=$mov[$i]->fecha;
			}
			$this->model->data .= "('" . $mov[$i]->referencia . "','" . $mov[$i]->referencia . "','" . $mov[$i]->referencia_2 . "','" . $fecha . "'," . floatval($mov[$i]->monto) . "," . "1" . ",
						" . $mov[$i]->tipo . ",'" . "operacion" . "','" . $mov[$i]->descripcion . "'," . $_REQUEST["cuenta"] . "," . $_SESSION['usuario'] . ")";
			if (($i + 1) < count($mov)) :
				$this->model->data .= ",";
			endif;
		}
	}
	public function procesarCSV(){
		sleep(1);
		session_start();
		session_name("cashhack");
		$this->res = $this->model->BuscarBancoId($_REQUEST['cuenta']);
		switch ($this->res[0]['idb']) {
			case 1: //banc o mercanti
				$mov = json_decode($this->model->CSVmercantil($_REQUEST['form']));
				$this->PrepararMovimientos($mov,1);
				$this->model->insertarMovimientos();
				break;
			case 2: //banco banesco
				$mov = json_decode($this->model->CSVBanesco($_REQUEST['form']));
				$this->PrepararMovimientos($mov,1);
				$this->model->insertarMovimientos();
				break;
			case 3: //banco bnc
				$mov = json_decode($this->model->CSVbnc($_REQUEST['form']));
				$this->PrepararMovimientos($mov,1);
				$this->model->insertarMovimientos();
				break;
			case 4: //banco bod
				$mov = json_decode($this->model->CSVbod($_REQUEST['form']));
				$this->PrepararMovimientos($mov,1);
				$this->model->insertarMovimientos();
				break;
			case 6: //banco bancaribe
				$mov = json_decode($this->model->CSVbancaribe($_REQUEST['form']));
				$this->PrepararMovimientos($mov,1);
				$this->model->insertarMovimientos();
				break;
			case 8: //banco bancrecer
				$mov = json_decode($this->model->CSVbancrecer($_REQUEST['form']));
				$this->PrepararMovimientos($mov,2);
				$this->model->insertarMovimientos();
				break;
			default:
				echo '<script>$("#cargador").html(loader(2));</script>';
				die();
			break;
		}
		//presentacion Restados
		echo 	'<script>
					$("#cargador").html(procesarCargar(5));
					$("#usuario3").html("Usuario: <br>"+"'.$_SESSION['nombre'].'");
					$("#tib3").html("Banco:'.$this->res[0]['razon_comercial'].'<br>Num: '.$this->res[0]['cuenta'].'");
					$("#i13").attr("src", "assets/img/'.$this->res[0]['idb'].'.png");
				 </script>';
		if($this->model->res>0){
			echo '<script>
				cerrarMovimiento();
					Movimientos();
					$("#envi3").html("OPERACION EXITOSA");
					$("#cuepo_impo").html("<br><div class=\"text-center msj \">TOTAL MOVIMIENTOS INSERTADOS|ACTUALIZADOS: <b>'.$this->model->res.'<b></div>");
				  </script>';
		}elseif($this->model->res==0){
			echo '<script>
					cerrarMovimiento();
					$("#envi3").html("ATENCION!!!");
					$("#cuepo_impo").html("<br><div class=\"text-center msj2 \">NO EXISTE MOVIMIENTOS POR ACTUALIZAR</div>");
				 </script>';
		}else{
			echo '<script>
				cerrarMovimiento();
					$("#envi3").html("HA OCURRIDO UN ERROR");
				 </script>';
		}
	}
	public function cargarCSVSubir()
	{
		sleep(1);
		session_start();
		session_name("cashhack");
		$this->res = $this->model->BuscarBancoId($_REQUEST['cuenta']);
		if ($_REQUEST['cuenta'] != "" and  $res  != -1 and $_FILES['csv']['error'] == 0) {
			$this->cuenta=$res[0]['id'];
			$moverCSV = copy($_FILES['csv']['tmp_name'], 'csv/' . $_SESSION['usuario'] . '.csv'); //deberia validar si se copio
			switch ($this->res[0]['idb']) {
				case 1: //banc o mercanti
					$this->mercantilIdentificar();
					echo '<script>
					 			$("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
						</script>';
					break;
				case 2: //banco banesco
					$this->banescoIdentificar();
					echo '<script>
					$("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
					   </script>';
					break;
				case 3: //banco bnc
					$this->bncIdentificar();
					echo '<script>
					$("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
					   </script>';
					break;
				case 4: //banco bod
					$this->bodIdentificar();
					echo '<script>
					 $("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
						</script>';
					break;
				case 6: //banco bancaribe
					$this->bancaribeIdentificar();
					echo '<script>
					 $("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
						</script>';
					break;
				case 8: //banco bancrecer
					$this->bancrecerIdentificar();
					echo '<script>
					 $("#ib").attr("src","assets/img/'.$this->res[0]['idb'].'.png");$("#tib").html("Banco: '.$this->res[0]['razon_comercial'].' Cuenta: '.$this->res[0]['cuenta'].'");
						</script>';
					break;
				default:
					echo '<script>$("#cargador").html(procesarCargar(4));</script>';
					die();
				break;

			}
			
		}else {
			echo $this->alertas(2, "Faltan Datos");
		}
	}
	private function validarCargaCuenta(){
		if( isset($_REQUEST['idCuenta'])):
			
			echo '<script>
					$(document).ready(function() {
					cargarMovimentosxc('.$_REQUEST['idCuenta'].');
					});
				  </script>';
		  endif;
	}
	public function movimientos()
	{
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.menu.php';
		require_once 'view/view.movimientos.php';
		require_once 'view/view.footer.php';
		$this->validarCargaCuenta();
		
	}
	public function importar_csv()
	{
		sleep(1);
		session_start();
		session_name("cashhack");
		$html = "";
		$res = $this->model->consultar_cuentas($_SESSION['usuario']);
		if ($res == -1) :
			echo $this->alertas(2, " Debe Registrar Cuentas");
		else :	
			echo "<script>$('#fim').attr('class', 'mostard');</script>";
			$html = '
				<div class="container">
					<div class="form-group row">
						<label for="inpuCuenta" ><i class="fa fa-university" aria-hidden="true"></i>Cuenta: </label>
							<select class="form-control" name="cuenta" id="cuenta" onchange="activarBotonesCsv(this);">
							<option value="0">Seleciones un Banco Cuenta</option>';
								foreach ($res as $b) :
									$html .= '<option value="' . $b['id'] . '" >	' . ucwords($b['producto']) . ' ' . ucwords($b['razon_comercial']) . ' Nro: ' . $b['cuenta'] . '</option>';
								endforeach;
								$html .= '				
						</select>
					</div>

					<div class="form-group row">
						<label for="inpuCuenta" ><i class="fa fa-university"aria-hidden="true"></i> Txt: </label>
							<input type="file" class="form-control archivo" name="csv" id="inputc" required disabled>
					</div>
				</div>';
			echo $html;
		endif;
	}
	/*Movimientos*/
	/*Productos */
	public function ModificarCuenta()
	{
		session_start();
		session_name("cashhack");
		if (empty($_REQUEST['tipoCuentaE'])  or empty($_REQUEST['id']) or empty($_REQUEST['bancoe']) or empty($_REQUEST['numCuentae']) or empty($_REQUEST['divisae']) or empty($_REQUEST['codigoBe'])) :
			echo $this->alertas(2, "Faltan Datos");
		else :
			$res = $this->model->validar_cuenta_editar($_REQUEST, $_SESSION['usuario']);
			if ($_REQUEST['montoCuenta'] == 2) :
				$_REQUEST['codigo']="";
			else :
				$_REQUEST['codigo']=$array['codigoB'];
			endif;
			if ($res == -1) :
				if (intval($_REQUEST['numCuentae']) == 0) :
					echo $this->alertas(2, "Error Numero Cuenta No Valido");
				else :
					$_REQUEST['montoCuentae'] = str_replace('.', '', $_REQUEST['montoCuentae']);
					$_REQUEST['montoCuentae'] = str_replace(',', '.', $_REQUEST['montoCuentae']);
					$res = $this->model->modificar_cuenta($_REQUEST, $_SESSION['usuario']);
					if ($res > 0) :
						echo $this->alertas(1, " Información Actualizada Satisfactoriamente");
						echo '<script>LimpiarProductose();</script>';
					else :
						echo $this->alertas(3, "Ha Ocurrido un Error");
					endif;
				endif;
			else :
				echo $this->alertas(2, "Cuenta Ya Registrada");
			endif;
		endif;
	}
	public function modificarProductos(){
		sleep(1);
		$data = new \stdClass();
		if (empty($_REQUEST['id'])) {
			$data->resp = -1;
		} else {
			$res = $this->model->BuscarCuentasDetalle($_REQUEST['id']);
			if ($res == -1) :
				$data->resp = -1;
			else :
				$data->resp = 1;
				$data->p = "";
				$data->b = "";
				$data->d = "";
				$resc = $this->model->BuscarProductos();
				if ($res != 1) :
					foreach ($resc as $r) {
						$data->p .= $r['id'] ==  $res[0]['tipo'] ? '<option value="' . $r['id'] . '" selected >' . ucwords($r['nombre']) . '</option>' : '<option value="' . $r['id'] . '">' . ucwords($r['nombre']) . '</option>';
					} else :
					$data->resp = -3;
				endif;
				$resc = $this->model->cargarBancosTipo($res[0]['tipo_bancos']);
				if ($res != 1) :
					foreach ($resc as $r) {
						$data->b .= $r['id'] ==  $res[0]['banco'] ? '<option value="' . $r['id'] . '" data-cod="' . $r['codigo'] . '" selected>' . ucwords($r['razon_comercial']) . '</option>' : '<option value="' . $r['id'] . '" data-cod="' . $r['codigo'] . '">' . ucwords($r['razon_comercial']) . '</option>';
					} else :
					$data->resp = -3;
				endif;
				$resc = $this->model->cargarDivisaTipo($res[0]['tipo_divisa']);
				if ($res != 1) :
					foreach ($resc as $r) {
						$data->d .= $r['id'] ==  $res[0]['divisa'] ? '<option value="' . $r['id'] . '" data-cod="' . $r['simbolo'] . '" selected>' . ucwords($r['nombre']) . '</option>' : '<option value="' . $r['id'] . '" data-cod="' . $r['simbolo'] . '">' . ucwords($r['nombre']) . '</option>';
					} else :
					$data->resp = -3;
				endif;
				$data->n = $res[0]['cuentareal'];
				$data->s = number_format(floatval($res[0]['saldo']), 2, ',', '.');
			endif;
		}
		echo (json_encode($data));
	}
	public function iproductos(){
		session_start();
		session_name("cashhack");
		$res = $this->model->modificar_estatus($_REQUEST, $_SESSION['usuario']);
		if ($res == 1) :
			if ($_REQUEST['estatus'] == 1) :
				echo $this->alertas(1, '<span class="badge badge-pill badge-danger">Inactivo</span>');
			else :
				echo $this->alertas(1, '<span class="badge badge-pill badge-success">Activo</span>');
			endif;
			echo '<script>
						cargarCuentas();
						setTimeout(function() {
							$(".ad_cuenta").modal("hide");
						}, 3000);
				 </script>';
		else :
			echo $this->alertas(3, " Ha Ocurrido un Error");
		endif;

	}
	public function diproductos(){
		session_start();
		session_name("cashhack");
		sleep(1);
		$res = $this->model->consultarCuenta_id($_REQUEST, $_SESSION['usuario']);
		if ($res != -1):
			$res[0]['fecha_creacion'] = new DateTime($res[0]['fecha_creacion']);
			$res[0]['fecha_creacion'] = $res[0]['fecha_creacion']->format('Y-m-d H:i:s');
		else:
			$res=-1;
		endif;

		echo json_encode($res);
	}
	public function eproductos()
	{
		session_start();
		session_name("cashhack");
		sleep(1);
		$res = $this->model->eliminar_cuenta($_REQUEST, $_SESSION['usuario']);
		if ($res == 1) :
			echo $this->alertas(1, " Producto Eliminado");
			echo '<script>
						cargarCuentas();
						setTimeout(function() {
							$(".eproducto").modal("hide");
						}, 3000);
				 </script>';
		else :
			echo $this->alertas(3, " Ha Ocurrido un Error");
		endif;
	} 
	public function data_eliminar()
	{
		session_start();
		session_name("cashhack");
		sleep(1);
		$res = $this->model->consultarCuenta_id($_REQUEST, $_SESSION['usuario']);
		if ($res != -1):
			$res[0]['fecha_creacion'] = new DateTime($res[0]['fecha_creacion']);
			$res[0]['fecha_creacion'] = $res[0]['fecha_creacion']->format('Y-m-d H:i:s');
		else:
			$res=-1;
		endif;

		echo json_encode($res);
	}
	public function cargarCuentas()
	{
		session_start();
		session_name("cashhack");
		$data = $this->model->consultarCuenta($_SESSION['usuario']);
		for ($i = 0; $i < count($data); $i++) {
			$data[$i]['saldo'] = number_format($data[$i]['saldo'], 2, ',', '.');
		}

		echo '{ "data":' . json_encode($data) . '}';
	}
	public function registro_cuenta()
	{
			session_start();
			session_name("cashhack");
			sleep(1);
			if (empty($_REQUEST['tipoCuenta']) or empty($_REQUEST['banco']) or empty($_REQUEST['numCuenta']) or empty($_REQUEST['divisa']) or empty($_REQUEST['codigoB'])) :
				echo $this->alertas(2, "Faltan Datos");
				echo "<script>
							$('#ftr').attr('class', 'mostrard');
				 		 </script>";
			else :
				$res = $this->model->validar_cuenta($_REQUEST, $_SESSION['usuario']);
				if ($res == -1) :
					if (intval($_REQUEST['numCuenta']) == 0) :
						echo $this->alertas(2, "Error Numero Cuenta No Valido");
					else :
						$_REQUEST['montoCuenta'] = str_replace('.', '', $_REQUEST['montoCuenta']);
						$_REQUEST['montoCuenta'] = str_replace(',', '.', $_REQUEST['montoCuenta']);
						if ($_REQUEST['montoCuenta'] == 2) :
							$_REQUEST['codigo']="";
						else :
							$_REQUEST['codigo']=$array['codigoB'];
						endif;
						$res = $this->model->registrar_cuenta($_REQUEST, $_SESSION['usuario']);
						if ($res == 1) :
							echo $this->alertas(1, "Producto Registrada");
							 echo '<script>
							 		LimpiarProductos();
							 	  </script>';
						else :
							echo $this->alertas(3, "Ha Ocurrido un Error");
						endif;
					endif;
				else :
					echo $this->alertas(2, " Este Producto se encuentra Registrada");
					echo "<script>
							$('#ftr').attr('class', 'mostrard');
				 		 </script>";
				endif;
			endif;
	}
	public function consultarMaestrosD()
	{
		sleep(1);
		$html =  new \stdClass();
		$b = $this->model->cargarDivisaTipo($_REQUEST['id']);
		if ($this->b = -1) :
			$html->data = "";
			$html->data .= "<option value='' >Selecione</option>";
			foreach ($b as $r) :
				$html->data .= '<option value="' . $r['id'] . '" data-cod="' . $r['simbolo'] . '">' . ucwords($r['nombre']) . '</option>';
			endforeach;
		else :
			return $html->data = -1;
		endif;

		echo json_encode($html);
	}
	public function consultarMaestros()
	{
		sleep(1);
		$html = "";
		$b = $this->model->cargarBancosTipo($_REQUEST['id']);
		if ($this->b = -1) :
			$html .= "<option value='' >Selecione</option>";
			foreach ($b as $r) :
				$html .= '<option value="' . $r['id'] . '" data-cod="' . $r['codigo'] . '">' . ucwords($r['razon_comercial']) . '</option>';
			endforeach;
		else :
			return $html = -1;
		endif;
		print_r($html);
	}
	public function productos()
	{
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.menu.php';
		$this->res = $this->model->BuscarProductos();
		require_once 'view/view.productos.php';
		require_once 'view/view.footer.php';
	}
	/*Productos*/
	/*Dashboard */
	public function dashboard()
	{
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.menu.php';
		require_once 'view/view.dashboard.php';
		require_once 'view/view.footer.php';
		$res=$this->monitorvee(1);
		if(json_decode($res)!=-1){
			echo '<script>dashboard('.$res.');</script>';
		}
	}
	public function monitorvee($id){
	$host="http://127.0.0.1/monitor_intra/api/";
	$cosultas=array(
		"api.cotizacionDolar.php"
	);
	switch ($id) {
		case 1:
			$res=file_get_contents($host.$cosultas[0]);
		break;
	}
	return $res;
	}
	/*Dashboard*/
	/*clave general*/
	private function alertas($id, $msj)
	{
		switch ($id) {
			case 1:
				echo  '
						<div class="msj">
						<strong><i class="fa fa-check"></i> Exito! </strong>' . $msj . '
						</div>
						';
				break;
			case 2:
				echo  '
						<div class="msj2 text-center" role="alert">
						<strong><i class="fas fa-exclamation-triangle"></i></strong>' . $msj . '
						</div>
						';
				break;
			case 3:
				echo '
						<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
						<strong><i class="fa fa-skull-crossbones"></i> Error!</strong>' . $msj . '
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>
						';
				break;
		}
	}
	function validar_fecha_espanol($fecha){
		$valores = explode('/', $fecha);
		if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
			return true;
		}
		return false;
	}
	/*clave general*/
	public function logout()
	{
		session_start();
		session_name("cashhack");
		session_unset();
		session_destroy();
		echo ' <script>
			  window.location.href = "index.php";
			  </script>';
	}
}
