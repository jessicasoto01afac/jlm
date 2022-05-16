<?php include ("../controller/conexion.php");

    
      $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);

      $sql1 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $extendido = mysqli_query($conexion,$sql1);

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
<!-- MODAL PARA EDITAR ARTICULOS. -->
<div class="modal fade" id='modal-editarticul'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editusu" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedart" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editart()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditar" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthart()"
                        title="Cerrar edición">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_art"
                        id="id_art">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO<span class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edicod" id="edicod">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edides" id="edides">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">UBICACIÓN:<span
                                        class="tx-danger">*</span></label>
                                <select disabled="" type="text" class="form-control inputalta" id="editubi"
                                    name="editubi" data-placeholder="Eliga una opción">
                                    <option value="">ELEGIR UNA OPCIÓN</option>
                                    <option value="ALMACEN">ALMACEN</option>
                                    <option value="BODEGA">BODEGA</option>
                                    <option value="COMPRAS">COMPRAS</option>
                                    <option value="EMPAQUE">EMPAQUE</option>
                                    <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                    <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">UNIDAD:<span class="tx-danger">*</span></label>
                                <select disabled="" type="text" class="form-control inputalta" id="edituni"
                                    name="edituni" data-placeholder="Eliga una opción">
                                    <option value="">ELEGIR UNA OPCIÓN</option>
                                    <option value="BOLSA">BOLSA</option>
                                    <option value="CAJA">CAJA</option>
                                    <option value="FCO.">FCO.</option>
                                    <option value="HOJAS">HOJAS</option>
                                    <option value="JUEGO">JUEGO</option>
                                    <option value="KILO">KILO</option>
                                    <option value="METRO">METRO</option>
                                    <option value="MILLAR">MILLAR</option>
                                    <option value="PAQUETE">PAQUETE</option>
                                    <option value="PIEZA">PIEZA</option>
                                    <option value="ROLLO">ROLLO</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">GRUPO:<span class="tx-danger">*</span></label>
                                <select disabled="" type="text" class="form-control inputalta" id="editgrup"
                                    name="editgrup" data-placeholder="Eliga una opción">
                                    <option value="">ELEGIR UNA OPCIÓN</option>
                                    <option value="P.TERMINADO">P.TERMINADO</option>
                                    <option value="EXTENDIDO">EXTENDIDO</option>
                                    <option value="INSUMOS">INSUMOS</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savearedith()" id="artguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdubliar" name="edthdubliar" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El articulo ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvaciar" name="edthvaciar" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edtherrar" name="edtherrar" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Error!</strong> No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS-->
<div class="modal fade" id='modal-deleteart'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR AL ARTICULO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_art"
                    id="del_art">
                <input disabled="" class="form-control inputalta" type="text" name="deart" id="deart">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedeart()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerar" name="delerar" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR UISUARIOS-->
<div class="modal fade" id='modal-editusu'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR USUARIO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editusu" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedius" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editusuarios()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditus" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeusu()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_per"
                        id="id_per">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">NOMBRE(S): <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edinom" id="edinom">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">APELLIDOS <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="ediapell" id="ediapell">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CORREO ELECTRONICO<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="editcorre"
                                    id="editcorre">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">USUARIO<span class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="editusu1" id="editusu1">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CONTRASEÑA<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="editcontra"
                                    id="editcontra">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">Privilegios: <span
                                        class="tx-danger">*</span></label>
                                <select disabled="" type="text" class="form-control inputalta" id="editprivi"
                                    name="editprivi" data-placeholder="Eliga una opción">
                                    <option value="">ELEGIR UNA OPCIÓN</option>
                                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                    <option value="ALMACEN">ALMACEN</option>
                                    <option value="COMPRAS">COMPRAS</option>
                                    <option value="BODEGA">BODEGA</option>
                                    <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                    <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                    <option value="VENTAS">VENTAS</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveusuedit()" id="usuguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdubli" name="edthdubli" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvacios" name="edthvacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edtherr" name="edtherr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR USUARIOS-->
