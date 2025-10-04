<title>Login || CashHack</title>
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Inicio de Sesión</h1>
                  </div>
                  <div class="text-center">
                     <img  class="im2" src="assets/img/geekhack-logo.png" alt="">
                  </div>
                  <form name="formLogin" method="post" action="?c=home&a=login" id="formLogin" >
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="nnombre" aria-describedby="emailHelp" placeholder="Ingrese su correo..." name="nnombre">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="npassword" placeholder="Ingrese su contraseña..." name="npassword">
                    </div>
                    <button class="btn btn-primary  btn-block" type="submit"  >
                      Iniciar Sesión
                    </button>
                    <a  class="btn btn-info  btn-block" href="index.php?c=home&a=registro">Registarse</a>
                    <hr>
                    <div id="msj"> </div>
                  </form>
                  <div class="text-center">
                  <div class="text-right  mb-3">
                        <a class="small" href="#" data-toggle="modal" data-target=".recuperar">Recuperar clave de acceso</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div> 
  </div> 
  <?php include ('modal/modal.recupera.php')?>
