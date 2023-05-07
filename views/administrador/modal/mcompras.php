<?php include ("../controller/conexion.php");
      $sql10 = "SELECT codigo_proveedor,descrip_proveedor FROM artproveedor WHERE estado = 0";
      $artieditrnas = mysqli_query($conexion,$sql10);

      $sql11 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artiedidettvp = mysqli_query($conexion,$sql11);
      
      $sql9 = "SELECT codigo_proveedor,descrip_proveedor FROM artproveedor WHERE estado = 0";
      $artprvadd= mysqli_query($conexion,$sql9);

      $sql8 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $artijlm = mysqli_query($conexion,$sql8);
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
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control"
                                    name="ediobsercm" id="ediobsercm"
                                    placeholder="Ingresa alguna observación"></textarea>
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
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="id_artincm"
                        id="id_artincm">
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