<div class="modal fade" id='modal-deleteusu'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR AL USUARIO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_per"
                    id="del_per">
                <input disabled="" class="form-control inputalta" type="text" name="deusu" id="deusu">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedelusu()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
                <br>
                <div style="display:none;" id="delerr" name="delerr" class="alert alert-danger" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-close alert-icon tx-24"></i>
                        <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                            ticket</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-editclient'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR CLIENTES</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedicli" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editcli()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditcli" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthcli()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_cli"
                        id="id_cli">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicocli" id="edicocli">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">NOMBRE: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithnom" id="edithnom">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">RFC:<span class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="editrfc" id="editrfc">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CORREO:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="editcorrc"
                                    id="editcorrc">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savecliedith()" id="clieguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdclibli" name="edthdclibli" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclivacios" name="edthclivacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclierr" name="edthclierr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR CLIENTES-->
<div class="modal fade" id='modal-deletecli'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR AL CLIENTE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_clie"
                    id="del_clie">
                <input disabled="" class="form-control inputalta" type="text" name="decli" id="decli">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedecli()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrcli" name="delerrcli" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR PROVEEDORES-->
<div class="modal fade" id='modal-editprov'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR PROVEEDOR</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditpro" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editprov()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditpro" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthpro()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_prov"
                        id="id_prov">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="editcodigo_pro" id="editcodigo_pro">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CONDICIONES DE PAGO: <span
                                        class="tx-danger">*</span></label>
                                <select disabled="" type="text" class="form-control inputalta" id="editcondi_pago"
                                    name="editcondi_pago" data-placeholder="Eliga una opción">
                                    <option value="">SELECCIONA UNA OPCIÓN</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                    <option value="CONTADO">CONTADO</option>
                                    <option value="7 DIAS">7 DIAS</option>
                                    <option value="8 DIAS">15 DIAS</option>
                                    <option value="15 DIAS">15 DIAS</option>
                                    <option value="30 DIAS">30 DIAS</option>
                                    <option value="45 DIAS">45 DIAS</option>
                                    <option value="60 DIAS">60 DIAS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">NOMBRE: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="editnom_pro" id="editnom_pro">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">DOMICILIO FISCAL: <span
                                        class="tx-danger">*</span></label>
                                <textarea disabled="" onkeyup="mayus(this);" rows="3" class="form-control"
                                    name="edithdomi_fisc" id="edithdomi_fisc"
                                    placeholder="Ingresa el domicilio fiscal"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group mg-b-4-force">
                                <label style="font-size:16px;" disabled="" class="form-control-label label2">CONTACTO
                                    1<span class="tx-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="icon ion-person tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" class="form-control "
                                        name="edtcont_1" id="edtcont_1" placeholder="Nombre de contacto 1">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" title="ingresar el telefono"
                                        name="edthtel_c1" id="edthtel_c1" class="form-control inputalta"
                                        placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" name="edithtel_c2"
                                        id="edithtel_c2" class="form-control inputalta" placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c1"
                                        id="edithemail_c1" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c2"
                                        id="edithemail_c2" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group mg-b-4-force">
                                <label style="font-size:16px;" disabled="" class="form-control-label label2">CONTACTO
                                    2<span class="tx-danger"></span></label>
                            </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="icon ion-person tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" class="form-control"
                                        name="edithcont_2" id="edithcont_2" placeholder="Nombre de contacto 2">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" title="ingresar el telefono"
                                        name="edithtel_c3" id="edithtel_c3" class="form-control inputalta"
                                        placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" class="form-control inputalta"
                                        name="edithtel_c4" id="edithtel_c4" placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c3"
                                        id="edithemail_c3" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c4"
                                        id="edithemail_c4" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <!-- contacto3 -->
                        <div class="col-lg-12">
                            <div class="form-group mg-b-4-force">
                                <label style="font-size:16px;" disabled="" class="form-control-label label2">CONTACTO
                                    3<span class="tx-danger"></span></label>
                            </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="icon ion-person tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" class="form-control"
                                        name="edithcont_3" id="edithcont_3" placeholder="Nombre de contacto 3">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" title="ingresar el telefono"
                                        name="edithtel_c5" id="edithtel_c5" class="form-control inputalta"
                                        placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                                    <input onkeyup="mayus(this);" disabled="" type="text" class="form-control inputalta"
                                        name="edithtel_c6" id="edithtel_c6" placeholder="(999) 999-9999">
                                </div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c5"
                                        id="edithemail_c5" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                            class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                                    <input type="text" disabled="" class="form-control inputalta" name="edithemail_c6"
                                        id="edithemail_c6" placeholder="ingresar@correo">
                                </div>
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="3" class="form-control"
                                    name="edithobser_prov" id="edithobser_prov"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveprovedith()" id="provguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthprove" name="edthprove" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthprovacios" name="edthprovacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthproerr" name="edthproerr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR PROVEEDORES-->
