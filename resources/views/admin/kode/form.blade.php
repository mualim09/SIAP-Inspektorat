<form class="ajax-form" id="form-kode-temuan">
    <input type="hidden" name="id" id="id">
    <div class="form-group row">
      <span class="col-lg-4 col-form-label text-md-right">{{ __('Kode')}} </span>
      <div class="col-md-4">
        <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode" id="kode" required>
      </div>
    </div>
    <div class="form-group row">
        <span class="col-lg-4 col-form-label text-md-right">{{ __('Deskripsi')}} </span>
        <div class="col">
          <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Kode Temuan" id="deskripsi" required>
        </div>
    </div>
    <div class="form-group row">
        <span class="col-lg-4 col-form-label text-md-right">{{ __('Kelompok')}} </span>
        <div class="col">
          <select class="form-control selectize" id="kelompok" name="atribut[kelompok]" aria-describedby="kelompokKode">
              <option value="">{{ __('Pilih Kelompok') }}</option>              
              @foreach($kelompok as $kel)
                <option class="form-control selectize" value="{{$kel->kode}}" ><strong>{{$kel->kode}}. </strong>{{ $kel->deskripsi }}</option>
              @endforeach
          </select>
          <small id="kelompokKode" class="form-text text-muted">Kosongi jika ingin menambahkan <strong>kelompok utama.</strong></small>
        </div>
    </div>
    <div class="form-group row">
        <span class="col-lg-4 col-form-label text-md-right">{{ __('Sub Kelompok')}} </span>
        <div class="col">
          <select class="form-control selectize" id="sub-kelompok" name="atribut[subkelompok]" aria-describedby="subKelompokKode">             
          </select>
          <small id="subKelompokKode" class="form-text text-muted">Kosongi jika ingin menambahkan <strong>sub kelompok</strong></small>
        </div>
    </div>
    <!-- <div id="select-kode-container">
      <a href="#" id="link-pilih">Pilih Kode Temuan</a>
    </div>
<script type="text/javascript">
  $( "#link-pilih" ).on('click',function() {
        $.ajax({
            url: '{{ url("/admin/kode/select/") }}',
            success: function(results) {
                $('#select-kode-container').html(results);
                $('#link-pilih').hide();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script> -->

    <div class="form-group">
      <div class="col">
          <button type="submit" class="btn btn-primary offset-md-3">
                {{ __('Submit') }}
            </button>
        </div>
    </div>
</form>
@push('css')
   <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush