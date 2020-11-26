<form id="form-cari-dupak">
  @hasanyrole('Super Admin|TU Perencanaan|TU Umum')
  <!-- hanya ditampilkan kepada user yang memiliki role super admin, perencanaan, dan umum. -->
  <div class="form-row mb-2">
      <div class="col-md-9">
        <select class="form-control selectize" id="user-id" name="user_id" placeholder="Nama Auditor"></select>
      </div>
  </div>
  <script type="text/javascript">
    $('#user-id').selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: [],
        create: false,
        load: function(query, callback){
          if (!query.length) return callback();
          $.ajax({
              url: "{{ route('get_auditor') }}",
              type: 'GET',
              dataType: 'json',
              data:{name:query},

              error: function(err) {
                callback();
              },
              success: function(result) {
                callback(result);
               }
            });
        },
    });
  </script>
  @endhasanyrole

  <div class="form-row">
    <div class="col-md-6">
        <select class="form-control selectize" id="semester" name="semester">
            <option value="" selected disabled>Periode Semester</option>
            <option value="1">Januari s.d Juni</option>
            <option value="2">Juli s.d Desember</option>
        </select>
    </div>
    <div class="col-md-3">
      <input type="text" class="form-control" name="tahun" id="tahun" autocomplete="off" placeholder="{{ __('Tahun')}}" value="{{date('Y')}}">
    </div>
    <div class="col">
        <button class="btn btn-primary" id="cari-dupak">Cari</button>
    </div>
  </div>
</form>