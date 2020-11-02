<form class="ajax-form" id="form-kode-temuan">
    <input type="hidden" name="id" id="id">
    <div class="form-group row">
      <span class="col-lg-4 col-form-label text-md-right">{{ __('Kode')}} </span>
      <div class="col-md-4">
        <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode" id="kode" required pattern="[A-Za-z1-9 ]">
      </div>
    </div>
    <div class="form-group row">
        <span class="col-lg-4 col-form-label text-md-right">{{ __('Deskripsi')}} </span>
        <div class="col">
          <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Kode Temuan" id="deskripsi" required pattern="[A-Za-z1-9 ]">
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
<script type="text/javascript">
    /*ajax selectize to get kelompok and sub kelompok*/
  var xhr;
  var select_kelompok, $select_kelompok;
  var select_sub, $select_sub;
  
  $select_kelompok = $('#kelompok').selectize({
    onChange: function(value) {
        
        if (!value.length) return;
        select_sub.disable();
        select_sub.clear();
        select_sub.clearOptions();
        select_sub.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ url("/admin/kode/get-sub-kelompok") }}' + '/' + value ,
                success: function(results) {
                    select_sub.enable();
                    console.log(results);
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

  $select_sub = $('#sub-kelompok').selectize({
    
    valueField: 'kode',
    labelField: ['select_deskripsi'],
    searchField: ['deskripsi'],
    allowEmptyOption: true
});


select_sub  = $select_sub[0].selectize;
select_kelompok = $select_kelompok[0].selectize;

select_sub.disable();

/*end selectize*/


/*Ajax form submit kode temuan*/
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#form-kode-temuan").validate({
        rules: {
            kode : {required: true, minlength: 1, maxlength: 5},
            deskripsi: {required: true, minlength: 10}
        },

        submitHandler: function(form){
            
            var id = $('#id').val();            
            save_method = (id == '') ? 'new' : save_method;
            base_url = "{{ url('admin/kode') }}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";
            

            $.ajax({
                url: url,
                type: type,
                data: $('#form-kode-temuan').serialize(),
                dataType: 'text',

                /*data: $('#spt-form').serialize(),*/
                success: function(data){                                        
                    $("#form-kode-temuan")[0].reset();
                   // console.log('success:', data);                    
                    select_sub.clear();
                    select_kelompok.clear();
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        }
    });
</script>
@push('css')
   <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush