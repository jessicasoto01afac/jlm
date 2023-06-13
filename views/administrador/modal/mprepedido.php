<?php include ("../controller/conexion.php");

    
      $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);

      $sql1 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $extendido = mysqli_query($conexion,$sql1);

      $sqlex1 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $extendidomas = mysqli_query($conexion,$sqlex1);

      $sql2 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $etiquetas = mysqli_query($conexion,$sql2);

      $sql3 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo2 = mysqli_query($conexion,$sql3);

      $sql4 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo3 = mysqli_query($conexion,$sql4);

      $sql5 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuloedth = mysqli_query($conexion,$sql5);

      $sql6 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuloedth1 = mysqli_query($conexion,$sql6);

      $sql7 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuloedth2 = mysqli_query($conexion,$sql7);

      $sql8 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuloedth3 = mysqli_query($conexion,$sql8);

      $sql9 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuindv = mysqli_query($conexion,$sql9);

      $sql10 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artieditrnas = mysqli_query($conexion,$sql10);

      $sql11 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artiedidettvp = mysqli_query($conexion,$sql11);

      $sql12 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articuindv2 = mysqli_query($conexion,$sql12);

      $sql13 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articusurvp = mysqli_query($conexion,$sql13);

      $sql14 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artisuvpfn = mysqli_query($conexion,$sql14);
      
    ?>


<!-- <link rel="stylesheet" href="../template/css/card.css"> -->
<link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
<script src="../template/js/sweetalert2.all.min.js"></script>

<style>
.swal-wide {
    width: 500px !important;
    font-size: 16px !important;
}
</style>

<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN VISTA PREVIA EN PEDIDOS-->
<div class="modal fade" id='modal-edithdetprepedi'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edithpedido" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a id="openedithpredido" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editpreddett()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a id="closedithpredido" style="float: right;font-size: 16px;display:none; color: white"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedithpeddett()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_prededithdett" id="id_prededithdett">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextdettvp()" id="dedttprededith"
                                    name="dedttprededith" type="text" disabled data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttrasdett = mysqli_fetch_row($artiedidettvp)):?>
                                    <option value="<?php echo $arttrasdett[0]?>"><?php echo $arttrasdett[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="prededettcant"
                                    id="prededettcant" placeholder="Ingrese la cantidad" disabled type="number"
                                    required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pededthdepardell"
                                    id="pededthdepardell" placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="pedobsadddetll"
                                    id="pedobsadddetll" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savedithdettpred()" id="saveedithpedidett" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithextdettlle" name="edithpdidettlle" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="errpedidett" name="errpedidett" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->