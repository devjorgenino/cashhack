<title>Movimientos||cashHACK</title>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                Listados de Movimientos
                <span class="mdb" data-toggle="modal" data-target="#imovimietos"> <i class="fas fa-plus mdb" ></i>|Cargar Movimientos|</span> 
            </div>
            <div class="card-body">
            
            <table id="tbMovimientos"  class="table table-striped table-bordered dt-responsive nowrap ocultar " style="width:100%">
            <thead>
              <tr class="text-center">
                <th class="text-cebter">FECHA</th>
                <th class="text-center">BANCO</th>
                <th class="text-center">CATEGORIA</th>
                <th class="text-center">REFERENCIA</th>
                <th class="text-left">DESCRIPCIÓN</th>
                <th class="text-right">MONTO</th>
                <th class="text-center"></th>
              </tr>
            </thead>
        
          </table>
          <br>
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                <p>
                  <a class="" href="#" id="excel" style="margin: 5px;">
                    <i class="fas fa-file-excel fa-2x"></i>
                  </a>
                  <a class="" href="#" id="csv" style="margin: 5px;">
                    <i class="fas fa-file-csv fa-2x"></i>
                  </a>
                  <a class="" href="#" id="pdf" style="margin: 5px;">
                    <i class="fas fa-file-pdf fa-2x"></i>
                  </a>
                  <a class="" href="#" id="print" style="margin: 5px;">
                    <i class="fas fa-print fa-2x"></i>
                  </a>
                </p>
            </div>
            <div class="card-footer text-muted">
               <small>¿Necesitas Ayuda?</small> 
            </div>
        </div>
        </div>
    </div>

</div>
<?php include('modal/modal.movimientos.php');?>