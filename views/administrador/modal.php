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

      $sqlpri = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artidettvp = mysqli_query($conexion,$sqlpri);

      $sqlarp = "SELECT codigo_pro,nom_pro,id_prov FROM proveedores WHERE estado = 0";
      $artproe = mysqli_query($conexion,$sqlarp);

      $sqlarex = "SELECT artcodigo,id_art,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artprvv = mysqli_query($conexion,$sqlarex);

      $sqlarex2 = "SELECT artcodigo,id_art,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artprvv2 = mysqli_query($conexion,$sqlarex2);

      
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
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">STOCK INICIAL<span class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edistockini" id="edistockini">
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
    <div class="modal-dialog modal-lg" role="document">
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
                                <label class="form-control-label label2">CORREO ELECTRONICO</label>
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
                                    <option value="AGENTE">AGENTE</option>
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
    <div class="modal-dialog modal-lg" role="document">
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
                                <label class="form-control-label label2">CORREO:</label>
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
    <div class="modal-dialog modal-lg" role="document">
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
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
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
    <div class="modal-dialog modal-lg" role="document">
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
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo"> -->
                                <select class="form-control" onchange="edithextdettvp()" id="edicovo" name="edicovo"
                                    type="text" disabled data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttrasdett = mysqli_fetch_row($artiedidettvp)):?>
                                    <option value="<?php echo $arttrasdett[0]?>"><?php echo $arttrasdett[0]?></option>
                                    <?php endwhile; ?>
                                </select>
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
    <div class="modal-dialog modal-lg" role="document">
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
    <div class="modal-dialog modal-lg" role="document">
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
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-lg-3" id="precioinf">
                            <div class="form-group">
                                <label class="form-control-label label2">$ PRECIO: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()" min="0" value="0"
                                    step="0.1" class="form-control inputalta" type="text" id="pprecioinf"
                                    name="pprecioinf" placeholder="Ingrese el precio">
                            </div>
                        </div><!-- col-6 -->
                        <div class="col-lg-3" id="totalinf">
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
    <div class="modal-dialog modal-lg" role="document">
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
                                id="voguardarsur1"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                SURTIR</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar sin existencia" onclick="sinexisten()"
                                id="voguardarsur2"
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
    <div class="modal-dialog modal-lg" role="document">
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DEL MEMO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <!-- editar salidas -->
                    <a href="#" id="openedimemarinf" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoinf()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditmemartinf" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmeminf()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <!-- editar entradas -->
                    <a href="#" id="openedimemarinf_v2" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoinf_v2()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditmemartinf_v2" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmeminf_v2()"
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
                <button type="button" onclick="saveinfethmem2()" id="memguardarinf_v2" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS2</button>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DEL ALTA DE MEMO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditras" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoal()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditras" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmemal()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>

                    <a href="#" id="openeditrasv2" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartmemoalv2()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditrasv2" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditmemalv2()"
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
                <button type="button" onclick="savealtethmemv2()" id="memguardaralv2" style="display:none;"
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-x-20">
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
                        <div class="col-lg-12">
                            <label class="tx-indigo" style="font-size:20px" for="">ARTICULOS PARA LA
                                TRANSFORMACIÓN</label>
                        </div>
                        <br>
                        <div class="col-lg-12" id="masplus" name="masplus" style="display:none">
                            <button type="button" onclick="addplusedit()"
                                class="btn btn-outline-purple btn-block mg-b-10"><i
                                    class="fa fa-plus mg-r-10"></i>AGREGAR ARTICULOS</button>
                        </div><!-- col-3 -->
                        <div id="masplus2" name="masplus2" class="col-lg-4" id="masplusext" name="masplusext"
                            style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo articulo: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" id="edithpusadd" name="edithpusadd" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($ext2 = mysqli_fetch_row($extendidomas)):?>
                                    <option value="<?php echo $ext2[0]?>"><?php echo $ext2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4" id="mastype" name="mastype" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">clase: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control select" name="type_artedth" id="type_artedth">
                                    <option value="">Seleccionar</option>
                                    <option value="EXTENDIDO">EXTENDIDO</option>
                                    <option value="ETIQUETAS">ETIQUETAS</option>
                                    <option value="CARTON">CARTON</option>
                                    <option value="CARTONSILLO">CARTONSILLO</option>
                                    <option value="CAPLE">CAPLE</option>
                                    <option value="LISTON_CORDÓN">LISTON/CORDÓN</option>
                                    <option value="MINAGRIS">MINAGRIS</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div id="masplus3" name="masplus3" class="col-lg-2" id="multimascolor" style="display:none">
                            <div class="form-group">
                                <label class=" form-control-label label2">Multiplica</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="mltimascolor" id="mltimascolor" placeholder="Ingresa">
                            </div>
                        </div>
                        <div id="masplus4" name="masplus4" class="col-lg-2" id="divimascolor" style="display:none">
                            <div class="form-group">
                                <label class=" form-control-label label2">División</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="divmasclo" id="divmasclo" placeholder="Ingresa">
                            </div>
                        </div>
                        <div id="masplusave" name="masplusave" class="col-lg-3" id="divimascolor" style="display:none">
                            <!-- <button type="button" onclick="saveaddedith()"
                                class="btn btn-oblong btn-success btn-block mg-b-10">GUARDAR</button> -->
                            <a onclick="saveaddedith()" title="Guardar Articulo" style="color:white"
                                class="btn btn-primary btn-icon mg-r-5 mg-b-10">
                                <div><i class="fa fa-floppy-o"></i></div>
                            </a>
                            <a onclick="canceladd()" title="Cerrar agregar articulo" style="color:white"
                                class="btn btn-purple btn-icon mg-r-5 mg-b-10">
                                <div><i class="fa fa-times"></i></div>
                            </a>
                        </div>
                        <div class="col-lg-12">
                            <div id="extraxcolortable" name="extraxcolortable"></div>
                        </div>

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
    <div class="modal-dialog modal-lg" role="document">
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
    <div class="modal-dialog modal-lg" role="document">
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
    <div class="modal-dialog modal-lg" role="document">
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
                                <select class="form-control" data-placeholder="Elegir la posición del articulo"
                                    id="psiciont" name="psiciont" type="text" data-live-search="true"
                                    style="width: 100%">
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
                <button type="button" onclick="addarinpro()" id="addarinpro" name="addarinpro"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN 04062022-->
