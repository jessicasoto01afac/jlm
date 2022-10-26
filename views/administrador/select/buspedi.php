<?php include ("../../controller/conexion.php");

      $sql = "SELECT refe_1 FROM kardex where estado='0' AND tipo ='PEDIDO' AND status='PENDIENTE' AND status='AUTORIZADOS' GROUP BY refe_1 ORDER BY id_kax ASC";
      $pedidos = mysqli_query($conexion,$sql);
    ?>
<select class="form-control select2-show-search" multiple="multiple" data-placeholder="Elige un pedido relacionado"
    onchange="" id="pedidomem" name="pedidomem[]" type="text" data-live-search="true" style="width: 100%">
    <option value="0">Selecciona el pedido</option>
    <option value="STOCK">STOCK</option>
    <?php while($idped = mysqli_fetch_row($pedidos)):?>
    <option value="<?php echo $idped[0]?>"><?php echo $idped[0]?></option>
    <?php endwhile; ?>
</select>

<script type="text/javascript">
$(document).ready(function() {
    $('#pedidomem').select2();
    $('#pedidomem').change(function() {
        $.ajax({
            type: "post",
            data: 'valor=' + $('#pedidomem').val(),
            url: 'session/',
            success: function(r) {}
        });
    });
});
//funcion para BUSCAR EL ARTICULO
function desartic() {
    //alert("eentraarticulo")
    //var codivo = document.getElementById('pedidomem').value; 
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == codivo) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#vdescrip").val(o[1]);
                $("#vdepart").val(o[2]);
            }
        }
    });
}
</script>