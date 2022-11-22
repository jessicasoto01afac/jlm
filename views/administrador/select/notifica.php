
<select class="form-control select2-show-search" multiple="multiple" data-placeholder="Elige un pedido relacionado"
    onchange="" id="noticas" name="noticas[]" type="text" data-live-search="true" style="width: 100%">
    <option value="TELEFONO">TELEFONO</option>
    <option value="CORREO">CORREO</option>
    <option value="OTROS">OTROS</option>
</select>

<script type="text/javascript">
    
$(document).ready(function() {
    $('#noticas').select2();
});

</script>