<div class="modal fade" id='modal-edithvpextendido'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edithvpextendido" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedithext" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editarextalta()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closedithext" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditextalta()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_exedith" id="id_exedith">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextnewvp()" id="cdnewvpedith"
                                    name="cdnewvpedith" type="text" disabled data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttras = mysqli_fetch_row($artieditrnas)):?>
                                    <option value="<?php echo $arttras[0]?>"><?php echo $arttras[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="vpnewedithdes"
                                    id="vpnewedithdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpednewtcantid"
                                    id="vpednewtcantid" placeholder="Ingrese la cantidad" disabled type="number"
                                    required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpedthdeparnew"
                                    id="vpedthdeparnew" placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">POSICIÓN DEL ARTICULO:
                                    <span class="tx-danger">*</span></label>
                                <select class="form-control" data-placeholder="Elegir la posición del articulo"
                                    id="posicionextnew" name="posicionextnew" type="text" disabled
                                    data-live-search="true" style="width: 100%">
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
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="vpobsaddnew"
                                    id="vpobsaddnew" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveedithnewvp()" id="saveedithext" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithextnewlle" name="edithextnewlle" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="erraetiqnew" name="erraetiqnew" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE VALE DE PRODUCCION-->
<div class="modal fade" id='modal-delearvpnew' name='modal-delearvpnew'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE ALTA DE PRODUCCCIÓN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE VALE DE PRODUCCIÓN?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artvpnew"
                    id="del_artvpnew">
                <input disabled="" class="form-control inputalta" type="text" name="deartvpnew" id="deartvpnew">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelevpart()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarvpnew" name="delerarvpnew" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR VALE DE PRODUCCIÓN-->
<div class="modal fade" id='modal-deletevproduc'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL VALE DE PRODUCCIÓN?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_vproduct"
                    id="del_vproduct">
                <input disabled="" class="form-control inputalta" type="text" name="devaproduc" id="devaproduc">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedeprodu()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrvprv" name="delerrvprv" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN VISTA PREVIA DE VALE DE PRODUCCIÓN-->
<div class="modal fade" id='modal-edithdetvp'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edithvpextendido" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a id="openedithextdetalle" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editarvpdett()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a id="closedithextdetalle" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedithvpdett()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_exedithdett" id="id_exedithdett">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextdettvp()" id="cdedttvpedith"
                                    name="cdedttvpedith" type="text" disabled data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttrasdettped = mysqli_fetch_row($artidettvp)):?>
                                    <option value="<?php echo $arttrasdettped[0]?>"><?php echo $arttrasdettped[0]?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="vpdettedithdes"
                                    id="vpdettedithdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpeddettcantid"
                                    id="vpeddettcantid" placeholder="Ingrese la cantidad" disabled type="number"
                                    required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vpedthdepardell"
                                    id="vpedthdepardell" placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">POSICIÓN DEL ARTICULO:
                                    <span class="tx-danger">*</span></label>
                                <select class="form-control" data-placeholder="Elegir la posición del articulo"
                                    id="posicionextdell" name="posicionextdell" type="text" disabled
                                    data-live-search="true" style="width: 100%">
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
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="vpobsadddetll"
                                    id="vpobsadddetll" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveedithdettvp()" id="saveedithextdett" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithextdettlle" name="edithextdettlle" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="erraetiqdett" name="erraetiqdett" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE DETALLES DE VALE DE PRODUCCION-->
