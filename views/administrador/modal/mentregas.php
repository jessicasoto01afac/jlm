
<!-- MODAL PARA ELIMINAR VALE DE PRODUCCIÓN-->
<div class="modal fade" id='modal-deletevproduc'>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-x-20">
                <h4 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">ELIMINAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <p class="mg-b-5">ESTAS SEGURO DE ELIMINAR EL VALE DE PRODUCCIÓN?</p>
                <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="del_vproduct"
                    id="del_vproduct">
                <input disabled="" class="form-control inputalta" type="text" name="devaproduc" id="devaproduc">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" onclick="savedeprodu()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">ELIMINAR</button>
                <br>

            </div>
            <div style="display:none;" id="delerrvprv" name="delerrvprv" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un
                        ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->
