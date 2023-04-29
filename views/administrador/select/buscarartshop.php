<?php include ("../../controller/conexion.php");
      $sql = "SELECT id_articulo,codigo_proveedor,descrip_proveedor FROM artproveedor a WHERE estado = 0 ORDER BY id_arprov ASC";
      $articulo = mysqli_query($conexion,$sql);
    ?>
			<select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" onchange="desartic4()" id="mprvedd" name="mprvedd" type="text" data-live-search="true" style="width: 100%" >
			<option value="0">CODIGO</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[0]?>"><?php echo $idpst[1]?></option>
			<?php endwhile; ?>
			</select>
	<script type="text/javascript">
        		$(document).ready(function(){
			$('#mprvedd').select2();

			$('#mprvedd').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#mprvedd').val(),
					url:'session/',
					success:function(r){
					}
				});
			});
		});
//funcion para BUSCAR EL ARTICULO
function desartic4(){
//alert("eentraarticulo")
var codico =  document.getElementById('mprvedd').value; 
$.ajax({
          url: '../controller/php/conprvart.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0; 
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].id_articulo == codico){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].id_articulo + '*' +
                  obj.data[D].codigo_proveedor + '*' +
                  obj.data[D].descrip_proveedor;    
                  var o = datos.split("*");   
                  $("#mdecripprvvd").val(o[2]);   
              }
          }
      });
}
</script>