<div class="modal fade" id='modal-delearvpdett' name='modal-delearvpdett'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE VALE DE PRODUCCIÓN?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                    name="del_artvpdetts" id="del_artvpdetts">
                <input disabled="" style="text-align:center" class="form-control inputalta" type="text"
                    name="deartvpdett" id="deartvpdett">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelevpartdet()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarvpdett" name="delerarvpdett" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA AGREGAR ARTICULO INDIVIDUAL EN VALE DE PRODUCCIÓN DETALLES-->
<div class="modal fade" id='modal-addartvpinfo'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">AGREGAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editcli" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_vipinf"
                        id="id_vipinf">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivudualinf()" id="codindivinf"
                                    name="codindivinf" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artin2 = mysqli_fetch_row($articuindv2)):?>
                                    <option value="<?php echo $artin2[0]?>"><?php echo $artin2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="vindescripinf"
                                    id="vindescripinf" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vincantidinf" id="vincantidinf"
                                    placeholder="Ingrese la cantidad" type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="vindeparinnf" id="vindeparinnf"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">POSICIÓN DEL ARTICULO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" data-placeholder="Elegir la posición del articulo"
                                    id="psiciontinf" name="psiciontinf" type="text" data-live-search="true"
                                    style="width: 100%">
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
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="vpinfbsertrass"
                                    id="vpinfbsertrass" placeholder="Ingresa alguna observación"></textarea>
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
                <button type="button" onclick="addarinproinfo()" id="addarinpro2" name="addarinpro2"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA SURTIR ARTICULOS VALE DE PRODUCCIÓN-->
