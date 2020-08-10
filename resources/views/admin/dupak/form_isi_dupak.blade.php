<div class="modal fade " tabindex="-1" role="dialog" aria-hidden="true" id="modalFormIsiDupak">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalLabel">ISI DUPAK USER</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">        
        <form class="ajax-form" id="form-dupak-penunjang">
            <input type="hidden" name="user_id" id="user-id">
            <div class="form-group row">
                <label for="dupak_penunjang" class="col-sm-4 col-form-label">{{ __('Dupak Penunjang')}} </label>                
                <input type="text" name="dupak_penunjang" class="form-control-sm" placeholder="Format dupak (0.00)" id="dupak-penunjang">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <p>Form Isi Dupak hanya digunakan untuk update dupak penunjang, dan otomatis menjadi dupak penunjang baru. Sedangkan Dupak Pendidikan dan Dupak Utama secara otomatis terisi oleh sistem berdasarkan profil pendidikan dan jumlah SPT yang sudah dikerjakan.</p>
      </div>

    </div>
  </div>
</div>
