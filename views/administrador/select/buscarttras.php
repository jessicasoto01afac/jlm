<?php include ("../../controller/conexion.php");
      $sql = "SELECT a.artcodigo,a.artdescrip,a.artubicac, t.* FROM articulos a, transformation t WHERE t.id_articfial = a.artcodigo AND t.estado = 0 GROUP BY t.id_articfial ";
      $articulo = mysqli_query($conexion,$sql);
    ?>
			<select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" onchange="desartic1()" id="mcodigotr" name="mcodigotr" type="text" data-live-search="true" style="width: 100%" >
			<option value="0">CODIGO</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[0]?>"><?php echo $idpst[0]?></option>
			<?php endwhile; ?>
			</select>
	<script type="text/javascript">
        		$(document).ready(function(){
			$('#mcodigotr').select2();


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
          url: '../controller/php/conarticulos.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].artcodigo == codivo){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].artcodigo + '*' +
                  obj.data[D].artdescrip + '*' +
                  obj.data[D].artubicac;    
                  var o = datos.split("*");   
                  $("#mdecriptr").val(o[1]);   
                  $("#mdepart").val(o[2]); 
              }
          }
      });
}

	</script>