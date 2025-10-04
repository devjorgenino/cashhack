<div class="modal fade" id="imovimietos" role="dialog">
<form class="form_imp" id="form_imp" enctype="multipart/form-data" >
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
            Movimientos / Importar<i class="cd fas fa-times" data-dismiss="modal" ></i>
            </div>
            <br>
            <div  class="modal-body" >
                <div id="cargador" class="ocultard"></div>
                <div  id="cuepo_impo"></div>
            </div>
                  <div class="modal-footer"  >
                    <div id="fim" class="ocultard">
                        <button type="submit" class="btn btn-success" id="btn-im" disabled><i class="far fa-save"></i>&nbsp;Importar</button>
                        <button type="button"  class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Cerrar</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>
<div class="modal fade" id="ver_movimiento" role="dialog">
<form class="form_imp" id="form_cm" method="POST" action="?c=app&a=guradarNota"  >
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header ">
            Movimientos / Detalle<i class="cd fas fa-times" data-dismiss="modal" ></i>
            </div>
            <div  class="modal-body" >
            <div id="res-de"></div>
                <div class="ocultard"  id="bdetalle">
                    <input type="hidden" name="idMovimiento" id="id" value="">
                    <div class="form-group row">
                        <label for="inpuCuenta" class="col-sm-4 col-form-label"><i class="fa fa-university"
                                aria-hidden="true"></i>
                            Banco: </label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="dbanco" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inpuCuenta" class="col-sm-4 col-form-label"><i class="fa fa-university"
                                aria-hidden="true"></i>
                            Cuenta: </label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control"  id="dcuenta" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inpuCuenta" class="col-sm-4 col-form-label"><i class="fa fa-university"
                                aria-hidden="true"></i>
                            descripcion: </label>
                        <div class="col-sm-8">
                        <textarea class="form-control" id="ddescripcion" rows="2" readonly></textarea>
                        <!-- <input type="text" class="form-control"   value="" readonly> -->
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="inputFecha" class="col-sm-4 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                                Categoria: </label>
                            <div class="col-sm-8">
                                <input type="text"  class="form-control" value="" id="dcategoria"  readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="inputFecha" class="col-sm-4 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                            Sub Categoria: </label>
                        <div class="col-sm-8">
                        <select class="custom-select form-control" id="dsubCategoria" name="dsubCategoria">
                            </select>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="inputFecha" class="col-sm-4 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                            Nota: </label>
                        <div class="col-sm-8">
                        <!-- <input type="text" class="form-control" id="dnota" name="nota" onkeypress="return letraNumero(event)" placeholder="Nota" value=""> -->
                        <textarea class="form-control" id="dnota" rows="2"  name="nota" o></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputNumeroOperacion" class="col-sm-4 col-form-label"><i class="fa fa-info-circle"
                                aria-hidden="true"></i>
                            Referencia: </label>
                            <div class="col-sm-8">
                            <div class="input-group">
                            <input type="text"  class="form-control" value="" id="dreferencia"   readonly>
                        </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputMontoBs" class="col-sm-4 col-form-label"><i class="far fa-money-bill-alt"
                                aria-hidden="true"></i>
                            Monto Bs.:
                        </label>
                        <div class="col-sm-8">
                        <input type="text"  class="form-control"  value="" id="dmonto"  readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputFecha" class="col-sm-4 col-form-label"><i class="fa fa-calendar" aria-hidden="true"></i>
                        Fecha: </label>
                    <div class="col-sm-8">
                        <input type="text"  class="form-control" value="" id="dfecha"  readonly>
                    </div>
                    </div>
                </div>
            </div>
                  <div class="modal-footer"  >
                    <div id="fm" class="ocultard">
                        <button type="submit" class="btn btn-success" id="btn-cm" disabled="true"><i class="far fa-save"></i>&nbsp;Guardar</button>
                        <button type="button"  class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times"></i>&nbsp;Cerrar</button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>