<div class="modal fade" id='modal-surtirvprod'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR ARTICULO DE VALE</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvpinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtirvprf" name="surtirvprf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithsurvpif()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvprinf" name="closeditvprinf"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedisurvpif()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtvpif" id="id_surtvpif">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivsurtinf()" id="codisurtvp" name="codisurtvp"
                                    type="text" disabled="" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artsuvp = mysqli_fetch_row($articusurvp)):?>
                                    <option value="<?php echo $artsuvp[0]?>"><?php echo $artsuvp[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="descripsurvp" id="descripsurvp">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD SURTIDA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()"
                                    class="form-control inputalta" type="number" name="surtavprinf" id="surtavprinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES ANEXAS:</label>
                                <textarea disabled="" onkeyup="mayus(this);" rows="2" class="form-control"
                                    name="surbserevp" id="surbserevp"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">AGREGAR OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="surbserevpdep"
                                    id="surbserevpdep" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar surtir" onclick="acsurtirvpf()"
                                id="vprguardarsur"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                SURTIR</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar sin existencia" onclick="sinexisten()"
                                id="vprguardarsur"
                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">SIN
                                EXISTENCIAS</button>
                        </div>

                    </div><!-- col-4 -->
                </div>
            </form>

            <br>
            <div style="display:none;" id="edthdvpblinf" name="edthdvpblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvpvaciosin" name="edthvpvaciosin" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvperrinf" name="edthvperrinf" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- !-- MODAL DE DETALLES SURTIDO-->
<div class="modal fade" id='modal-surtido'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <input style="display:none" class="form-control" type="text" name="idsurt" id="idsurt">
                <button type="button" class="close" data-dismiss="modal" onclick="closedithsurt()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success mg-b-20">Surtido!</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsurt" name="descsurt"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1" name="opesurt1" class="tx-20"
                        href="javascript:openedithsurt()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1" name="clossurt1" class="tx-20"
                        href="javascript:closedithsurt()">CERRAR</a>
                    <div id="infsur" name="infsur">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b><label class="tx-16" id="cartsur"
                                name="cartsur"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsur"
                            name="opstsur"></label></p>
                    </div>
                    <div style="display:none" id="editarsur" name="editarsur">
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Cantidad:</label>
                            <input class="form-control" type="number" name="cnsurt" id="cnsurt" placeholder="Cantidad:">
                        </div><!-- form-group -->
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Observaciones:</label>
                            <textarea onkeyup="mayus(this);" id="obdepinf" class="form-control" name="obdepinf"
                                rows="2"></textarea>
                        </div>
                        <button type="button" onclick="savesurtvp()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->
<!-- MODAL PARA SURTIR ARTICULOS VALE DE PRODUCCIÓN PRODUCTO TERMINAL-->
<div class="modal fade" id='modal-surtprterm'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR ARTICULO DE VALE</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvpinfpf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtirvpfin" name="surtirvpfin" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithsurvpfin()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditvpfin" name="closeditvpfin"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closesurvpfn()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtvpfin" id="id_surtvpfin">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivsurtfin()" id="codisurvpfin"
                                    name="codisurvpfin" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artsuvpfn = mysqli_fetch_row($artisuvpfn)):?>
                                    <option value="<?php echo $artsuvpfn[0]?>"><?php echo $artsuvpfn[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="dessurvpfn" id="dessurvpfn">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD SURTIDA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="" class="form-control inputalta"
                                    type="number" name="surtvpfn" id="surtvpfn">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES ANEXAS:</label>
                                <textarea disabled="" onkeyup="mayus(this);" rows="2" class="form-control"
                                    name="surbservpfn" id="surbservpfn"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">AGREGAR OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="surbservpfn"
                                    id="surbservpfn" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar surtir" onclick="acsurtirvpfin()"
                                id="vprguardarsur"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                SURTIR</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar sin existencia" onclick="sinexistenfin()"
                                id="vprguarsurfn"
                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">SIN
                                EXISTENCIAS</button>
                        </div>

                    </div><!-- col-4 -->
                </div>
                <br>
                <div style="display:none;" id="edthdvpblifn" name="edthdvpblifn" class="alert alert-warning"
                    role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="edthvpvacifn" name="edthvpvacifn" class="alert alert-info" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="edthvperrfn" name="edthvperrfn" class="alert alert-danger" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-close alert-icon tx-24"></i>
                        <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                            ticket</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- !-- MODAL DE DETALLES SURTIDO PRODUCTO FINAL-->
<div class="modal fade" id='modal-surtidofin'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <input style="display:none" class="form-control" type="text" name="idsurtfin" id="idsurtfin">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success mg-b-20">Surtido!</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsurtfin" name="descsurtfin"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1fn" name="opesurt1fn" class="tx-20"
                        href="javascript:openedithsurtfin()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1fn" name="clossurt1fn" class="tx-20"
                        href="javascript:closedithsurtfin()">CERRAR</a>
                    <div id="infsurfn" name="infsurfn">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b><label class="tx-16" id="cartsurfn"
                                name="cartsurfn"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsurfn"
                            name="opstsurfn"></label></p>
                    </div>
                    <div style="display:none" id="editarsurfn" name="editarsurfn">
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Cantidad:</label>
                            <input class="form-control" type="number" name="cnsurtfin" id="cnsurtfin"
                                placeholder="Cantidad:">
                        </div><!-- form-group -->
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Observaciones:</label>
                            <textarea onkeyup="mayus(this);" id="obdepinfin" class="form-control" name="obdepinfin"
                                rows="2"></textarea>
                        </div>
                        <button type="button" onclick="savesurtvpfin()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->

<!-- !-- MODAL DE DETALLES SIN EXISTENCIA-->
<div class="modal fade" id='modal-sinexivp'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <input style="display:none" class="form-control" type="text" name="idsinexvp" id="idsinexvp">
                <button type="button" class="close" onclick="closedithsnex()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">No fue surtido por falta de Existencia</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsinvp" name="descsinvp"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1sn" name="opesurt1sn" class="tx-20"
                        href="javascript:openedithsnex()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1sn" name="clossurt1sn" class="tx-20"
                        href="javascript:closedithsnex()">CERRAR</a>
                    <div id="infsursn" name="infsursn">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b><label class="tx-16" id="cartsinvp"
                                name="cartsinvp"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsinvp"
                            name="opstsinvp"></label></p>
                    </div>
                    <div style="display:none" id="editarsinvp" name="editarsinvp">
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Cantidad:</label>
                            <input class="form-control" type="number" name="cnsinvp" id="cnsinvp"
                                placeholder="Cantidad:">
                        </div><!-- form-group -->
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Observaciones:</label>
                            <textarea onkeyup="mayus(this);" id="obdepsinvp" class="form-control" name="obdepsinvp"
                                rows="2"></textarea>
                        </div>
                        <button type="button" onclick="savesinextvp()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->
<!-- !-- MODAL DE DETALLES SIN EXISTENCIA-->
<div class="modal fade" id='modal-sinexifinvp'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <input style="display:none" class="form-control" type="text" name="idsinexvpfin" id="idsinexvpfin">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">No fue surtido por falta de Existenciass</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsinvpfn" name="descsinvpfn"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1snfn" name="opesurt1snfn" class="tx-20"
                        href="javascript:opedithsexvpfn()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1snfn" name="clossurt1snfn" class="tx-20"
                        href="javascript:closedithsnexfn()">CERRAR</a>
                    <div id="infsursnfn" name="infsursnfn">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b><label class="tx-16" id="cartsinvpfn"
                                name="cartsinvpfn"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsinvpfn"
                            name="opstsinvpfn"></label></p>
                    </div>
                    <div style="display:none" id="editarsinvpfn" name="editarsinvpfn">
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Cantidad:</label>
                            <input class="form-control" type="number" name="cnsinvpfn" id="cnsinvpfn"
                                placeholder="Cantidad:">
                        </div><!-- form-group -->
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Observaciones:</label>
                            <textarea onkeyup="mayus(this);" id="obdepsinvpfn" class="form-control" name="obdepsinvpfn"
                                rows="2"></textarea>
                        </div>
                        <button type="button" onclick="savesinextvpfn()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->
<!-- MODAL PARA HISTORIAL-->
<div class="modal fade" id='modal-vphistorial'>
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
                    <p id="" name="" class="mg-b-0"><span
                            class="square-8 rounded-circle bg-primary mg-r-10"></span>Fecha de creación:<label
                            id="fcreacion" name="fcreacion" for=""></label></p>
                    <p id="" name="" class="mg-b-0"><span class="square-8 rounded-circle bg-teal mg-r-10"></span>Fecha
                        de autorización:<label id="fautoriz" name="fautoriz" for=""></label></p>
                    <p id="" name="" class="mg-b-0"><span class="square-8 rounded-circle bg-purple mg-r-10"></span>Fecha
                        de surtido:<label id="fsurtido" name="fsurtido" for=""></label></p>
                    <p id="" name="" class="mg-b-0"><span class="square-8 rounded-circle bg-teal mg-r-10"></span>Fecha
                        de Finalización:<label id="ffinaliz" name="ffinaliz" for=""></label></p>
                    <div class="col-12" align="right">
                        <span class="square-10 bg-primary mg-r-5"></span><span id="dias1" name="dias1">1</span>
                        <span class="square-10 bg-purple mg-r-5"></span><span id="dias2" name="dias2">2</span>
                        <span class="square-10 bg-teal mg-r-5"></span><span id="dias3" name="dias3">3</span>
                    </div>
                    <div class="mg-t-20 tx-13">
                        <a href="javascript:pdfhistory()" class="tx-gray-600 hover-info">Generar Reporte</a>
                        <!-- <a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Imprimir Reporte</a> -->
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
<!-- modal eliminar articulo de ransformacion -->
<div class="modal fade" id='modal-deleditarcls'>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO?</p>
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
<!-- MODAL PARA VALIDAR FECHA-->
<div class="modal fade" id='modal-fechistorial'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">VER ARTICULOsss</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="col-12">
                <!-- filtro de fechas -->
                <div stclass="col-sm-4 col-lg-12">
                    <div class="d-flex align-items-center justify-content-end bg-gray-100 ht-md-80 bd pd-x-20 mg-t-10">
                        <div class="d-md-flex pd-y-20">
                            <label for="">Selecciona el periodo</label>

                            <input class="form-control" disabled="" type="date" id="vpfechaini" name="vpfechaini"
                                value="2022-01-01" placeholder="">
                            <input class="form-control" disabled="" type="date" id="vpfechafin" name="vpfechafin"
                                value="2022-12-31" placeholder="">

                        </div>
                    </div><!-- d-flex -->
                </div>

            </div>
        </div>
    </div><!-- modal -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR UISUARIOS-->
<div class="modal fade" id='modal-edithartprovee'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-x-20">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DE PROVEEDOR</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editartprove" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openarprov" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithartprov()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closearprov" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeartprov()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_artprov" id="id_artprov">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">PROVEEDOR<span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="editprovee1" name="editprovee1" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($idarp = mysqli_fetch_row($artproe)):?>
                                    <option value="<?php echo $idarp[0]?>"><?php echo $idarp[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO ARTICULO JLM: <span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="edithcidprv" name="edithcidprv" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($extrt = mysqli_fetch_row($artprvv)):?>
                                    <option value="<?php echo $extrt[0]?>"><?php echo $extrt[1]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN<span
                                        class="tx-danger">*</span></label>
                                <select disabled="" class="form-control" id="edithdesprvv" name="edithdesprvv"
                                    type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artss1 = mysqli_fetch_row($artprvv2)):?>
                                    <option value="<?php echo $artss1[0]?>"><?php echo $artss1[2]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO DEL PROVEEDOR: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="codprvar"
                                    id="codprvar">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN PROVEEDOR<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="desprvar"
                                    id="desprvar">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">LARGO<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="edithlargo"
                                    id="edithlargo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">ANCHO<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="edithancho"
                                    id="edithancho">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">GRAMAJE<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="edithgram"
                                    id="edithgram">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">PESO X MILLAR (KGS):<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithpeso_mill"
                                    id="edithpeso_mill">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">PESO X HOJA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithpeso_hoja"
                                    id="edithpeso_hoja">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">PRESENTACIÓN:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="edithpresent"
                                    id="edithpresent">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">PESO KGS PQT CERRADO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithpescerr"
                                    id="edithpescerr">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">UNIDAD:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="text" name="edithunidad"
                                    id="edithunidad">
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <label class="tx-indigo" style="font-size:20px" for="">COSTO</label>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">PRECIO ANTERIOR:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithprecio"
                                    id="edithprecio">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">PRECIOS ACTUAL:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithprecioac"
                                    id="edithprecioac">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 1:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec1"
                                    id="edithsec1">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 2:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec2"
                                    id="edithsec2">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 3:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec3"
                                    id="edithsec3">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 4:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec4"
                                    id="edithsec4">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 5:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec5"
                                    id="edithsec5">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-control-label label2">DESC 6:<span class="tx-danger">*</span></label>
                                <input disabled="" class="form-control inputalta" type="number" name="edithsec6"
                                    id="edithsec6">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACION:<span
                                        class="tx-danger">*</span></label>
                                <textarea disabled="" class="form-control inputalta" name="edithobs1" id="edithobs1"
                                    cols="5" rows="5"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACION 2:<span
                                        class="tx-danger">*</span></label>
                                <textarea disabled="" class="form-control inputalta" name="edithobs2" id="edithobs2"
                                    cols="5" rows="5"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>

            </form>
            <div class="modal-footer">
                <button type="button" onclick="savethiarprvv()" id="edthprvart" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdubliarprv" name="edthdubliarprv" class="alert alert-warning"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvaciosarprvv" name="edthvaciosarprvv" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edtherrartprvv" name="edtherrartprvv" class="alert alert-danger"
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

<!-- MODAL PARA ELIMINAR ARTICULOS-->
<div class="modal fade" id='modal-deleteartprv'>
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
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artpvv"
                    id="del_artpvv">
                <input disabled="" class="form-control inputalta" type="text" name="deart" id="deart">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedeartprv()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarpv" name="delerarpv" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
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