<div class="modal fade" id='modal-deleprov'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR AL PROVEEDOR?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_prov"
                    id="del_prov">
                <input disabled="" class="form-control inputalta" type="text" name="deprov" id="deprov">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedeprov()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrprov" name="delerrprov" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-editavo'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedivo" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editvo()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvo" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthvo()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vo"
                        id="id_vo">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithdesvo" id="edithdesvo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="editcavo" id="editcavo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:<span
                                        class="tx-danger">*</span></label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="3" class="form-control"
                                    name="ediobservo" id="ediobservo"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savearvo()" id="voguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdvobli" name="edthdvobli" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovacios" name="edthvovacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerr" name="edthvoerr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<div class="modal fade" id='modal-editavo1'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">AGREGAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vo1"
                        id="id_vo1">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <div id="busccodigo"></div>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="vdescrip1"
                                    id="vdescrip1" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vcantidad1" id="vcantidad1"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vdepart1" id="vdepart1"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3" id="precio" style="display:none;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">$ PRECIO: <span class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" onchange="agtotalvo()" min="0" value="0" step="0.1"
                                    class="form-control" type="text" id="vprecio1" name="vprecio1"
                                    placeholder="Ingrese el precio">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3" id="total" style="display:none;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">$ TOTAL: <span class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" value="0" type="number" min="0"
                                    max="4" id="vtotal1" name="vtotal1" readonly placeholder="Total">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="observo1"
                                    id="observo1" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div style="display:none;" id="edthdvobli1" name="edthdvobli1" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovacios1" name="edthvovacios1" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerr1" name="edthvoerr1" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button type="button" onclick="addartivo()" id=""
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-editavoinf'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedivoinf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editvoinf1()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvoinf" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthvoinf1()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_voin"
                        id="id_voin">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number" name="edicovoinf" id="edicovoinf"> -->
                                <div id="edicovinf"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithdesvoinf" id="edithdesvoinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()"
                                    class="form-control inputalta" type="number" name="editcavoinf" id="editcavoinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdepinf1" id="editdepinf1">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="precioinf" style="display:none;">
                            <div class="form-group">
                                <label class="form-control-label label2">$ PRECIO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()" min="0" value="0"
                                    step="0.1" class="form-control inputalta" type="text" id="vprecioinf"
                                    name="vprecioinf" placeholder="Ingrese el precio">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3" id="totalinf" style="display:none;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label label2">$ TOTAL: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" value="0" type="number"
                                    min="0" max="4" id="vtotalinf" name="vtotalinf" readonly placeholder="Total">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="infobsere" id="infobsere" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savecamvo()" id="voguardarinf" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdvoblinf" name="edthdvoblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovaciosin" name="edthvovaciosin" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerrinf" name="edthvoerrinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS DE VALE DE OFICINA-->
<div class="modal fade" id='modal-deleteartvo'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE VALE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artvo"
                    id="del_artvo">
                <input disabled="" class="form-control inputalta" type="text" name="deartvo" id="deartvo">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedelarvo()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarvoinf" name="delerarvoinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR VALE DE OFICINA-->
<div class="modal fade" id='modal-deletevol'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR AL VALE DE OFICINA?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_vof"
                    id="del_vof">
                <input disabled="" class="form-control inputalta" type="text" name="devaofi" id="devaofi">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedevol()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrvo" name="delerrvo" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR ARTICULOS DE LISTA DE PEDIDOS-->
