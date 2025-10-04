 <title>Creacion de Cuentas || cashhack</title>
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Registro de usuarios</h1>
                  </div>
                  <div class="text-center">
                     <img  class="im2" src="assets/img/geekhack-logo.png" alt="">
                  </div>
                  <form name="formRegistro" method="post" action="?c=home&a=guardarregistro" id="formRegistro"  autocomplete="off" >
                    
                  <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="nombre" class="form-control" id="nombre"  placeholder="Nombre" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                        </div>
                        <input type="text" name="usuario" class="form-control"  id="usuarior"   placeholder="Usuario" required>
                    </div>
                    <div id="res_usu" class="text-right text-danger mb-3">
                        <p id="res_usutxt" class="small"></p>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="clave" class="form-control "  id="clave"  placeholder="Contraseña" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="correo" class="form-control" id="email"   placeholder="Correo Eléctronico" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="correo2" class="form-control"  id="emailc"  placeholder="Confirmar Correo Eléctronico" required>
                    </div>


                    <button class="btn btn-primary  btn-block" type="submit" >
                      Crear Cuenta
                    </button>
                    <a  class="btn btn-info  btn-block" href="index.php?c=home&a=index">Volver</a>
                    <hr>
                    <div id="msj"> </div>
                  </form>
                  <div class="text-center">
                  <div class="text-right text-danger mb-3">
                        <a class="small" href="#" onclick="dataprueba(1)">Data Prueba</a>
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
