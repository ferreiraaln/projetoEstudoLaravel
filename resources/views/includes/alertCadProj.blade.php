<div id="modal-alert" style="display: block;" class="modal  bacx-mod" tabindex="-1" role="dialog" aria-labelledby="" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #fff;">
       <h3 class="modal-title" id="exampleModalCenterTitle">Alerta</h3>
       <button type="button" class="close" id="closed"  data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" >×</span>
      </button>
    </div>
    <div class="modal-body" >
      <p>{{ Session::get('message') }}</p>
    </div>
  </div>
</div>
</div>