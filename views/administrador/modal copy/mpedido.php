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

<!-- !-- MODAL DE DETALLES SIN EXISTENCIA-->
<div class="modal fade" id='modal-sinexipedido'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <input style="display:none" class="form-control" type="text" name="idsinexpedi" id="idsinexpedi">
                <button type="button" onclick="closedithsnex()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">No fue surtido por falta de Existencia</h4>
                <div class="card-body pd-x-20 pd-xs-10">
                    <p class="mg-b-30 tx-16" id="descsinpedi" name="descsinpedi"></p>
                    <p class="mg-b-30 tx-16">"INFORMACIÓN DEL ARTICULO"</p>
                    <a align="left" id="opesurt1snp" name="opesurt1snp" class="tx-20"
                        href="javascript:openedithsnex()">EDITAR</a>
                    <a align="left" style="display:none" id="clossurt1snp" name="clossurt1snp" class="tx-20"
                        href="javascript:closedithsnex()">CERRAR</a>
                    <div id="infsursnp" name="infsursnp">
                        <p class="mg-b-20 mg-x-20 tx-16 tx-blue"><b>CANTIDAD: </b><label class="tx-16" id="cartsinped"
                                name="cartsinped"></label>
                        <p class="tx-16 tx-blue"><b>OBSERVACIONES:</b></p> <label class="tx-16" id="opstsinped"
                            name="opstsinped"></label></p>
                    </div>
                    <div style="display:none" id="editarsinped" name="editarsinped">
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Cantidad:</label>
                            <input class="form-control" type="number" name="cnsinped" id="cnsinped"
                                placeholder="Cantidad:">
                        </div><!-- form-group -->
                        <div align="left" class="form-group">
                            <label for="my-textarea" style="color:#03065B" class="tx-left">Observaciones:</label>
                            <textarea onkeyup="mayus(this);" id="obdepsinped" class="form-control" name="obdepsinped"
                                rows="2"></textarea>
                        </div>
                        <button type="button" onclick="savesinextped()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->

<!-- MODAL PARA EDITAR ARTICULOS EN ALTA DE PEDIDOS-->
<div class="modal fade" id='modal-edithaddpedit'>
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
                    <a href="#" id="openediaddped" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editaraddartic()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closedithped" style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closeaddarped()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_edithpe" id="id_edithpe">
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
                                <input onkeyup="mayus(this);" class="form-control" readonly name="pednewedithdes"
                                    id="pednewedithdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pedednewtcantid"
                                    id="pedednewtcantid" placeholder="Ingrese la cantidad" disabled type="number"
                                    required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pediedthdeparnew"
                                    id="pediedthdeparnew" placeholder="Departamento" readonly type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERBACIONES: <span
                                        class="tx-danger"></span></label>
                                <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="pepidobsaddnew"
                                    id="pepidobsaddnew" disabled placeholder="Ingresa alguna observación"></textarea>
                            </div>
                        </div><!-- col-12 -->
                    </div><!-- col-4 -->
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" onclick="saveeditharped()" id="saveedithped" style="display:none;"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                    CAMBIOS</button>
            </div>
            <br>
            <div style="display:none;" id="edithpednewlle" name="edithpednewlle" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="errpedqnew" name="errpedqnew" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA ELIMINAR ARTICULOS DE ALTA DE PEDIDOS -->
<div class="modal fade" id='modal-delearpednew' name='modal-delearpednew'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO DE PEDIDOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletearped" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-20">
                    <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE PEDIDO?</p>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="del_artpednew" id="del_artpednew">
                    <input disabled="" class="form-control inputalta" type="text" name="deartpednew" id="deartpednew">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="savdelevpartped()"
                        class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                    <br>
                </div>
                <div style="display:none;" id="delerarpednew" name="delerarpednew" class="alert alert-danger"
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

