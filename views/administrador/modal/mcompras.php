<?php include ("../controller/conexion.php");
      $sql10 = "SELECT codigo_proveedor,descrip_proveedor FROM artproveedor WHERE estado = 0";
      $artieditrnas = mysqli_query($conexion,$sql10);

      $sql11 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artiedidettvp = mysqli_query($conexion,$sql11);
      
      $sql9 = "SELECT codigo_proveedor,descrip_proveedor FROM artproveedor WHERE estado = 0";
      $artprvadd= mysqli_query($conexion,$sql9);

      $sql8 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artijlm = mysqli_query($conexion,$sql8);

      $sql12 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artisurtidos= mysqli_query($conexion,$sql12);

      $sql3 = "SELECT codigo_proveedor,descrip_proveedor FROM artproveedor WHERE estado = 0";
      $artprsurti= mysqli_query($conexion,$sql3);
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
<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN 04062022-->
<div class="modal fade" id='modal-edithcompas'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">EDITAR ARTICULO</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edithvpextendido1" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="openedithcomp" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editartcompr()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closedithcomp" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeditartcompr()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_cmedith1" id="id_cmedith1">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextnewmd2()" id="cmpnewvpedi"
                                    name="cmpnewvpedi" type="text" disabled data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttras1 = mysqli_fetch_row($artiedidettvp)):?>
                                    <option value="<?php echo $arttras1[0]?>"><?php echo $arttras1[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="cmedithdes"
                                    id="cmedithdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <h6>PROVEEDOR</h6>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextnewmd2()" id="cmprovcod" name="cmprovcod"
                                    type="text" disabled data-live-search="true" style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttras2 = mysqli_fetch_row($artieditrnas)):?>
                                    <option value="<?php echo $arttras2[0]?>"><?php echo $arttras2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="cmedithprvdes"
                                    id="cmedithprvdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="cmedithcant" id="cmedithcant"
                                    placeholder="Ingrese la cantidad" disabled type="number" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="cmedithdept" id="cmedithdept"
                                    placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="cmedithobsv"
                                    id="cmedithobsv" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveedithshop()" id="saveedithshop" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithextnewlle1" name="edithextnewlle1" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="erraetiqnew1" name="erraetiqnew1" class="alert alert-danger" role="alert">
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
<div class="modal fade" id='modal-delearcmnew' name='modal-delearcmnew'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTA ORDEN DE COMPRAS?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artcmnew"
                    id="del_artcmnew">
                <input disabled="" class="form-control inputalta" type="text" name="deartcmnew" id="deartcmnew">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savadeleartcm()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarcmnew" name="delerarcmnew" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-addartcmp'>
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
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO JLM: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo"> -->
                                <div id="buscarticulosjlm"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="mdecriptr" id="mdecriptr">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO PROVEEDOR: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo"> -->
                                <div id="buscarticulosprvm"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="mdecripprvvd" id="mdecripprvvd">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="editcacm" id="editcacm">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:<span
                                        class="tx-danger">*</span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="ediobsercm"
                                    id="ediobsercm" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="addartcomprdetll()" id="voguardar"
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

<!-- MODAL PARA EDITAR CLIENTES-->
<div class="modal fade" id='modal-edith'>
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
                    <a href="#" id="openedicmpp" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editcomp()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditcmpp" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedthcomp()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_artincm" id="id_artincm">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO JLM: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo"> -->
                                <div id="buscarticulosjlm3"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="mdecriptr3" id="mdecriptr3">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO PROVEEDOR: <span
                                        class="tx-danger">*</span></label>
                                <!-- <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="edicovo" id="edicovo"> -->
                                <div id="buscarticulosprvm3"></div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="mdecripprvvd3" id="mdecripprvvd3">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="editcacmp" id="editcacmp">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES:<span
                                        class="tx-danger">*</span></label>
                                <textarea onkeyup="mayus(this);" disabled="" rows="3" class="form-control"
                                    name="ediobsercmp" id="ediobsercmp"
                                    placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveetharcmp()" id="cmppguardar" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edthdvoblicm" name="edthdvoblicm" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvovacioscm" name="edthvovacioscm" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthvoerrcm" name="edthvoerrcm" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA ELIMINAR ARTICULOS DE DETALES COMPRAS -->
<div class="modal fade" id='modal-delearcmdet' name='modal-delearcmdet'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTA ORDEN DE COMPRAS?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_artcmdtt"
                    id="del_artcmdtt">
                <input disabled="" class="form-control inputalta" type="text" name="deartcmdett" id="deartcmdett">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savadeleartcm()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>
            </div>
            <div style="display:none;" id="delerarcmdtt" name="delerarcmdtt" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo eliminar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- MODAL PARA GENERAR ENTRADA ARTICULOS DE COMPRAS -->
