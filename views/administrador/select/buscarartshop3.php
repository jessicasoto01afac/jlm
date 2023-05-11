<?php include ("../../controller/conexion.php");

session_start();
$folio = $_GET['folio'];
      $sql = "SELECT codigo_proveedor,codigo_proveedor,descrip_proveedor FROM artproveedor a WHERE estado = 0 AND proveedor='$folio' ORDER BY id_arprov ASC";
      $articulo = mysqli_query($conexion,$sql);
?>
			<select class="form-control" data-placeholder="Choose one (with searchbox)" disabled onchange="desartic4()" id="mprvedd3" name="mprvedd3" type="text" data-live-search="true" style="width: 100%" >
			<option value="0">CODIGO</option> 
			<?php while($idpst = mysqli_fetch_row($articulo)):?>                      
			<option value="<?php echo $idpst[0]?>"><?php echo $idpst[1]?></option>
			<?php endwhile; ?>
			</select>



	<script type="text/javascript">
        $(document).ready(function(){
			//$('#mprvedd').select2();

			$('#mprvedd3').change(function(){
				$.ajax({
					type:"post",
					data:'valor=' + $('#mprvedd3').val(),
					url:'session/',
					success:function(r){
					}
				});
			});
		});
        //funcion para BUSCAR EL ARTICULO
        function desartic4(){
            //alert("eentraarticulo")
            var codico =  document.getElementById('mprvedd3').value; 
            //alert(codico);
            $.ajax({
                url: '../controller/php/conprvart.php',
                type: 'POST'
            }).done(function(respuesta) {
                //alert(respuesta);
                obj = JSON.parse(respuesta);
                var res = obj.data;
                var x = 0; 
                for (D = 0; D < res.length; D++) { 
                    if (obj.data[D].codigo_proveedor == codico){
                        datos = 
                        obj.data[D].id_articulo + '*' +
                        obj.data[D].codigo_proveedor + '*' +
                        obj.data[D].descrip_proveedor + '*' +
                        obj.data[D].artcodigo;    
                        var o = datos.split("*");   
                        $("#mdecripprvvd3").val(o[2]);   

                        $("#mcodigotr3").val(o[3]);
                       // $('#mcodigotr').change();
                    }
                }
            });
            
        }
    </script>