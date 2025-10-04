<title>Productos||cashHACK</title>
<?php
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                Listados de productos 
                <i class="ad fas fa-plus" data-toggle="modal" data-target=".nproducto"></i>
            </div>
            <div class="card-body">
            <table id="tbProductos"  class="table table-striped table-bordered dt-responsive nowrap ocultar " style="width:100%" >
                <thead>
                    <tr>
                        <th>N° CUENTA</th>
                        <th>BANCO</th>
                        <th>FECHA SALDO</th>
                        <th>SALDO</th>
                        <th>ESTATUS</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
            
                </tbody>
            </table>
            </div>
            <div class="card-footer text-muted">
               <small>¿Necesitas Ayuda?</small> 
            </div>
        </div>
        </div>
    </div>

</div>
<?php include('modal/modal.productos.php');?>