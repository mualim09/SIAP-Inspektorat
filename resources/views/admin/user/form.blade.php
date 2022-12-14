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
    #image_preview2{
      border: 1px solid black;
      padding: 10px;
    }

    #image_preview2 img{
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
            <h3 class="zheading-small text-muted mb-4">{{ __('Informasi tentang pegawai') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Nama Lengkap') }}</span>
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
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Jenis Kelamin') }}</span>
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
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Tempat/ Tanggal Lahir') }}</span>
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
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Informasi kontak') }}</span>
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
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Password') }}</span>
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
            /*$('#role-5').change(function() {
                if(this.checked) {
                    $('#jenis-auditor').show('fast');
                    $('#ruang-auditor').show('fast');
                }else{
                    $('#jenis-auditor').hide('fast');
                    $('input[name=jenis_auditor]').prop('checked', false);
                    $('#ruang-auditor').hide('fast');
                }
              });*/
        </script>

        <!-- <div class="form-group row" id="jenis-auditor" >
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
        </div> -->

        <div class="form-group row" id="ruang-auditor">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Ruang') }}</span>            
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

        <h3 class="zheading-small text-muted mb-4">{{ __('Informasi tentang Kepegawaian') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('NIP') }}</span>
            <div class="col-md-6">
                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" required placeholder="{{ __('Nomor Induk Pegawai (NIP)') }}">                
                    <span class="invalid-nip" permission="alert"></span>
                
            </div>            
        </div>

        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Informasi Jabatan') }}</span>
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

        <h3 class="zheading-small text-muted mb-4">{{ __('Informasi tentang pendidikan') }}</h3>
        <div class="form-group row">
            <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Pendidikan Terakhir') }}</span>
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
                <button type="submit" class="btn btn-primary offset-md-3 default-button">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalReupload2" aria-hidden="true" id="modalFormReuploadLaporan">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="col-10 modal-title text-center" id="myModalReupload2" style="font-size: 35px;">Form Input Sertifikat Tiap Auditor</h4>
            <button type="button" class="close" id="close_sertifikat" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('input_sertifikat') }}" method="POST" class="insert-sertifikat" enctype="multipart/form-data">
                <input type="hidden" name="userid" id="userid">
                @csrf
                <div class="form-group row">
                    <input type="file" class="form-control" name="file_sertifikat[]" id="file_sertifikat" multiple>
                    <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan sertifikat auditor, bisa menerima banyak sertifikat dalam sekali input. Max sertifikat file 2MB dengan format (jpg,png,jpeg)</small>
                </div>
                <br/>

                <h5 style="font-size: 16px;">Preview Sertifikat yg akan di inputkan :</h5>
                <div id="image_preview"></div>
                <br/>

                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalSertifikat" aria-hidden="true" id="modalPemeriksaan">
      <div class="modal-dialog modal-xl" style="max-width: 75%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="col-10 modal-title text-center" id="mySmallModalSertifikat" style="font-size: 35px; margin-left: 100px;">Lihat Sertifikat</h4>
            <button type="button" class="close" id="close-view-sertifikat" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
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
              </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalEditSertifikat" aria-hidden="true" id="modalFormEditSertifikat">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="col-10 modal-title text-center" id="myModalEditSertifikat" style="font-size: 35px;">Form Edit Sertifikat Tiap Auditor</h4>
            <button type="button" class="close" id="close_input_edit_sertifikat" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('save_edit_sertifikat')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_sertifikat" id="id_sertifikat">
                @csrf
                <div class="form-group row">
                    <input type="file" class="form-control" name="file_sertifikat2" id="file_sertifikat2" accept='image/*'>
                    <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan sertifikat auditor, hanya bisa menginputkan 1 file gambar. Max sertifikat file 2MB dengan format (jpg,png,jpeg)</small>
                </div>
                <br/>
                <div class="preview_img">
                    <h5 style="font-size: 16px;">Preview Sertifikat yg akan di inputkan :</h5>
                    <div id="image_preview2"></div>
                    <br/>
                </div>

                <button type="submit" class="btn btn-primary btn-sm preview_img"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form>
            <!-- <form action="{{route('save_edit_sertifikat')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_sertifikat" id="id_sertifikat">
                @csrf
                <div class="form-group row">
                    <input type="file" class="form-control" name="file_sertifikat2" id="file_sertifikat2" accept='image/*'>
                    <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan sertifikat auditor, hanya bisa menginputkan 1 file gambar. Max sertifikat file 2MB dengan format (jpg,png,jpeg)</small>
                </div>
                <br/>

                <h5 style="font-size: 16px;">Preview Sertifikat yg akan di inputkan :</h5>
                <div id="image_preview2"></div>
                <br/>

                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form> -->
          </div>
        </div>
      </div>
    </div>

</div>

<script type="text/javascript">

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