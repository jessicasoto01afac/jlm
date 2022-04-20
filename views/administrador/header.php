<?php 
include ("../controller/conexion.php");
session_start();

$usuario=$_SESSION['username'];

if(!isset($usuario)){
  header("location: ./../../");
}
//$id = $_SESSION['persona'];
$sql = 
       "SELECT id_per,usunom,usuapell FROM accesos WHERE usuario = '$usuario'";

      $persona = mysqli_query($conexion,$sql);
      $datos = mysqli_fetch_row($persona);
?>
    
    <!-- Bracket CSS -->
     <link rel="stylesheet" href="../template/css/bracket.css">
 
 <!-- ########## START: LEFT PANEL ########## -->
 <div class="br-logo"><a href="../administrador/inicio.php"><span>[</span>JLM<span>]</span></a></div>
 
 <div class="br-sideleft overflow-y-auto">
   <label class="sidebar-label pd-x-15 mg-t-20">MENÚ PRINCIPAL</label>
   <div class="br-sideleft-menu">
     <a href="../administrador/inicio.php" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
         <span href="../administrador/inicio.php" class="menu-item-label">Dashboard</span>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon icon ion-document tx-24"></i>
         <span class="menu-item-label">Catalogos</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="../administrador/usuarios.php" class="nav-link" >Accesos</a></li>
       <li class="nav-item"><a href="../administrador/articulos.php" class="nav-link">Articulos</a></li>
       <li class="nav-item"><a href="../administrador/transformacion.php" class="nav-link">Transformación</a></li>
       <li class="nav-item"><a href="../administrador/clientes.php" class="nav-link">Clientes</a></li>
       <li class="nav-item"><a href="../administrador/provedores.php" class="nav-link">Proveedores</a></li>
       <li class="nav-item"><a href="../administrador/artiprove.php" class="nav-link">Articulos Proveedor</a></li>
     </ul>
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon fa fa-spinner tx-24"></i>
         <span class="menu-item-label">Producción</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="../administrador/vale_produccion.php" class="nav-link">Producción</a></li>
       <li class="nav-item"><a href="../administrador/memos.php" class="nav-link">Memos</a></li>
       <li class="nav-item"><a href="../administrador/vale_oficina.php" class="nav-link">Vales de oficina</a></li>
     </ul>
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon ion ion-bag tx-24"></i>
         <span class="menu-item-label">Pedidos</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="../administrador/pedidos.php" class="nav-link">Agregar layout</a></li>
       <li class="nav-item"><a href="../administrador/listpedido.php" class="nav-link">Lista de pedidos</a></li>
     </ul>
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
         <span class="menu-item-label">Compras</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="chart-morris.html" class="nav-link">Alta de orden</a></li>
       <li class="nav-item"><a href="chart-flot.html" class="nav-link">Lista de Compras</a></li>
     </ul>
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
         <span class="menu-item-label">Kardex</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="inventario.php" class="nav-link">Inventario</a></li>
       <li class="nav-item"><a href="chart-flot.html" class="nav-link">Movimientos</a></li>
     </ul>
     <a href="#" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
         <span class="menu-item-label">Reportes</span>
         <i class="menu-item-arrow fa fa-angle-down"></i>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
     <ul class="br-menu-sub nav flex-column">
       <li class="nav-item"><a href="form-elements.html" class="nav-link">Falta de material</a></li>
       <li class="nav-item"><a href="form-layouts.html" class="nav-link">ventas mensuales</a></li>
       <li class="nav-item"><a href="../administrador/hcambios.php" class="nav-link">Historial de Cambios</a></li>
     </ul>
     
     <a href="sitemap.html" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
         <span class="menu-item-label">Manual</span>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->


   <a href="./soporte.php" class="br-menu-link">
       <div class="br-menu-item">
         <i class="menu-item-icon icon ion-help-buoy tx-22"></i>
         <span class="menu-item-label">Soporte Tecnico</span>
       </div><!-- menu-item -->
     </a><!-- br-menu-link -->
   </div><!-- br-sideleft-menu -->

   <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">Informacion de pedidos</label>

   <div class="info-list">
     <div class="d-flex align-items-center justify-content-between pd-x-15">
       <div>
         <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Finalizados</p>
         <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
       </div>
       <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
     </div><!-- d-flex -->

     <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
       <div>
         <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Surtidos</p>
         <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
       </div>
       <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
     </div><!-- d-flex -->

     <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
       <div>
         <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Pendientes</p>
         <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
       </div>
       <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
     </div><!-- d-flex -->

     <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
       <div>
         <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Cancelados</p>
         <h5 class="tx-lato tx-white tx-normal mg-b-0">62,201</h5>
       </div>
       <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
     </div><!-- d-flex -->
   </div><!-- info-lst -->

   <br>
 </div><!-- br-sideleft -->
 <!-- ########## END: LEFT PANEL ########## -->

 <!-- ########## START: HEAD PANEL ########## -->
 <div class="br-header">
   <div class="br-header-left">
     <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
     <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
     <div class="input-group hidden-xs-down wd-170 transition">
     </div><!-- input-group -->
   </div><!-- br-header-left -->
   <div class="br-header-right">
     <nav class="nav">
       <div class="dropdown">
         <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
           <i class="icon ion-ios-email-outline tx-24"></i>
           <!-- start: if statement -->
           <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
           <!-- end: if statement -->
         </a>
         <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
           <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
             <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Mensajes</label>
             <a href="" class="tx-11"></a>
           </div><!-- d-flex -->

           <div class="media-list">
             <!-- loop starts here -->
             <a href="" class="media-list-link">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <div class="d-flex align-items-center justify-content-between mg-b-5">
                     <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Veronica Aucebio</p>
                     <span class="tx-11 tx-gray-500">2 minutes ago</span>
                   </div><!-- d-flex -->
                   <p class="tx-12 mg-b-0">Tienes un pedido nuevo favor de atender</p>
                 </div>
               </div><!-- media -->
             </a>
             <!-- loop ends here -->
             <a href="" class="media-list-link read">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <div class="d-flex align-items-center justify-content-between mg-b-5">
                     <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Almacen</p>
                     <span class="tx-11 tx-gray-500">3 hours ago</span>
                   </div><!-- d-flex -->
                   <p class="tx-12 mg-b-0">Ya tendrn listo el material ara el pedido 8962</p>
                 </div>
               </div><!-- media -->
             </a>
             <a href="" class="media-list-link read">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <div class="d-flex align-items-center justify-content-between mg-b-5">
                     <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Almacen</p>
                     <span class="tx-11 tx-gray-500">5 hours ago</span>
                   </div><!-- d-flex -->
                   <p class="tx-12 mg-b-0">Es urgente el pedido 12161</p>
                 </div>
               </div><!-- media -->
             </a>
             <a href="" class="media-list-link read">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <div class="d-flex align-items-center justify-content-between mg-b-5">
                     <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Almacen</p>
                     <span class="tx-11 tx-gray-500">Yesterday</span>
                   </div><!-- d-flex -->
                   <p class="tx-12 mg-b-0">Favor de surtir los pedidos</p>
                 </div>
               </div><!-- media -->
             </a>
             <div class="pd-y-10 tx-center bd-t">
               <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Messages</a>
             </div>
           </div><!-- media-list -->
         </div><!-- dropdown-menu -->
       </div><!-- dropdown -->
       <div class="dropdown">
         <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
           <i class="icon ion-ios-bell-outline tx-24"></i>
           <!-- start: if statement -->
           <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
           <!-- end: if statement -->
         </a>
         <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
           <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
             <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notificación</label>
             <a href="" class="tx-11"></a>
           </div><!-- d-flex -->

           <div class="media-list">
             <!-- loop starts here -->
             <a href="" class="media-list-link read">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">PEDIDOS</strong>Tienes 20 pedidos sin finalzar</p>
                   <span class="tx-12">lunes 03, 2022 8:45am</span>
                 </div>
               </div><!-- media -->
             </a>
             <!-- loop ends here -->
             <a href="" class="media-list-link read">
               <div class="media pd-x-20 pd-y-15">
                 <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                 <div class="media-body">
                   <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">VALES</strong> AUN NO SURTES EL VALE 1215</p>
                   <span class="tx-12">October 02, 2017 12:44am</span>
                 </div>
               </div><!-- media -->
             </a>
             <div class="pd-y-10 tx-center bd-t">
               <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Ver todos</a>
             </div>
           </div><!-- media-list -->
         </div><!-- dropdown-menu -->
       </div><!-- dropdown -->
       <div class="dropdown">
         <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
           <span id="username" class="logged-name hidden-md-down"><?php echo $datos[1].' '.$datos[2]?></span>
           <img src="http://via.placeholder.com/64x64" class="wd-32 rounded-circle" alt="">
           <span class="square-10 bg-success"></span>
         </a>
         <div class="dropdown-menu dropdown-menu-header wd-200">
           <ul class="list-unstyled user-profile-nav">
             <li><a href=""><i class="icon ion-ios-person"></i> Editar pefil</a></li>
             <li><a href=""><i class="icon ion-ios-gear"></i> Configuración</a></li>
             <li><a href=""><i class="icon ion-ios-download"></i> Descragas</a></li>
             <li><a href=""><i class="icon ion-ios-star"></i> Favoritos</a></li>
             <li><a href=""><i class="icon ion-ios-folder"></i> Collecciones</a></li>
             <li><a href="./../../controller/logout.php"><i class="icon ion-power"></i> Cerrar sesión</a></li>
           </ul>
         </div><!-- dropdown-menu -->
       </div><!-- dropdown -->
     </nav>
     <div class="navicon-right">
       <a id="btnRightMenu" href="" class="pos-relative">
         <i class="icon ion-ios-chatboxes-outline"></i>
         <!-- start: if statement -->
         <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
         <!-- end: if statement -->
       </a>
     </div><!-- navicon-right -->
   </div><!-- br-header-right -->
 </div><!-- br-header -->
 <!-- ########## END: HEAD PANEL ########## -->

 <!-- ########## START: RIGHT PANEL ########## -->
 <div class="br-sideright">
   <ul class="nav nav-tabs sidebar-tabs" role="tablist">
     <li class="nav-item">
       <a class="nav-link active" data-toggle="tab" role="tab" href="#contacts"><i class="icon ion-ios-contact-outline tx-24"></i></a>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-toggle="tab" role="tab" href="#attachments"><i class="icon ion-ios-folder-outline tx-22"></i></a>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-toggle="tab" role="tab" href="#calendar"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
     </li>
     <li class="nav-item">
       <a class="nav-link" data-toggle="tab" role="tab" href="#settings"><i class="icon ion-ios-gear-outline tx-24"></i></a>
     </li>
   </ul><!-- sidebar-tabs -->

   <!-- Tab panes -->
   <div class="tab-content">
     <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto active" id="contacts" role="tabpanel">
       <label class="sidebar-label pd-x-25 mg-t-25">Online Contacts</label>
       <div class="contact-list pd-x-10">
         <a href="" class="contact-list-link new">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Marilyn Tarter</p>
               <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
             </div>
             <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0 ">Belinda Connor</p>
               <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link new">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Britanny Cevallos</p>
               <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
             </div>
             <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 3 new</span>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link new">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Brandon Lawrence</p>
               <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
             </div>
             <span class="tx-info tx-12"><span class="square-8 bg-info rounded-circle"></span> 1 new</span>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Andrew Wiggins</p>
               <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Theodore Gristen</p>
               <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-success"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Deborah Miner</p>
               <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
       </div><!-- contact-list -->


       <label class="sidebar-label pd-x-25 mg-t-25">Offline Contacts</label>
       <div class="contact-list pd-x-10">
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Marilyn Tarter</p>
               <span class="tx-12 op-5 d-inline-block">Clemson, CA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="mg-l-10">
               <p class="mg-b-0">Belinda Connor</p>
               <span class="tx-12 op-5 d-inline-block">Fort Kent, ME</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Britanny Cevallos</p>
               <span class="tx-12 op-5 d-inline-block">Shiboygan Falls, WI</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Brandon Lawrence</p>
               <span class="tx-12 op-5 d-inline-block">Snohomish, WA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Andrew Wiggins</p>
               <span class="tx-12 op-5 d-inline-block">Springfield, MA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Theodore Gristen</p>
               <span class="tx-12 op-5 d-inline-block">Nashville, TN</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
         <a href="" class="contact-list-link">
           <div class="d-flex">
             <div class="pos-relative">
               <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
               <div class="contact-status-indicator bg-gray-500"></div>
             </div>
             <div class="contact-person">
               <p class="mg-b-0">Deborah Miner</p>
               <span class="tx-12 op-5 d-inline-block">North Shore, CA</span>
             </div>
           </div><!-- d-flex -->
         </a><!-- contact-list-link -->
       </div><!-- contact-list -->

     </div><!-- #contacts -->


     <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="attachments" role="tabpanel">
       <label class="sidebar-label pd-x-25 mg-t-25">Recent Attachments</label>
       <div class="media-file-list">
         <div class="media">
           <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-image-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">IMG_43445</p>
             <p class="mg-b-0 tx-12 op-5">JPG Image</p>
             <p class="mg-b-0 tx-12 op-5">1.2mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-video-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">VID_6543</p>
             <p class="mg-b-0 tx-12 op-5">MP4 Video</p>
             <p class="mg-b-0 tx-12 op-5">24.8mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-success wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-word-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">Tax_Form</p>
             <p class="mg-b-0 tx-12 op-5">Word Document</p>
             <p class="mg-b-0 tx-12 op-5">5.5mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-warning wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">Getting_Started</p>
             <p class="mg-b-0 tx-12 op-5">PDF Document</p>
             <p class="mg-b-0 tx-12 op-5">12.7mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-warning wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-pdf-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">Introduction</p>
             <p class="mg-b-0 tx-12 op-5">PDF Document</p>
             <p class="mg-b-0 tx-12 op-5">7.7mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-image-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">IMG_43420</p>
             <p class="mg-b-0 tx-12 op-5">JPG Image</p>
             <p class="mg-b-0 tx-12 op-5">2.2mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-primary wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-image-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">IMG_43447</p>
             <p class="mg-b-0 tx-12 op-5">JPG Image</p>
             <p class="mg-b-0 tx-12 op-5">3.2mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-purple wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-video-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">VID_6545</p>
             <p class="mg-b-0 tx-12 op-5">AVI Video</p>
             <p class="mg-b-0 tx-12 op-5">14.8mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
         <div class="media mg-t-20">
           <div class="pd-10 bg-success wd-50 ht-60 tx-center d-flex align-items-center justify-content-center">
             <i class="fa fa-file-word-o tx-28 tx-white"></i>
           </div>
           <div class="media-body">
             <p class="mg-b-0 tx-13">Secret_Document</p>
             <p class="mg-b-0 tx-12 op-5">Word Document</p>
             <p class="mg-b-0 tx-12 op-5">4.5mb</p>
           </div><!-- media-body -->
           <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
         </div><!-- media -->
       </div><!-- media-list -->
     </div><!-- #history -->
     <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="calendar" role="tabpanel">
       <label class="sidebar-label pd-x-25 mg-t-25">Time &amp; Date</label>
       <div class="pd-x-25">
         <h2 id="brTime" class="tx-white tx-lato mg-b-5"></h2>
         <h6 id="brDate" class="tx-white tx-light op-3"></h6>
       </div>

       <label class="sidebar-label pd-x-25 mg-t-25">Events Calendar</label>
       <div class="datepicker sidebar-datepicker"></div>


       <label class="sidebar-label pd-x-25 mg-t-25">Event Today</label>
       <div class="pd-x-25">
         <div class="list-group sidebar-event-list mg-b-20">
           <div class="list-group-item">
             <div>
               <h6 class="tx-white tx-13 mg-b-5 tx-normal">Roven's 32th Birthday</h6>
               <p class="mg-b-0 tx-white tx-12 op-2">2:30PM</p>
             </div>
             <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
           </div><!-- list-group-item -->
           <div class="list-group-item">
             <div>
               <h6 class="tx-white tx-13 mg-b-5 tx-normal">Regular Workout Schedule</h6>
               <p class="mg-b-0 tx-white tx-12 op-2">7:30PM</p>
             </div>
             <a href="" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
           </div><!-- list-group-item -->
         </div><!-- list-group -->

         <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">+ Add Event</a>
         <br>
       </div>

     </div>
     <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="settings" role="tabpanel">
       <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>

       <div class="pd-y-20 pd-x-25 tx-white">
         <h6 class="tx-13 tx-normal">Sound Notification</h6>
         <p class="op-5 tx-13">Play an alert sound everytime there is a new notification.</p>
         <div class="pos-relative">
           <input type="checkbox" name="checkbox" class="switch-button" checked>
         </div>
       </div>

       <div class="pd-y-20 pd-x-25 tx-white">
         <h6 class="tx-13 tx-normal">2 Steps Verification</h6>
         <p class="op-5 tx-13">Sign in using a two step verification by sending a verification code to your phone.</p>
         <div class="pos-relative">
           <input type="checkbox" name="checkbox2" class="switch-button">
         </div>
       </div>

       <div class="pd-y-20 pd-x-25 tx-white">
         <h6 class="tx-13 tx-normal">Location Services</h6>
         <p class="op-5 tx-13">Allowing us to access your location</p>
         <div class="pos-relative">
           <input type="checkbox" name="checkbox3" class="switch-button">
         </div>
       </div>

       <div class="pd-y-20 pd-x-25 tx-white">
         <h6 class="tx-13 tx-normal">Newsletter Subscription</h6>
         <p class="op-5 tx-13">Enables you to send us news and updates send straight to your email.</p>
         <div class="pos-relative">
           <input type="checkbox" name="checkbox4" class="switch-button" checked>
         </div>
       </div>

       <div class="pd-y-20 pd-x-25 tx-white">
         <h6 class="tx-13 tx-normal">Your email</h6>
         <div class="pos-relative">
           <input type="email" name="email" class="form-control form-control-inverse transition pd-y-10" value="janedoe@domain.com">
         </div>
       </div>

       <div class="pd-y-20 pd-x-25">
         <h6 class="tx-13 tx-normal tx-white mg-b-20">More Settings</h6>
         <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Account Settings</a>
         <a href="" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Privacy Settings</a>
       </div>

     </div>
   </div><!-- tab-content -->
 </div><!-- br-sideright -->
 <script src="../controller/js/catalogos.js"></script>
 <!-- ########## END: RIGHT PANEL ########## --->