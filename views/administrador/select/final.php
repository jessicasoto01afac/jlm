<?php include ("../../controller/conexion.php");

    
      $sql = "SELECT artcodigo,artdescrip,artubicac FROM `artcntrasf` where transformation is null";
      $articulo = mysqli_query($conexion,$sql);
    ?>

			<select class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)" onchange="desarticvp()" id="vppcodigo" name="vppcodigo" type="text" data-live-search="true" style="width: 100%" >
			<option value="0">CODIGO</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[0]?>"><?php echo $idpst[0]?></option>
			<?php endwhile; ?>
			</select>

	<script type="text/javascript">
        		$(document).ready(function(){
			$('#vppcodigo').select2();


			$('#vppcodigo').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#vppcodigo').val(),
					url:'session/',
					success:function(r){
					}
				});
			});
		});
//funcion para BUSCAR EL ARTICULO
function desarticvp(){
//alert("eentraarticulo")
var codivo = document.getElementById('vppcodigo').value; 
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
                  $("#descripfin").val(o[1]);   
                  //$("#vdepart").val(o[2]); 

              }
          }
      });
}

	</script>