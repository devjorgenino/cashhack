<!-- Productos nuevo-->
<div class="modal fade nproducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"><!-- modal-->
	<div class="modal-dialog modal-md">
		<!-- modal2-->
		<div class="modal-content">
			<!-- modal3-->
			<div class="modal-header">
                <!-- header-->
				Productos / Crear Cuenta<i class="cd fas fa-times" data-dismiss="modal" ></i>

			</div><!-- header-->

			<div class="modal-body">
                <div class="row">
                    <div class="col-12" id="cn">
                    </div>
                </div>
				<!-- body-->
                <br>
				<form method="post" action="?c=app&a=registro_cuenta" name="formRegistroCuenta" id="formRegistroCuenta">
                        <!-- form-->
                        <div class="row">
                            <!-- row-->
                            <div class="col-md-12 col-sm-12">
                                <!-- row12-->
                                <div class="form-group">
                                    <label for="exampleInputPassword1" >Tipo de Producto</label>
                                    <select class="custom-select form-control" id="tipoCuenta" name="tipoCuenta" onChange="productosSelect(this);">
                                        <option></option>
                                        <?php 
                                            foreach ($this->res as $r) {
                                                echo '<option value="'.$r['id'].'">'.ucwords($r['nombre']).'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div><!-- row12-->
                        </div><!-- row-->

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <!-- row12-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1" >Banco</label>
                                    <select class="custom-select form-control" id="banco" name="banco" onChange="bancosSelect(this);" disabled>
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div><!-- row12-->
                        </div><!-- row-->

                        <div class="row">
                            <!-- row-->
                            <div class="col-md-12 col-sm-12">
                                <!-- row12-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="tipo" >Moneda</label>
                                    <select class="custom-select form-control" id="divisa" name="divisa"
                                        onChange="divisaSelect(this);" disabled>
                                        <option>Selecione</option>
                                    </select>
                                </div>
                            </div><!-- row12-->
                        </div><!-- row-->

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <!-- row12-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1" id="cuenta" >N° de cuenta</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <input type="hidden" id="codigoB" name="codigoB" value="">
                                            <span class="input-group-text" id="tc"></span>
                                        </div>
                                        <input type="text" class="form-control" id="numCuenta" name="numCuenta"
                                            onkeypress="return soloNum(event)" placeholder="" disabled>
                                    </div>
                                </div>
                            </div><!-- row12-->
                        </div><!-- row-->

                        <div class="row">
                            <!-- row-->
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" >Saldo actual</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="montoCuenta" name="montoCuenta"
                                            onkeypress="return decimal(event)" placeholder="0,00" disabled>
                                        <!--<div class="input-group-prepend">
                                            <span class="input-group-text" id="ts"></span>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div><!-- row-->
                        <div class="modal-footer" >
                         <div id="ftr">
                            <button type="submit" class="btn btn-success" id="enviarFormulario"  disabled="true">
                                Guardar 
                            </button>

                            <button type="reset" class="btn btn-primary" id="limpiarc" onclick=desabitarBotonesCuenta(1) disabled="true">
                                Limpiar 
                            </button>
                            </div>
                        </div>
                        <!--  -->
				</form><!-- form-->
			</div><!-- body-->
		</div><!-- modal3-->
	</div><!-- modal2-->
</div><!-- modal-->
<!-- Productos nuevo-->
<!-- Productos eliminar-->
<div class="modal fade eproducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<!-- modal-->
	<div class="modal-dialog">
		<!-- modal2-->
		<div class="modal-content">
			<!-- modal3-->
			<div class="modal-header">
                <!-- header-->
				Productos / Eliminar<i class="cd fas fa-times" data-dismiss="modal" ></i>

			</div><!-- header-->

			<div class="modal-body"><!-- body-->
            <div  class="col-md-12 col-sm-12" id="li">
            
            </div>
            <form class="form_ec ocultard" id="form_ec" method="post" action="?c=app&a=eproductos"  >
							<div class="col-md-12 col-sm-12">
							<input type="hidden" name="id"  id="idCuenta" value="">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="alert text-center" role="alert">
                                        ¿Desea Eliminar el Producto?
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inpuCuenta" class="col-sm-5 col-form-label"><i class="fa fa-university" aria-hidden="true"></i>Banco: </label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" value="" id="bancon" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inpuCuenta" class="col-sm-5 col-form-label"><i class="fa fa-university" aria-hidden="true"></i>Numero Cuenta: </label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" value=""  id="numero"  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputFecha" class="col-sm-5 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                                        Fecha Registro: </label>
                                    <div class="col-sm-7">
                                        <input type="text"  class="form-control" value="" id="fecha"  readonly>
                                    </div>
                                </div>
							</div>

			</div><!-- body-->
			<div class="modal-footer">
                <div id="mfe">                        
                    <button type="submit" class="btn btn-success" id="btn-ec" disabled><i class="far fa-save"></i>&nbsp;Si</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;No</button>
                </div>    
			</div>
			</form>

		</div><!-- modal3-->
	</div><!-- modal2-->
</div><!-- modal-->
<!-- Productos eliminar-->
<!-- editar Productos-->
<div class="modal fade ad_cuenta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<!-- modal-->
	<div class="modal-dialog">
		<!-- modal2-->
		<div class="modal-content">
			<!-- modal3-->
            <div class="modal-header">
                <!-- header-->
				Productos / Activar-Inactivar Producto<i class="cd fas fa-times" data-dismiss="modal" ></i>

			</div><!-- header-->

			<div class="modal-body"><!-- body-->
            <div class="col-12" id="rep_ad"></div>
			<form class="form_ad" id="form_ad"  method="post" action="?c=app&a=iproductos"> 
							  
            <div class="col-md-12 col-sm-12">
                <input type="hidden" name="id"  id="idCuentaa" value="">
                <input type="hidden" name="estatus"  id="estatus" value="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="alert text-center" role="alert">
                            ¿Desea Cambiar de Estatus del Producto?
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inpuCuenta" class="col-sm-5 col-form-label"><i class="fa fa-university" aria-hidden="true"></i>Banco: </label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value="" id="bancona" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inpuCuenta" class="col-sm-5 col-form-label"><i class="fa fa-university" aria-hidden="true"></i>Numero Cuenta: </label>
                        <div class="col-sm-7">
                        <input type="text" class="form-control" value=""  id="numeroa"  readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputFecha" class="col-sm-5 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                            Fecha Registro: </label>
                        <div class="col-sm-7">
                            <input type="text"  class="form-control" value="" id="fechaa"  readonly>
                        </div>
                    </div>
                </div>

			</div><!-- body-->
			<div class="modal-footer">
                    <div id="fi">
                        <button type="submit" class="btn  btn-success" id="btn-adc" disabled><i class="far fa-save"></i>&nbsp;Si</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;No</button>
                    </div>
            </div>

			</form>

		</div><!-- modal3-->
	</div><!-- modal2-->
</div><!-- modal-->
<!-- editar Productos-->
<div class="modal fade editarCuenta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<!-- modal-->
	<div class="modal-dialog modal-md">
		<!-- modal2-->
		<div class="modal-content">
        <div class="modal-header">
                <!-- header-->
				Productos / Editar Producto<i class="cd fas fa-times" data-dismiss="modal" ></i>

			</div><!-- header-->

			<div class="modal-body">
				<!-- body-->

				<div class="row">
                <div class="col-md-12 col-sm-12">
					<!-- row-->
                    <div id="contenido2">
				    </div>
                    </div>
				</div><!-- row-->
				<br>							
				<div style="display: none;" id="contenido">
					<form class="formularioee" id="formularioee">
							<!-- form-->
							<input type="hidden" name="fechaSaldoe" value="<?php  echo date("d-m-Y");?>">
							
							<div class="row">
								<!-- row-->
								<div class="col-md-12 col-sm-12">
									<!-- row12-->
									<div class="form-group">
										<input type="hidden" id="id" name="id" value="">
										<label for="exampleInputPassword1" class="letrasmodal">Tipo de Producto</label>
										<select class="custom-select form-control" id="tipoCuentaE" name="tipoCuentaE"
											onChange="productosSelectEditar(this);" required>
											<option></option>
										</select>
									</div>
								</div><!-- row12-->
							</div><!-- row-->


							<div class="row">
								<div class="col-md-12 col-sm-12">
									<!-- row12-->
									<div class="form-group">
										<label for="exampleInputEmail1" class="letrasmodal">Banco</label>
										<select class="custom-select form-control" id="bancoe" name="bancoe"
											onChange="bancosSelectEditar(this);" required>
											<option value="">Selecione</option>
										</select>
									</div>
								</div><!-- row12-->
							</div><!-- row-->

							<div class="row">
								<!-- row-->
								<div class="col-md-12 col-sm-12">
									<!-- row12-->
									<div class="form-group">
										<label for="exampleInputEmail1" id="tipo" class="letrasmodal">Moneda</label>
										<select class="custom-select form-control" id="divisae" name="divisae"
											onChange="divisaSelectEditar(this);" required>
											<option value="">Selecione</option>
										</select>
									</div>
								</div><!-- row12-->
							</div><!-- row-->   

							<div class="row">
								<div class="col-md-12 col-sm-12">
									<!-- row12-->
									<div class="form-group">
										<label for="exampleInputEmail1" id="cuenta" class="letrasmodal">N° de cuenta</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<input type="hidden" id="codigoBe" name="codigoBe" value="">
												<span class="input-group-text" id="tce"></span>
											</div>
											<input type="text" class="form-control" id="numCuentae" name="numCuentae"
												onkeypress="return soloNum(event)" maxlength="16" minlength="16" required>
										</div>
									</div>
								</div><!-- row12-->
							</div><!-- row-->

							<div class="row">
								<!-- row-->
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<label for="exampleInputPassword1" class="letrasmodal">Saldo actual</label>
										<div class="input-group">
											<input type="text" class="form-control" id="montoCuentae" name="montoCuentae"
												onkeypress="return decimal(event)" placeholder="0,00">
											<!--<div class="input-group-prepend">
												<span class="input-group-text" id="tse"></span>
											</div>-->
										</div>
									</div>
								</div>
							</div><!-- row-->
							<!-- <button type="submit" class="btn agregar btn-block" id="formularioe" form="formularioee" disabled="true">
								Modificar 
							</button> -->
				
                            <div class="modal-footer">
                                    <div id="fm">
                                    <button type="submit" class="btn btn-success " id="formularioe" form="formularioee" disabled="true"><i class="fas fa-save"></i>&nbsp;
                                        Modificar 
                                    </button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Cancelar</button>
                                    </div>
                            </div>
                     </form><!-- form-->
				</div>
			</div><!-- body-->

		</div><!-- modal3-->
	</div><!-- modal2-->
</div><!-- modal-->
<!-- editar Productos-->