<div class="modal fade" id='modal-editpeinf'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DE PEDIDO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedipeinf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="opeinpedf()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditpeinf" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeinpedf()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_arpedid" id="id_arpedid">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <div id="edipeinfinf"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithdeped" id="edithdeped">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()"
                                    class="form-control inputalta" type="number" name="editcapeinf" id="editcapeinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdepinpe" id="editdepinpe">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="precioinf" style="display:;">
                            <div class="form-group">
                                <label class="form-control-label label2">$ PRECIO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()" min="0" value="0"
                                    step="0.1" class="form-control inputalta" type="text" id="pprecioinf"
                                    name="pprecioinf" placeholder="Ingrese el precio">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3" id="totalinf" style="display:;">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label label2">$ TOTAL: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" value="0" type="number"
                                    min="0" max="4" id="vtotalinf" name="vtotalinf" readonly placeholder="Total">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="infobserep" id="infobserep"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savecamvo()" id="voguardarinf" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdvoblinf" name="edthdvoblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovaciosin" name="edthvovaciosin" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerrinf" name="edthvoerrinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA SURTIR ARTICULOS-->
<div class="modal fade" id='modal-surtirvof'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtirvof" name="surtirvof" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="survof()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvoinf4" name="closeditvoinf4"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closesurvof()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtvof" id="id_surtvof">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <div id="edicovinf1sur"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithsertg" id="edithsertg">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD SURTIDA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()"
                                    class="form-control inputalta" type="number" name="surtavoinf" id="surtavoinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="surbsere"
                                    id="surbsere" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar surtir" onclick="acsurtirvof()"
                                id="voguardarsur1" style=""
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                SURTIR</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar sin existencia" onclick="sinexisten()"
                                id="voguardarsur2" style=""
                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">SIN
                                EXISTENCIAS</button>
                        </div>

                    </div><!-- col-4 -->
                </div>
            </form>

            <br>
            <div style="display:none;" id="edthdvoblinf" name="edthdvoblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovaciosin" name="edthvovaciosin" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerrinf" name="edthvoerrinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL DE DETALLES NO SURTIDO-->
<div class="modal fade" id='modal-nosurtido'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_nosur"
                    id="id_nosur">
                <h4 class="tx-danger mg-b-20">No fue surtido por falta de Existencia</h4>
                <label style="font-size:25px" for="">Detalles del Articulo:</label>
                <label id="descar" name="descar" style="font-size:16px" for=""></label>
                <p class="mg-b-20 mg-x-20">
                    <label style="font-size:16px" for="">Cantidad Solicitada:</label>
                    <label style="font-size:16px" id="canreal" name="canreal" for=""></label>
                </p>
                <button type="button" onclick="closemodnosui()"
                    class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20"
                    aria-label="Close">Cerrar</button>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-editavo'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedivo" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editvo()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvo" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthvo()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vo"
                        id="id_vo">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithdesvo" id="edithdesvo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="editcavo" id="editcavo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:<span
                                        class="tx-danger">*</span></label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="3" class="form-control"
                                    name="ediobservo" id="ediobservo"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savearvo()" id="voguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdvobli" name="edthdvobli" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovacios" name="edthvovacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerr" name="edthvoerr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ARTICULOS DE MEMO -->
<div class="modal fade" id='modal-editarmemo'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DEL MEMO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedimemarinf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoinf()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditmemartinf" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmeminf()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_meminf"
                        id="id_meminf">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number" name="edicovoinf" id="edicovoinf"> -->
                                <div id="edimemo"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="edithmeades" id="edithmeades">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="" class="form-control inputalta"
                                    type="number" name="editcameminf" id="editcameminf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdepinfme" id="editdepinfme">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="infobsereme" id="infobsereme"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveinfethmem()" id="memguardarinf" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdmeminf" name="edthdmeminf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthmemaciosin" name="edthmemaciosin" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoeredthmemerrinfrinf" name="edthmemerrinf" class="alert alert-danger"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR ARTICULOS DE ALTA DE MEMO -->
