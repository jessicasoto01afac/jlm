<?php include ("../../controller/conexion.php");
session_start();
$folio = $_GET['folio'];
      $sql = "SELECT a.* FROM articulos a, artproveedor p WHERE p.estado = 0 AND a.artcodigo=p.id_articulo AND p.proveedor='$folio' ORDER BY a.id_art ASC";
      $articulo = mysqli_query($conexion,$sql);
    ?>
			<select class="form-control" data-placeholder="Choose one (with searchbox)" onchange="desartic1()" id="mcodigotr" name="mcodigotr" type="text" data-live-search="true" style="width: 100%" >
			<option value="0">CODIGO</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[1]?>"><?php echo $idpst[1]?></option>
			<?php endwhile; ?>
			</select>
	<script type="text/javascript">
        		$(document).ready(function(){
			//$('#mcodigotr').select2();

			$('#mcodigotr').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#mcodigotr').val(),
					url:'session/',
					success:function(r){
					}
				});
			});
		});
//funcion para BUSCAR EL ARTICULO
function desartic1(){
//alert("eentraarticulo")
var codivo = document.getElementById('mcodigotr').value; 
$.ajax({
          url: '../controller/php/conarprovselect.php',
          type: 'GET',
          data:'codigo=' + codivo
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].artcodigo == codivo){
                //$("#mprvedd option[value='1'").attr("selected",true);
                //document.getElementById('mprvedd').value =obj.data[D].codigo_proveedor;
                //alert(obj.data[D].codigo_proveedor);
                  datos = 
                  obj.data[D].artcodigo + '*' +
                  obj.data[D].artdescrip + '*' +
                  obj.data[D].artubicac + '*' +
                  obj.data[D].codigo_proveedor;    
                  var o = datos.split("*");   
                  //alert(obj.data[D].id_arprov);
                  $("#mdecriptr").val(o[1]);   
                  $("#mdepart").val(o[2]); 
                  $("#mprvedd").val(o[3]);
                  $('#mprvedd').change();
              }
          }
      });
}
</script>