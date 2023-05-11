<!DOCTYPE html>
<html lang="es">
<?php include ("../../controller/conexion.php");
$sql = "SELECT refe_1 FROM kardex WHERE estado = 0 and tipo='PEDIDO' group by refe_1 ORDER BY refe_1 DESC";
$cliente = mysqli_query($conexion,$sql);

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Entregas</title>

    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../template/css/diseno.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
    <script src="../controller/js/vale_produc.js"></script>
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
<script src="../template/js/sweetalert2.all.min.js"></script>


</head>
<style>
.swal-wide {
    width: 500px !important;
    font-size: 16px !important;
}
</style>
<body class="collapsed-menu">


    <?php

include('header.php');
?>
    <!------------------------------- ########## LISTA DE VALES ########## -------------------------->
    <section class="content" id="lista">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">ADMINISTRADOR DE ENTREGAS</h4>
            </div>
            <div class="br-pagebody">


                <!-- de aqui -->

                <div class="br-section-wrapper">
                    <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h6 class="mg-b-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition">
                                        + Entregas
                                    </a>
                                </h6>
                            </div><!-- card-header -->

                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block pd-20">
                                    <div>
                                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-t-20 mg-b-10">Agrega
                                            entregas</h6>

                                        <div class="form-layout form-layout-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <select id="cliente1" name="cliente1" class="form-control select2-show-search" style="width: 100%" data-placeholder="Choose country">
                                                        <option label="">Selecciona</option>
                                                        <?php while($provv = mysqli_fetch_row($cliente)):?>
                                                        <option value="<?php echo $provv[0]?>"><?php echo $provv[0]?>
                                                        </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                    </div>
                                                </div><!-- col-4 -->
                                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                                    <div class="form-group mg-md-l--1">
                                                        <label for="">Fecha de entrega</label>
                                                        <input class="form-control" type="date" id="dateentrega" name="dateentrega" 
                                                            placeholder="Enter lastname (required)">
                                                    </div>
                                                </div><!-- col-4 -->
                                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                                    <div class="form-group mg-md-l--1">
                                                        <label for="">Correo de notificación</label>
                                                        <input class="form-control" type="text" name="email"
                                                            placeholder="Enter email address">
                                                    </div>
                                                </div><!-- col-4 -->

                                                <div class="col-md-12">
                                                    <div class="form-group bd-t-0-force">
                                                        <!-- <input class="form-control" type="text" name="address"
                                                            placeholder="Enter address"> -->
                                                        <textarea class="form-control" placeholder="Observaciones"
                                                            name="obserentr" id="obserentr" cols="5" rows="5"></textarea>
                                                    </div>
                                                </div><!-- col-8 -->
                                            </div><!-- row -->
                                            <div class="form-layout-footer bd pd-20 bd-t-0">
                                                <button class="btn btn-info" onclick="saveentregas()">Guardar</button>
                                            </div><!-- form-group -->
                                        </div><!-- form-layout -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- card -->
                        <!-- ADD MORE CARD HERE -->
                    </div><!-- accordion -->

                    <div class="ht-70 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
                        <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#posts"
                                    role="tab">Todas</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#"
                                    role="tab">Pendientes</a>
                            </li>
                            <li class="nav-item hidden-xs-down"><a class="nav-link" data-toggle="tab" href="#"
                                    role="tab">Finalizadas</a></li>
                        </ul>
                    </div>
                    <!-- aqui -->




                    <div class="tab-content br-profile-body">
                        <div class="tab-pane fade active show" id="posts">
                            <div class="table-wrapper rounded table-responsive">
                                <table class="table display dataTable no-footer" id="example" name="example"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width:5%;">ID</th>
                                            <th>NO. PEDIDO</th>
                                            <th>FECHA</th>
                                            <th>EMPRESA</th>
                                            <th>NO. RASTREO</th>
                                            <th>ESTATUS</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div><!-- br-section-wrapper -->
                    </div><!-- br-pagebody -->
                </div>
            </div>
            <footer class="br-footer">
                <div class="footer-left">
                    <div class="mg-b-2">Copyright &copy; 2022. Derechos reservados a JLM.</div>
                    <div>Jose Luis Mondragon y CIA.</div>
                </div>
                <div class="footer-right d-flex align-items-center">
                    <a target="_blank" class="pd-x-5" href="http://www.facebook.com/JLMPAPELERA"><i
                            class="fa fa-facebook tx-20"></i></a>
                    <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i
                            class="fa fa-globe tx-20"></i></a>
                </div>
            </footer>
        </div><!-- br-mainpanel -->
    </section>
    <!-- ########## END: MAIN PANEL ########## -->

    <?php include('../administrador/modal/mentregas.php');?>

    <script src="../template/lib/jquery/jquery.js"></script>
    <script src="../template/lib/popper.js/popper.js"></script>
    <script src="../template/lib/bootstrap/bootstrap.js"></script>
    <script src="../template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../template/lib/moment/moment.js"></script>
    <script src="../template/lib/jquery-ui/jquery-ui.js"></script>
    <script src="../template/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../template/lib/peity/jquery.peity.js"></script>
    <script src="../template/lib/highlightjs/highlight.pack.js"></script>
    <script src="../template/lib/datatables/jquery.dataTables.js"></script>
    <script src="../template/lib/datatables-responsive/dataTables.responsive.js"></script>

    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../controller/js/entregas.js"></script>
    <script src="../template/js/bracket.js"></script>
    <!-- DataTables -->
    <script src="../controller/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../controller/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../controller/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script type="text/javascript">
    // TABLA INSPECTORES EXTERNOS//
    openentregas();
    </script>


</body>

</html>