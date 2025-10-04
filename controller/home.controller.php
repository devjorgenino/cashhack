<?php
require_once 'model/model.login.php';

class Home_Controller
{

	private $model;

	public function __CONSTRUCT()
	{
		$this->model = new Home_Model();
	}
	/*registro */
	public function validar_user(){
		if(!empty($_REQUEST["id"])):
			$res=$this->model->validarUser($_REQUEST["id"]);
			print_r($res);
		else:
			echo -1;
		endif;
	}
	public function registro()
	{
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.registro.php';
		require_once 'view/view.footer.php';
	}
	public function guardarregistro(){
		if(!empty($_REQUEST['nombre']) && !empty($_REQUEST['usuario'])  && !empty($_REQUEST['clave']) && !empty($_REQUEST['correo']) ):
		$res=$this->model->registrarUser($_REQUEST);
			if($res>0):
				echo '<p class="text-center alert alert-success">Usuario Registrado...</p>';
				echo '<script>setTimeout(function () {
					window.location.href = "index.php?c=home&a=index";
			}, 3000);</script>';
			//notificacion de bienvenidos;
			$this->notificaciones($_REQUEST['correo'], "Bienvendo", "http://vps01.geekhack.net.ve/cashhack", "Hola ".$_REQUEST['nombre'] . "definir mensajes" ,"Gracias por Registrar en cashhack");
			else:
				echo '<p class="text-center alert alert-danger">Verifique su datos...</p>';	
			endif;
		else:
			echo '<p class="text-center alert alert-danger">Faltan datos</p>';
		endif;
	}
	/*registro */
	public function index()
	{
		require_once 'view/view.headerPrincipal.php';
		require_once 'view/view.login.php';
		require_once 'view/view.footer.php';
	}

	public function login()
	{
		if (isset($_REQUEST['nnombre']) and  isset($_REQUEST['npassword'])) :
			$this->model->referencia = $_REQUEST['nnombre'];
			$this->model->passwd = $_REQUEST['npassword'];
			$this->res = $this->model->login();
			if ($this->res == -1) :
				echo '<p class="text-center alert alert-danger">Credenciales Inválidas</p>';
			else :
				session_start();
				session_name("cashhack");
				$_SESSION['usuario'] = $this->res[0]['id'];
				$_SESSION['nombre'] = $this->res[0]['nombre'];
				echo '<p class="text-center alert alert-success">Usuario Válido...</p>';
				echo '<script>setTimeout(function () {
						window.location.href = "index.php?c=app&a=dashboard";
				}, 1000);</script>';
			endif;
		else :
			echo '<p class="text-center alert alert-danger">Credenciales Inválidas</p>';
		endif;
	}
	public function recuperar_clave()
	{
		$res = $this->model->recuperar_clave($_REQUEST['usuario']);
		if ($res != -1) :
			$code=$this->generarCodigo(12);
			$this->model->reset_clave($_REQUEST['usuario'],$code); 
			$res = $this->notificaciones($res[0]['email'], "Recuperacion de Clave", "http://vps01.geekhack.net.ve/cashhack", "Usuario " . $res[0]['referencia'] . " Clave " . $code,"Reinicio de Clave");
			if ($res != -1) :
				$this->alertas(1, ' Hemos enviado la Contraseña a su Correo Electronico');
				echo '<script>
						setTimeout(function() {
							$(".recuperar").modal("hide");
							LimpiarFC();
						}, 3000);
						</script>';
			else :
				$this->alertas(3, ' Ha Ocurrido Un  error al Enviar Email');
			endif;
		else :
			$this->alertas(2, ' Usuario no Valido');
		endif;
	}
	private function alertas($id, $msj)
	{
		switch ($id) {
			case 1:
				echo  '
						<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
						<strong><i class="fa fa-check"></i> Exito! </strong>' . $msj . '
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>
						';
				break;
			case 2:
				echo  '
						<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
						<strong><i class="fas fa-exclamation-triangle"></i></strong>' . $msj . '
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
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
	public function notificaciones($usuario, $tipo, $enlace, $contenido,$titulo)
	{
		$array = new \stdClass();
		$array->email = $usuario;
		$array->asunto = urlencode($tipo);
		$array->titulo = urlencode($titulo);
		$array->contenido = urlencode($contenido);
		$array->enlace = $enlace;
		$res = json_decode(file_get_contents("http://vps01.geekhack.net.ve/cashhack/mail/index.php?array=" . serialize($array)));
		if ($res == 1) :
			return 1;
		else :
			return -1;
		endif;
	}
	public function generarCodigo($longitud){
        $key = '';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
    }
}