<div class="modal fade" id='modal-editarmemoalta'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DEL ALTA DE MEMO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditras" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoal()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditras" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmemal()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_memtrass" id="id_memtrass">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <!--01052022 <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number" name="edicovoinf" id="edicovoinf"> -->
                                <select disabled="" class="form-control" onchange="destrasmemalt()" id="coditrasal"
                                    name="coditrasal" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($art3 = mysqli_fetch_row($articulo3)):?>
                                    <option value="<?php echo $art3[0]?>"><?php echo $art3[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="mdestrasp"
                                    id="mdestrasp" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="" class="form-control inputalta"
                                    type="number" name="editcamemalt" id="editcamemalt">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdepmemal" id="editdepmemal">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="bseremealt" id="bseremealt"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savealtethmem()" id="memguardaral" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdmminf" name="edthdmminf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthmmciosal" name="edthmmciosal" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthmmerinfr" name="edthmmerinfr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR MEMO-->
<div class="modal fade" id='modal-delmemo'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL MEMO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_mem"
                    id="del_mem">
                <input disabled="" class="form-control inputalta" type="text" name="devamemo" id="devamemo">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedemem()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrvo" name="delerrvo" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR UISUARIOS-->
<div class="modal fade" id='modal-edithtrans'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DE TRANSFORMACIÓN</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editusu" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditrasfo" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editrasnf()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closetras" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closetrans()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_arttras" id="id_arttras">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO ARTICULO FINAL: <span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="edithartfin" name="edithartfin" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($idpst = mysqli_fetch_row($articulo)):?>
                                    <option value="<?php echo $idpst[0]?>"><?php echo $idpst[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO ARTICULO EXTENDIDO: <span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="edithartext" name="edithartext" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($ext = mysqli_fetch_row($extendido)):?>
                                    <option value="<?php echo $ext[0]?>"><?php echo $ext[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO DE ETIQUETAS<span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="editharetq" name="editharetq" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($etqu = mysqli_fetch_row($etiquetas)):?>
                                    <option value="<?php echo $etqu[0]?>"><?php echo $etqu[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">HOJAS<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithojas"
                                    id="edithojas">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DIVISIÓN<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="editdivision"
                                    id="editdivision">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <label class="tx-indigo" style="font-size:20px" for="">ARTICULOS EXTRA</label>
                        </div>
                        <div class="col-lg-3" id="cartonedith" name="cartonedith" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary">Cartón</label>
                                <select disabled="" class="form-control" data-placeholder="Elija si aplioca o no"
                                    onchange="carton()" id="cartonedt" name="cartonedt" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartoned" name="cartoned" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de Carton:</label>
                                <select disabled="" onchange="carton()" class="form-control"
                                    data-placeholder="Seleccione" id="edthcarton" name="edthcarton" type="text"
                                    data-live-search="true">
                                    <option value="0">CODIGO</option>
                                    <?php while($ided = mysqli_fetch_row($articuloedth)):?>
                                    <option value="<?php echo $ided[0]?>"><?php echo $ided[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonedith" name="cartonedith" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">División carton</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="eddivcarton" id="eddivcarton" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonmilteed" name="cartonmilteed" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica carton</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcartonedt" id="multcartonedt" placeholder="Ingresa">
                            </div>
                        </div>
                        <!-- cartonsillo -->
                        <div class="col-lg-3" id="cartonsilloedith" name="cartonsilloedith" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary">Cartonsillo</label>
                                <select disabled="" class="form-control" data-placeholder="Elija si aplioca o no"
                                    onchange="" id="cartonsilledith" name="cartonsilledith" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonsilloed" name="cartonsilloed" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de cartonsillo:</label>
                                <select disabled="" onchange="" class="form-control" data-placeholder="Seleccione"
                                    id="edthcartonsillo" name="edthcartonsillo" type="text" data-live-search="true">
                                    <option value="0">CODIGO</option>
                                    <?php while($ided1 = mysqli_fetch_row($articuloedth1)):?>
                                    <option value="<?php echo $ided1[0]?>"><?php echo $ided1[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="carnsillodvedith" name="carnsillodvedith" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">División cartonsillo</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="eddivcartonsillo" id="eddivcartonsillo" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonsillomilteed" name="cartonsillomilteed" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica cartonsillo</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcartonsilloedt" id="multcartonsilloedt" placeholder="Ingresa">
                            </div>
                        </div>

                        <!-- caple -->
                        <div class="col-lg-3" id="capleedithdv" name="capleedithdv" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary">Caple</label>
                                <select disabled="" class="form-control" data-placeholder="Elija si aplioca o no"
                                    onchange="" id="capleedith" name="capleedith" type="text" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="caplecoeth" name="cartonsilloed" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de caple:</label>
                                <select disabled="" onchange="" class="form-control" data-placeholder="Seleccione"
                                    id="edthcaplecod" name="edthcaplecod" type="text" data-live-search="true">
                                    <option value="0">CODIGO</option>
                                    <?php while($ided2 = mysqli_fetch_row($articuloedth2)):?>
                                    <option value="<?php echo $ided2[0]?>"><?php echo $ided2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="capledvedith" name="capledvedith" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">División caple</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="eddivcaple" id="eddivcaple" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="caplemilteed" name="caplemilteed" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica caple</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcapleedt" id="multcapleedt" placeholder="Ingresa">
                            </div>
                        </div>
                        <!-- liston/cordon -->
                        <div class="col-lg-3" id="listonarexedth" name="listonarexedth" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary">Listón/Cordon</label>
                                <select disabled="" class="form-control" data-placeholder="Elija si aplioca o no"
                                    onchange="liston()" id="listonaplicedt" name="listonaplicedt" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="listonedth" name="listonedth" style="display:">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de listón:</label>
                                <select disabled="" onchange="" class="form-control" data-placeholder="Seleccione"
                                    id="codlistonedt" name="codlistonedt" type="text" data-live-search="true">
                                    <option value="0">CODIGO</option>
                                    <?php while($ided3 = mysqli_fetch_row($articuloedth3)):?>
                                    <option value="<?php echo $ided3[0]?>"><?php echo $ided3[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <!-- col-4 -->
                        <div class="col-lg-3" id="listonmilt" name="listonmilt" style="display:">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica listón</label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multlistonedt" id="multlistonedt" placeholder="Ingresa">
                            </div>
                        </div><!-- col-3 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savetraedit()" id="traeguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdubli" name="edthdubli" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvacios" name="edthvacios" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edtherr" name="edtherr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- modal eliminar articulo de ransformacion -->
<div class="modal fade" id='modal-deltransf'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL MEMO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="detrasfor"
                    id="detrasfor">
                <input disabled="" class="form-control inputalta" type="text" name="artras_dele" id="artras_dele">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdeletransf()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrartras" name="delerrartras" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS DE MEMO VISTA PREVIA-->
<div class="modal fade" id='modal-deleteartif'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE MEMO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artmeminf"
                    id="del_artmeminf">
                <input disabled="" class="form-control inputalta" type="text" name="deartmeinf" id="deartmeinf">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelemeinf()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarmeinf" name="delerarmeinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE MEMOS-->
<div class="modal fade" id='modal-deleteartal' name='modal-deleteartal'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE ALTA DE MEMO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE MEMO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artmemalt"
                    id="del_artmemalt">
                <input disabled="" class="form-control inputalta" type="text" name="deartmeal" id="deartmeal">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelemeal()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarmeal" name="delerarmeal" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE VALE DE OFICINA-->
<div class="modal fade" id='modal-deletevalofi' name='modal-deletevalofi'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE ALTA DE VALE DE OFICINA
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE VALE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artvoalt"
                    id="del_artvoalt">
                <input disabled="" class="form-control inputalta" type="text" name="deartvoal" id="deartvoal">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelevoal()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarvoal" name="delerarvoal" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA AGREGAR ARTICULO EN TRASPASO DE MEMO EN VISTA PREVIA-->
<div class="modal fade" id='modal-addartmeminf'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">AGREGAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vo1"
                        id="id_vo1">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="desartrasmem()" id="coditrasmem"
                                    name="coditrasmem" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($art2 = mysqli_fetch_row($articulo2)):?>
                                    <option value="<?php echo $art2[0]?>"><?php echo $art2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="mdescriptras"
                                    id="mdescriptras" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="mcantidtras" id="mcantidtras"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="mdepartras" id="mdepartras"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="mobsertras"
                                    id="mobsertras" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div style="display:none;" id="edthdmtbli1" name="edthdmtbli1" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvmemacios1" name="edthvmemacios1" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthmeerr1" name="edthmeerr1" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button style="display:none;" type="button" onclick="addartimetras()" id="addtrasfor" name="addtrasfor"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
                <button style="display:none;" type="button" onclick="addartimetrasps()" id="addtrasfor2"
                    name="addtrasfor2"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA AGREGAR ARTICULO INDIVIDUAL EN VALE DE PRODUCCIÓN 15052022-->
<div class="modal fade" id='modal-artinviprod'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">AGREGAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vip"
                        id="id_vip">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivudual()" id="codindiv" name="codindiv"
                                    type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artin = mysqli_fetch_row($articuindv)):?>
                                    <option value="<?php echo $artin[0]?>"><?php echo $artin[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="vindescrip"
                                    id="vindescrip" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vincantid" id="vincantid"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vindepar" id="vindepar"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">POSICIÓN DEL ARTICULO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" data-placeholder="Elegir la posición del articulo" id="psiciont" name="psiciont" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">SELECCIONE LA POSICIÓN DEL ARTICULO</option>
                                    <option value="EXTENDIDO">EXTENDIDO</option>
                                    <option value="ETIQUETAS">ETIQUETAS</option>
                                    <option value="PRODUCTO_TERMINADO">PRODUCTO TERMINADO</option>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="vinfbsertras"
                                    id="vinfbsertras" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div style="display:none;" id="edthvinbli1" name="edthvinbli1" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvaincios1" name="edthvaincios1" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvinperr1" name="edthvinperr1" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button style="display:;" type="button" onclick="addarinpro()" id="addarinpro" name="addarinpro"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA AGREGAR EDITAR ARTICULO-->
<div class="modal fade" id='modal-editaddpro'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editaddpro" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vip"
                        id="id_vip">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivudual()" id="codedvpadd" name="codedvpadd"
                                    type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artin = mysqli_fetch_row($articuindv)):?>
                                    <option value="<?php echo $artin[0]?>"><?php echo $artin[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="edaddesvp"
                                    id="edaddesvp" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpedtcantid" id="vpedtcantid"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpedthdepar" id="vpedthdepar"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">POSICIÓN DEL ARTICULO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" data-placeholder="Elegir la posición del articulo" id="psicivpadd" name="psicivpadd" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">SELECCIONE LA POSICIÓN DEL ARTICULO</option>
                                    <option value="EXTENDIDO">EXTENDIDO</option>
                                    <option value="ETIQUETAS">ETIQUETAS</option>
                                    <option value="PRODUCTO_TERMINADO">PRODUCTO TERMINADO</option>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="vpobsadd"
                                    id="vpobsadd" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div style="display:none;" id="addyavp" name="addyavp" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="addedthllesvp" name="addedthllesvp" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="erraddvpedt" name="erraddvpedt" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button style="display:none;" type="button" onclick="edithaddvp()" id="updatevp" name="updatevp"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">EDITAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<script>
$(function() {
    // showing modal with effect
    $('.modal-effect').on('click', function() {
        var effect = $(this).attr('data-effect');
        $('#modaldemo8').addClass(effect, function() {
            $('#modaldemo8').modal('show');
        });
        return false;
    });
    // hide modal with effect
    $('#modaldemo8').on('hidden.bs.modal', function(e) {
        $(this).removeClass(function(index, className) {
            return (className.match(/(^|\s)effect-\S+/g) || []).join(' ');
        });
    });
});
$(document).ready(function() {
    $('#busccodigo').load('select/buscar2.php');
    $('#edicovinf').load('select/buscar3.php');
    $('#edipeinfinf').load('select/buscar4.php');
    $('#edicovinf1sur').load('select/buscar5.php');
    $('#edimemo').load('select/buscar6.php');
    $('#busccodigo2').load('select/buscar2.php');
    $('#edicovinf2').load('select/buscar3.php');






});
</script>