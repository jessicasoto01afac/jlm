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

      $sql15 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artiedidettvp2 = mysqli_query($conexion,$sql15);
      
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
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedithpreddett()"
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
                <button type="button" onclick="savedithdettpred()" id="saveedithpredidett" style="display:none;"
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
<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE PREPEDIDOS -->
<div class="modal fade" id='modal-delearprednew' name='modal-delearprednew'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE PREPEDIDOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletearpred" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-20">
                    <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE PREPEDIDO?</p>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="del_artprednew" id="del_artprednew">
                    <!-- <input disabled="" class="form-control inputalta" type="text" name="deartprednew" id="deartprednew"> -->
                    <textarea disabled="" class="form-control inputalta" type="text" name="deartprednew" id="deartprednew" cols="5" rows="5"></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="savdelevpartpred()"
                        class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                    <br>
                </div>
                <div style="display:none;" id="delerarprednew" name="delerarprednew" class="alert alert-danger"
                    role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-close alert-icon tx-24"></i>
                        <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar
                            un
                            ticket</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA AGREGAR ARTICULO INDIVIDUAL EN INFO DE PREPEDIDOS-->
<div class="modal fade" id='modal-addartpedinfo'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">AGREGAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcliped" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_pediinf" id="id_pediinf">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivudualinf()" id="codindivinf"
                                    name="codindivinf" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artin2 = mysqli_fetch_row($articuindv2)):?>
                                    <option value="<?php echo $artin2[0]?>"><?php echo $artin2[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pincantidinf" id="pincantidinf"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pindeparinnf" id="pindeparinnf"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="ppinfbsertrass"
                                    id="ppinfbsertrass" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div style="display:none;" id="edthvinbli1inf" name="edthvinbli1inf" class="alert alert-warning"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthinfvcp" name="edthinfvcp" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvinperr1inf" name="edthvinperr1inf" class="alert alert-danger"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button type="button" onclick="addarinpredinfo()" id="addarinpro2" name="addarinpro2"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN VISTA PREVIA EN PEDIDOS-->
<div class="modal fade" id='modal-edithdetprepedinf'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edithpedidoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a id="openedithinfpredido" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editpreddettinf()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a id="closedithinfpredido" style="float: right;font-size: 16px;display:none; color: white"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedithpreddettinf()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_prededithinf" id="id_prededithinf">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextdettvp()" id="deinfprededith"
                                    name="deinfprededith" type="text" disabled data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttrasdett = mysqli_fetch_row($artiedidettvp2)):?>
                                    <option value="<?php echo $arttrasdett[0]?>"><?php echo $arttrasdett[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="predeinfcant"
                                    id="predeinfcant" placeholder="Ingrese la cantidad" disabled type="number"
                                    required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="pedobsaddinf"
                                    id="pedobsaddinf" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savedithinfpred()" id="saveedithprediinf" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithextinflle" name="edithextinflle" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="errpediinf" name="errpediinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE PREPEDIDOS -->
<div class="modal fade" id='modal-delearpredinf' name='modal-delearpredinf'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE PREPEDIDOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletearpredinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-20">
                    <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE PREPEDIDO?</p>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="del_artpredinf" id="del_artpredinf">
                    <!-- <input disabled="" class="form-control inputalta" type="text" name="deartprednew" id="deartprednew"> -->
                    <textarea disabled="" class="form-control inputalta" type="text" name="deartpredinf" id="deartpredinf" cols="5" rows="5"></textarea>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="savdelevpartpredinf()"
                        class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                    <br>
                </div>
                <div style="display:none;" id="delerarpredinf" name="delerarpredinf" class="alert alert-danger"
                    role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-close alert-icon tx-24"></i>
                        <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar
                            un
                            ticket</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA HISTORIAL-->
<div class="modal fade" id='modal-predhistorial'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">VISTA DE HISTORIAL</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="col-12">
                <div class="card bd-0 pd-30">
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Historial</h6>
                    <div class="mg-t-20 tx-13">
                        <a href="javascript:pdfhistory()" class="tx-gray-600 hover-info">Generar Reporte</a>
                    </div>
                </div><!-- card -->
            </div>
            <div class="modal-body pd-25">
                <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Registros de movimientos</a></h4>
                <div id="tabhisto" name="tabhisto"></div>
            </div><!-- modal-body -->
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save
                    changes</button>
                <button type="button"
                    class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Close</button>
            </div> -->
        </div>
    </div>
</div><!-- modal -->