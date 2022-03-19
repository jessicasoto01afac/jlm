<?php include ("../../controller/conexion.php");

    
      $sql = "SELECT codigo_pro,nom_pro FROM proveedores WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);
    ?>

			<select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" onchange="desarprov()" id="vprov" name="vprov" type="text" data-live-search="true" style="width: 100%" >
			<option value="">SELECCIONE PROVEEDOR</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[0]?>"><?php echo $idpst[1]?></option>
			<?php endwhile; ?>
			</select>

	<script type="text/javascript">
        		$(document).ready(function(){
			$('#vcodigo').select2();


			$('#vcodigo').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#vcodigo').val(),
					url:'session/',
					success:function(r){
					}
				});
			});
		});
//funcion para BUSCAR EL ARTICULO
function desarprov(){
//alert("eentraarticulo")
var codivo = document.getElementById('vprov').value; 
$.ajax({
          url: '../controller/php/conproveedores.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].codigo_pro == codivo){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].nom_pro + '*' +
                  obj.data[D].id_prov  + '*' +
                  obj.data[D].codigo_pro;    
                  var o = datos.split("*");   
                  $("#desprov1").val(o[0]);   
              }
          }
      });
}

	</script>