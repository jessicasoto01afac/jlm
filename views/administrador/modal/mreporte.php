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
<!-- MODAL PARA EDITAR ARTICULOS DE ALTA DE RECLAMO -->
<div class="modal fade" id='modal-editararclalta'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DEL ALTA DE RECLAMO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editvoinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditarclie" style="float: right;font-size: 16px;display:;"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartrecliente()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closediarclie" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditclient()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_artclien" id="id_artclien">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <!--01052022 <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number" name="edicovoinf" id="edicovoinf"> -->
                                <select disabled="" class="form-control" onchange="destrasmemalt()" id="codiclieth"
                                    name="codiclieth" type="text" data-live-search="true" style="width: 100%">
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
                                <input onkeyup="mayus(this);" class="form-control" readonly name="desclientrep"
                                    id="desclientrep" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="" class="form-control inputalta"
                                    type="number" name="editcaclien" id="editcaclien">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdeplien" id="editdeplien">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="obserclien" id="obserclien"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savealtrepclie()" id="guardarreclie" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthclieinf" name="edthclieinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclieciosal" name="edthclieciosal" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclieinfr" name="edthclieinfr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE RECLAMO CLIENTE-->
<div class="modal fade" id='modal-deleteartal' name='modal-deleteartal'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE ALTA DE RECLAMO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE REPORTE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artrecli"
                    id="del_artrecli">
                <!-- <input disabled="" class="form-control inputalta" type="text" name="deartrepcli" id="deartrepcli"> -->
                <textarea disabled="" class="form-control" name="deartrepcli" id="deartrepcli" rows="3"></textarea>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelercliart()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="deartrepclie" name="deartrepclie" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR ARTICULOS DE ALTA DE RECLAMO -->
<div class="modal fade" id='modal-editararclalta2'>
    <div class="modal-dialog modal-lg" role="document" style="/*margin-top: 7em;*/">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO DE REPORTE</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editrep" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openeditarclie2" style="float: right;font-size: 16px;display:;"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartrecliente2()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closediarclie2" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditclient2()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_artclien2" id="id_artclien2">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <!--01052022 <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number" name="edicovoinf" id="edicovoinf"> -->
                                <select disabled="" class="form-control" onchange="destrasmemalt2()" id="codiclieth2"
                                    name="codiclieth2" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($art2 = mysqli_fetch_row($articulo2)):?>
                                    <option value="<?php echo $art2[0]?>"><?php echo $art2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="desclientrep2"
                                    id="desclientrep2" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="" class="form-control inputalta"
                                    type="number" name="editcaclien2" id="editcaclien2">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label label2">DEPARTAMENTO:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta"
                                    name="editdeplien2" id="editdeplien2">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="2" class="form-control"
                                    name="obserclien2" id="obserclien2"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="savealtrepclie2()" id="guardarreclie2" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthclieinf2" name="edthclieinf2" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclieciosal2" name="edthclieciosal2" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthclieinfr2" name="edthclieinfr2" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS DE RECLAMO CLIENTE-->
<div class="modal fade" id='modal-deleteartal2' name='modal-deleteartal2'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE ALTA DE RECLAMO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE REPORTE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artrecli2"
                    id="del_artrecli2">
                <!-- <input disabled="" class="form-control inputalta" type="text" name="deartrepcli" id="deartrepcli"> -->
                <textarea disabled="" class="form-control" name="deartrepcli2" id="deartrepcli2" rows="3"></textarea>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelercliart2()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="deartrepclie2" name="deartrepclie2" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA AGREGAR ARTICULO INDIVIDUAL EN REPORTE  DETALLES-->
<div class="modal fade" id='modal-addartrpinfo'>
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
            <div style="display:none;" id="addrepinfrep" name="addrepinfrep" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="addrepinflle" name="addrepinflle" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="addrepoinerr" name="addrepoinerr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div class="modal-footer">
                <button style="display:;" type="button" onclick="editaddreport()" id="addarinpro2" name="addarinpro2"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR REPORTE DE CLIENTE-->
<div class="modal fade" id='modal-delreprclient'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL REPORTE DE CLIENTE?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                    name="del_reportclien" id="del_reportclien">
                <input disabled="" style="text-align:center" class="form-control inputalta" type="text"
                    name="delrepclient" id="delrepclient">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedelrec()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerpclierr" name="delerpclierr" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA HISTORIAL-->
<div class="modal fade" id='modal-rphistorial'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">VISTA DE HISTORIAL</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <div class="col-12">
                    <div class="card bd-0 pd-30">
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Historial</h6>
                        <p id="" name="" class="mg-b-0"><span
                                class="square-8 rounded-circle bg-primary mg-r-10"></span>Fecha de creación:<label
                                id="fcreacion" name="fcreacion" for=""></label></p>
                        <p id="" name="" class="mg-b-0"><span
                                class="square-8 rounded-circle bg-teal mg-r-10"></span>Fecha
                            de autorización:<label id="fautoriz" name="fautoriz" for=""></label></p>
                        <p id="" name="" class="mg-b-0"><span
                                class="square-8 rounded-circle bg-purple mg-r-10"></span>Fecha
                            de surtido:<label id="fsurtido" name="fsurtido" for=""></label></p>
                        <p id="" name="" class="mg-b-0"><span
                                class="square-8 rounded-circle bg-teal mg-r-10"></span>Fecha
                            de Finalización:<label id="ffinaliz" name="ffinaliz" for=""></label></p>
                        <div class="col-12" align="right">
                            <span class="square-10 bg-primary mg-r-5"></span><span id="dias1" name="dias1"></span>
                            <span class="square-10 bg-purple mg-r-5"></span><span id="dias2" name="dias2"></span>
                            <span class="square-10 bg-teal mg-r-5"></span><span id="dias3" name="dias3"></span>
                        </div>
                        <div class="mg-t-20 tx-13">
                            <a href="" class="tx-gray-600 hover-info">Generar Reporte</a>
                            <a href="" class="tx-gray-600 hover-info bd-l mg-l-10 pd-l-10">Imprimir Reporte</a>
                        </div>
                    </div><!-- card -->
                </div>

                <h4 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Registros de movimientos</a></h4>
                <div class="col-lg-12">
                    <div class="form-group">
                        <div id="tabhisto" name="tabhisto"></div>
                    </div>
                </div>
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