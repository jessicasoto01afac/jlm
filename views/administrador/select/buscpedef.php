<?php include ("../../controller/conexion.php");

      $sql = "SELECT refe_1 FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1 ORDER BY id_kax ASC";
      $pedidos = mysqli_query($conexion,$sql);
    ?>
<select class="form-control select2-show-search" multiple="multiple" data-placeholder="Elige un pedido relacionado"
    onchange="" id="pedidoensal" name="pedidoensal[]" type="text" data-live-search="true" style="width: 100%">
    <option value="0">Selecciona el pedido</option>
    <option value="STOCK">STOCK</option>
    <?php while($idped = mysqli_fetch_row($pedidos)):?>
    <option value="<?php echo $idped[0]?>"><?php echo $idped[0]?></option>
    <?php endwhile; ?>
</select>

<script type="text/javascript">
$(document).ready(function() {
    $('#pedidoensal').select2();
    $('#pedidoensal').change(function() {
        $.ajax({
            type: "post",
            data: 'valor=' + $('#pedidoensal').val(),
            url: 'session/',
            success: function(r) {}
        });
    });
});
</script>