<div class="modal fade" id='modal-entrada'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR ARTICULO DE COMPRAS</h6>
                <button type="button" onclick="closedisurvpif()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editpedinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtircmpprf" name="surtircmpprf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithsurcmp()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditcmppinf" name="closeditcmppinf"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closefirmsurt()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtarcm" id="id_surtarcm">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO JLM: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivsurtinf()" id="codisurtjlm"
                                    name="codisurtjlm" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artsucm = mysqli_fetch_row($artisurtidos)):?>
                                    <option value="<?php echo $artsucm[0]?>"><?php echo $artsucm[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO PROVEEDOR: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivsurtinf()" id="codisurtprove"
                                    name="codisurtprove" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artprcm = mysqli_fetch_row($artprsurti)):?>
                                    <option value="<?php echo $artprcm[0]?>"><?php echo $artprcm[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD SURTIDA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="surtartcm" id="surtartcm">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input disabled="" onkeyup="mayus(this);" style="display:none;"
                                    class="form-control inputalta" type="number" name="surtartcm2" id="surtartcm2">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">AGREGAR OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="surbsereped"
                                    id="surbsereped" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar surtir" onclick="confirmsurt()"
                                id="pedrguardarsur"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                ENTRADA</button>
                        </div>
                    </div><!-- col-4 -->
                </div>
            </form>
            <br>
            <div style="display:none;" id="edthdcppblinf" name="edthdcppblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthcppvaciosin" name="edthcppvaciosin" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthcpperrinf" name="edthcpperrinf" class="alert alert-danger" role="alert">
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
                <h4 class="tx-success mg-b-20">Completado!</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsurt" name="descsurt"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1" name="opesurt1" class="tx-20"
                        href="javascript:openedithsurt()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1" name="clossurt1" class="tx-20"
                        href="javascript:closedithsurt()">CERRAR</a>
                    <div id="infsur" name="infsur">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b></p>
                        <label class="tx-16" id="cartsur" name="cartsur"></label>
                        <label class="tx-16" id="cartsur2" name="cartsur2"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsur"
                            name="opstsur"></label>
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
                        <button type="button" onclick="savesurtcm()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                    <br>
                    <div style="display:none;" id="edthdcppblinf2" name="edthdcppblinf2" class="alert alert-warning"
                        role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                            <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                            <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                        </div><!-- d-flex -->
                    </div><!-- alert -->
                    <div style="display:none;" id="edthcppvaciosin2" name="edthcppvaciosin2" class="alert alert-info"
                        role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                            <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                            <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                        </div><!-- d-flex -->
                    </div><!-- alert -->
                    <div style="display:none;" id="edthcpperrinf2" name="edthcpperrinf2" class="alert alert-danger"
                        role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                            <i class="icon ion-ios-close alert-icon tx-24"></i>
                            <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o
                                levantar un
                                ticket</span>
                        </div><!-- d-flex -->
                    </div><!-- alert -->
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->

<!-- MODAL PARA GENERAR ENTRADA ARTICULOS DE COMPRAS -->
<div class="modal fade" id='modal-entradaparcial'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">ENTRADA PARCIAL COMPRAS</h6>
                <button type="button" onclick="closedisurvpif2()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editpedinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtircmpprf2" name="surtircmpprf2" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithsurcmp2()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditcmppinf2" name="closeditcmppinf2"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closefirmsurt2()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtarcm2" id="id_surtarcm2">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO JLM: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="codisurtjlm2" name="codisurtjlm2">
                                <!-- <select class="form-control" onchange="indivsurtinf()" id="codisurtjlm2"
                                    name="codisurtjlm2" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artsucm = mysqli_fetch_row($artisurtidos)):?>
                                    <option value="<?php echo $artsucm[0]?>"><?php echo $artsucm[0]?></option>
                                    <?php endwhile; ?>
                                </select> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO PROVEEDOR: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" id="codisurtprove2" name="codisurtprove2">
                                <!-- <select class="form-control" onchange="indivsurtinf()" id="codisurtprove2"
                                    name="codisurtprove2" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($artprcm = mysqli_fetch_row($artprsurti)):?>
                                    <option value="<?php echo $artprcm[0]?>"><?php echo $artprcm[0]?></option>
                                    <?php endwhile; ?>
                                </select> -->
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD ENTRANTE:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="surtartcm2" id="surtartcm2">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD REAL:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="surtartcm3" id="surtartcm3">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">AGREGAR OBSERVACIONES:</label>
                                <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="surbsereped2"
                                    id="surbsereped2" placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar surtir" onclick="confirmsurt2()"
                                id="pedrguardarsur"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                ENTRADA</button>
                        </div>
                    </div><!-- col-4 -->
                </div>
            </form>
            <br>
            <div style="display:none;" id="edthdcppblinf2" name="edthdcppblinf2" class="alert alert-warning"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthcppvaciosin2" name="edthcppvaciosin2" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthcpperrinf2" name="edthcpperrinf2" class="alert alert-danger"
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