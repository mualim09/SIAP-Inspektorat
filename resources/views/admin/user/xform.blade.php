<style type="text/css">
    input[type=file]{

      display: inline;

    }

    #image_preview{

      border: 1px solid black;

      padding: 10px;

    }

    #image_preview img{

      width: 200px;

      padding: 5px;

    }
</style>

<div class="col-md-12 user-form">
    <div class="invalid-feedback" permission="alert">
        
    </div>
    <!-- <form action="/admin/users" method="POST" > -->
    <form id="user-form" class="ajax-form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        @csrf
            <h3 class="heading-small text-muted mb-4">{{ __('Informasi tentang pegawai') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Nama Lengkap') }}</span>
            <div class="col-md-3">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus placeholder="{{ __('Nama Depan') }}">

                @error('first_name')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Nama Belakang') }}">

                @error('last_name')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-2">
                <input id="gelar" type="text" class="form-control @error('gelar') is-invalid @enderror" name="gelar" value="{{ old('gelar') }}" placeholder="{{ __('Gelar') }}">

                @error('gelar')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</span>
            <div class="col-md-10 row">
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="radio" name="sex" value="Laki-laki" id="Laki-laki" class="custom-control-input">
                        <label for="Laki-laki" class="custom-control-label">Laki-laki</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="radio" name="sex" value="Perempuan" id="Perempuan" class="custom-control-input">
                        <label for="Perempuan" class="custom-control-label">Perempuan</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Tempat/ Tanggal Lahir') }}</span>
            <div class="col-md-3">
                <input id="tempat-lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" placeholder="{{ __('Tempat Lahir') }}">

                @error('tempat_lahir')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control datepick" name="tanggal_lahir" id="tanggal-lahir" autocomplete="off" placeholder="{{ __('Tanggal Lahir')}}" data-date-format="dd-mm-yyyy">

                @error('tanggal_lahir')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Informasi kontak') }}</span>
            <div class="col-md-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="{{ __('Email') }}">

                @error('email')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="{{ __('Phone') }}">

                @error('phone')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</span>
            <div class="col-md-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('Password') }}">

                @error('password')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-3">
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="{{ __('Password confirmation') }}">

                @error('password_confirmation')
                    <span class="invalid-feedback" permission="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <span class="col-md-2 text-md-right">{{ __('Role') }}</span>
            <div class="col-md-10 row">
                @foreach($roles as $role)
                <div class="col">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{$role->id}}" class="custom-control-input">
                        <label for="role-{{ $role->id }}" class="custom-control-label">{{ $role->name }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <script type="text/javascript">
            //#role-5 is role id for auditor. see role table
            $('#role-5').change(function() {
                if(this.checked) {
                    $('#jenis-auditor').show('fast');
                    $('#ruang-auditor').show('fast');
                }else{
                    $('#jenis-auditor').hide('fast');
                    $('input[name=jenis_auditor]').prop('checked', false);
                    $('#ruang-auditor').hide('fast');
                }
              });
        </script>

        <div class="form-group row" id="jenis-auditor" style="display:none">
            <span class="col-md-2 text-md-right">{{ __('Jenis Auditor') }}</span>
            <div class="col-md-10 row">
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="radio" name="jenis_auditor" value="terampil" id="auditor-terampil" class="custom-control-input">
                        <label for="auditor-terampil" class="custom-control-label">Auditor Terampil</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="radio" name="jenis_auditor" value="ahli" id="auditor-ahli" class="custom-control-input">
                        <label for="auditor-ahli" class="custom-control-label">Auditor Ahli</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row" id="ruang-auditor" style="display:none">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Ruang') }}</span>            
            <div class="col-md-3">
                <select class="form-control selectize" id="nama-ruang" name="ruang[nama]">
                    <option value="">{{ __('Pilih Ruang Auditor') }}</option>
                    @foreach($listRuang as $ruang)
                    <option class="form-control" value="{{$ruang}}" >{{ $ruang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control selectize" id="jabatan-ruang" name="ruang[jabatan]">
                    <option value="">{{ __('Pilih Jabatan Ruang Auditor') }}</option>
                    @foreach($listJabatanRuang as $jabatanRuang)
                    <option class="form-control" value="{{$jabatanRuang}}" >{{ $jabatanRuang }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h3 class="heading-small text-muted mb-4">{{ __('Informasi tentang Kepegawaian') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('NIP') }}</span>
            <div class="col-md-6">
                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" required placeholder="{{ __('Nomor Induk Pegawai (NIP)') }}">                
                    <span class="invalid-nip" permission="alert"></span>
                
            </div>            
        </div>

        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Informasi Jabatan') }}</span>
            <div class="col-md-3">
                <select class="form-control selectize" id="jabatan" name="jabatan">
                    <option value="">{{ __('Pilih Jabatan') }}</option>
                    @foreach($listJabatan as $jabatan)
                    <option class="form-control" value="{{$jabatan}}" >{{ $jabatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control selectize" id="pangkat" name="pangkat">
                    <option value="">{{ __('Pilih Pangkat') }}</option>
                    @foreach($listPangkat as $pangkat)
                    <option class="form-control" value="{{$pangkat}}" >{{ $pangkat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <h3 class="heading-small text-muted mb-4">{{ __('Informasi tentang pendidikan') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right">{{ __('Pendidikan Terakhir') }}</span>
            <div class="col-md-2">
                <input type="text" id="tahun-pendidikan" name="pendidikan[tahun]" class="form-control" placeholder="{{ __('Tahun') }}">
            </div>
            <div class="col-md-3">
                <select class="form-control selectize" id="tingkat-pendidikan" name="pendidikan[tingkat]">
                    <option value="">{{ __('Pilih Pendidikan Terakhir') }}</option>
                    @foreach($listPendidikan as $pendidikan)
                    <option class="form-control" value="{{$pendidikan}}" >{{ $pendidikan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input id="jurusan-pendidikan" type="text" class="form-control @error('jurusan') is-invalid @enderror" name="pendidikan[jurusan]" placeholder="{{ __('Jurusan') }}">                
                    <span class="invalid-jurusan" permission="alert"></span>
                
            </div>
        </div>

       

        <div class="form-group">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary offset-md-3">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalReupload2" aria-hidden="true" id="modalFormReuploadLaporan">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalReupload2">Form Input Sertifikat Tiap Auditor</h4>
            <button type="button" class="close" id="close_sertifikat" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="/input/sertifikat-auditor" method="POST" class="insert-sertifikat" enctype="multipart/form-data">
                <input type="hidden" name="userid" id="userid">
                @csrf
                <div class="form-group row">
                    <input type="file" class="form-control" name="file_sertifikat[]" id="file_sertifikat" multiple>
                    <small class="form-text text-muted">Silahkan masukkan sertifikat auditor, bisa menerima banyak sertifikat dalam sekali input. Max sertifikat file 2MB dengan format (jpg,png,jpeg)</small>
                </div>
                <br/>

                <h5>Preview Sertifikat yg akan di inputkan :</h5>
                <div id="image_preview"></div>
                <br/>

                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="modalPemeriksaan">
      <div class="modal-dialog modal-xl" style="max-width: 75%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mySmallModalPemeriksaan">Pemeriksaan</h4>
            <button type="button" class="close" id="close-view-sertifikat" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-header">
                Sertifikat $data->full_name
              </div>
              <div class="card-body table-responsive">
                
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner" id="carousel-container">
                    
                  
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

                <!-- <h5>foto2</h5>
                <div id="image_previews"></div> -->
              </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

<script type="text/javascript">
  
    //show modal input sertifikat
    function insertSertifikat(id){
        $('#modalFormReuploadLaporan').modal('show');
        $('.insert-sertifikat')[0].reset();
        $('#userid').val(id);

    }

    //menampulkan preview sertifikat
    $("#file_sertifikat").change(function(){

         $('#image_preview').html("");

         var total_file=document.getElementById("file_sertifikat").files.length;

         for(var i=0;i<total_file;i++)
         {

          $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");

         }
      });

    //fungsi ketika mengeklik close pada input sertifikat maka akan mereset modal.
    $('#close_sertifikat').on('click', function(){
            document.getElementById("image_preview").innerHTML = "";
    });


    function showModalLihatSertifikat(id){        
        var site_url = "../";
        var url = "/getdata/sertifikat-auditor/" +id ;

        $.ajax({
            url:url,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){

                data.forEach(function (val,i){
                    // console.log('value :'+val.id+' /i :'+i);
                    var img = site_url+val.file_sertifikat; 
                    var id_img = val.id;
                    var active = (i==0) ? 'active' : '';
                    var html = $('<div class="carousel-item '+active+'"><img src="'+img+'" /><br><button href=# class="btn btn-danger">Delete Sertifiakat</button></div>');
                    html.appendTo('#carousel-container');
                });


            }
        });

        $('#modalPemeriksaan').modal('show');

        $('#close-view-sertifikat').on('click', function(){
                document.getElementById("carousel-container").innerHTML = "";
        });
        
    }


    $('#tanggal-lahir').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
    }); 
  $('#jabatan').selectize({    
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Jabatan Pegawai',
   create: false,
   onchange: function(value){
    
   },
  });
  $('#pangkat').selectize({    
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Pangkat Pegawai',
   create: false,
   onchange: function(value){
    
   },
  });
  $('#tingkat-pendidikan').selectize({    
   /*sortField: 'text',*/
   allowEmptyOption: false,
   placeholder: 'Tingkat Pendidikan',
   create: false,
   onchange: function(value){
    
   },
  });
</script>

@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script> -->
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush