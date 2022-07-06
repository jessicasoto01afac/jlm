<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bracket">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Bracket">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Usuarios</title>

    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
</head>

<body class="collapsed-menu">


    <?php

include('header.php');
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">USUARIOS</h4>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <a class="btn btn-primary" href="../administrador/newacces.php" style="float:right"><i
                        class="fa fa-user-plus mg-r-10"></i>Agregar Usuario</a>
                <br>
                <br>
                <br>
                <div id="listusu">
                </div><!-- br-section-wrapper -->
            </div><!-- br-pagebody -->
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
        <!-- ########## END: MAIN PANEL ########## -->

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
        <script src="../controller/js/catalogos.js"></script>
        <script src="../template/js/bracket.js"></script>

        <?php include('../administrador/modal.php');?>
        <script>
        usuarios();
        </script>

</body>

</html>