<!-- MODAL PARA EDITAR ARTICULOS EXTENDIDOS EN VISTA PREVIA EN PEDIDOS-->
<div class="modal fade" id='modal-edithdetpedi'>
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
                    <a id="openedithpedido" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="editarpeddett()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a id="closedithpedido" style="float: right;font-size: 16px;display:none; color: white"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedithpeddett()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_pededithdett" id="id_pededithdett">
                    <div class="row mg-b-25">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CODIGO:<span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="edithextdettvp()" id="cdedttpededith"
                                    name="cdedttpededith" type="text" disabled data-live-search="true"
                                    style="width: 100%">
                                    <option value="0">CODIGO</option>
                                    <?php while($arttrasdett = mysqli_fetch_row($artiedidettvp)):?>
                                    <option value="<?php echo $arttrasdett[0]?>"><?php echo $arttrasdett[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" readonly name="peddettedithdes"
                                    id="peddettedithdes" placeholder="" type="text" required>
                            </div><!-- form-group -->
                        </div><!-- form-group -->
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control" name="pededdettcantid"
                                    id="pededdettcantid" placeholder="Ingrese la cantidad" disabled type="number"
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
                <button type="button" onclick="saveedithdettped()" id="saveedithpedidett" style="display:none;"
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

<!-- MODAL PARA ELIMINAR ARTICULOS DE DETALLES DE PEDIDO-->
<div class="modal fade" id='modal-deleartped' name='modal-deleartped'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR ARTICULO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL ARTICULO DE ESTE PEDIDO?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                    name="del_artpeddetts" id="del_artpeddetts">
                <!-- <input disabled="" style="text-align:center" class="form-control inputalta" type="text"
                    name="deartpedidett" id="deartpedidett"> -->
                <textarea disabled="" style="text-align:center" class="form-control inputalta" name="deartpedidett"
                    id="deartpedidett" cols="3" rows="3"></textarea>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savdelepediartdet()"
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

<!-- MODAL PARA AGREGAR ARTICULO INDIVIDUAL EN INFO DE PEDIDOS-->
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
                                <input onkeyup="mayus(this);" class="form-control" readonly name="pindescripinf"
                                    id="pindescripinf" placeholder="" type="text" required>
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
                <button type="button" onclick="addarinpedinfo()" id="addarinpro2" name="addarinpro2"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">AGREGAR</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL PARA HISTORIAL-->
<div class="modal fade" id='modal-pedhistorial'>
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
                        <span class="square-10 bg-primary mg-r-5"></span><span id="dias1" name="dias1"></span>
                        <span class="square-10 bg-purple mg-r-5"></span><span id="dias2" name="dias2"></span>
                        <span class="square-10 bg-teal mg-r-5"></span><span id="dias3" name="dias3"></span>
                    </div>
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
<!-- MODAL PARA SURTIR ARTICULOS DE PRODUCCIÓN-->
<div class="modal fade" id='modal-surtirpedrod'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR ARTICULO DE PEDIDO</h6>
                <button type="button" onclick="closedisurvpif()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editpedinf" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-25">
                    <a href="#" id="surtirpedrf" name="surtirpedrf" style="float: right;font-size: 16px"
                        class="btn btn-warning btn-icon rounded-circle mg-r-5 mg-b-10" onclick="edithsurpedif()"
                        title="Dar clic para editar">
                        <div><i class="fa fa-edit"></i></div>
                    </a>
                    <a href="#" id="closeditpedrinf" name="closeditpedrinf"
                        style="float: right;font-size: 16px;display:none;"
                        class="btn btn-danger btn-icon rounded-circle mg-r-5 mg-b-10" onclick="closedisurvpif()"
                        title="Dar clic para cerrar">
                        <div><i class="fa fa-times"></i></div>
                    </a>
                    <input style="display:none;" disabled="" class="form-control inputalta" type="text"
                        name="id_surtpedif" id="id_surtpedif">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CODIGO: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control" onchange="indivsurtinf()" id="codisurtped"
                                    name="codisurtped" type="text" disabled="" data-live-search="true"
                                    style="width: 100%">
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
                                    name="descripsurped" id="descripsurped">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">CANTIDAD SURTIDA:<span
                                        class="tx-danger">*</span></label>
                                <input disabled="" onkeyup="mayus(this);" onchange="totalvoinfe()"
                                    class="form-control inputalta" type="number" name="surtapedrinf" id="surtapedrinf">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">OBSERVACIONES ANEXAS:</label>
                                <textarea disabled="" onkeyup="mayus(this);" rows="2" class="form-control"
                                    name="surbsereped" id="surbsereped"
                                    placeholder="Ingresa alguna observación"></textarea>
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
                            <button type="button" title="Dar click para marcar surtir" onclick="acsurtirpedf()"
                                id="pedrguardarsur"
                                class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">CONFIRAR
                                SURTIR</button>
                        </div>
                        <div class="col-lg-4">
                            <button type="button" title="Dar click para marcar sin existencia" onclick="sinexisten()"
                                id="pedrguardarsur"
                                class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">SIN
                                EXISTENCIAS</button>
                        </div>

                    </div><!-- col-4 -->
                </div>
            </form>

            <br>
            <div style="display:none;" id="edthdpedblinf" name="edthdpedblinf" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthpedvaciosin" name="edthpedvaciosin" class="alert alert-info"
                role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="edthpederrinf" name="edthpederrinf" class="alert alert-danger" role="alert">
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <button type="button" onclick="savesurtped()"
                            class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                            Guardar cambios</button>
                    </div><!-- modal-body -->
                </div>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- pd-y-50 -->

<!-- MODAL PARA SURTIR ARTICULOS DE PRODUCCIÓN MASIVAMENTE-->
<div class="modal fade" id='modal-surtirmasivo'>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-5">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold">SURTIR MASIVAMENTE</h6>
                <button type="button" onclick="closedisurvpif()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="masivopedi" class="form-horizontal" action="" method="POST">
                <div class="modal-body pd-12">
                    <div class="col-lg-20">
                        <div id="masive" name="masive"></div>
                    </div>
                    <button type="button" onclick="savemasive()"
                        class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                        Guardar</button>
                </div>
            </form>
            <br>
            <div id="errmasivo" name="errmasivo" class="alert alert-danger d-none" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->