@extends('layouts.backend', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])

    <div class="container-fluid mt--7 bg-color" style="padding-top: 45px;">
        <breadcrumb list-classes="breadcrumb-links">
          <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item> 
          <breadcrumb-item>/ {{ auth()->user()->full_name }}</breadcrumb-item> 
          <breadcrumb-item active>/ My Profil</a></breadcrumb-item>
        </breadcrumb>
        <div class="row">
            <div class="col-xl-5 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    @include('profile.pic')
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                       <!--  <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div> -->
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <!-- <div>
                                        <span class="heading">22</span>
                                        <span class="description">{{ __('Friends') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">{{ __('Photos') }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{auth()->user()->full_name}}{{auth()->user()->gelar}}
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>
                                @hasanyrole('Super Admin|Auditor')
                                Auditor
                                @endhasanyrole 
                                {{ auth()->user()->jenis_auditor }}
                            </div>
                            
                            <hr class="my-4" />

                           <div class="card-body row">
                                <div class="mb-2 mb-md-0">                    
                                    <a href="#" title="Input Sertifikat" data-id="{{auth()->user()->id}}" class="btn btn-primary" id="showFormInput"><i class="ni ni-paper-diploma"></i> Input SertifikatKu</a>
                                </div>  
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm ajax-table" id="sertifikat-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                    <p>Jika Tombol berwarna pudar tanda bahwa pengguna tidak mengizinkan anda untuk mengakses data tersebut</p>
                                </div>
                            </div>

                            <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalSertifikat" aria-hidden="true" id="modalPemeriksaan">
                              <div class="modal-dialog modal-xl" style="max-width: 75%;">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="col-10 modal-title text-center" id="mySmallModalSertifikat" style="font-size: 35px; margin-left: 100px;">SertifikatKu</h4>
                                    <button type="button" class="close" id="close-view-sertifikat" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="card">
                                      <div class="card-body table-responsive">
                                        
                                        <img id="img-content" src="" />
                                      </div>
                                      <div class="butt">
                                        <button type="button" class="btn btn-outline-success edited-sertifikat"><i class="ni ni-tag"></i> Edit</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalEditSertifikat" aria-hidden="true" id="modalFormEditSertifikatbyUser">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="col-10 modal-title text-center" id="myModalEditSertifikat" style="font-size: 35px;">Form Edit Sertifikat Tiap Auditor</h4>
                                    <button type="button" class="close" id="close_input_edit_sertifikat" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/edit/sertifikatAuditor" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_sertifikat" id="id_sertifikat">
                                        @csrf
                                        <div class="form-group row">
                                            <input type="file" class="form-control" name="file_sertifikat2" id="file_sertifikat2">
                                            <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan sertifikat auditor, hanya bisa menginputkan 1 file gambar. Max sertifikat file 2MB dengan format (jpg,png,jpeg)</small>
                                        </div>
                                        <br/>
                                        <div class="preview_img">
                                            <h5 style="font-size: 16px;">Preview Sertifikat yg akan di inputkan :</h5>
                                            <div id="image_preview3"></div>
                                            <br/>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm preview_img"><i class="fa fa-save"></i><span>Simpan</span></button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalInputSertifikatByAuditor" aria-hidden="true" id="inputSertifikatKu">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="col-10 modal-title text-center" id="myModalInputSertifikatByAuditor" style="font-size: 35px;">Form Input Sertifikat Ku</h4>
                                    <button type="button" class="close" id="close_sertifikat" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="{{ route('input_sertifikat') }}" method="POST" class="insert-sertifikat" enctype="multipart/form-data">
                                        <input type="hidden" name="userid" id="userid">
                                        @csrf
                                        <div class="form-group row">
                                            <input type="file" class="form-control" name="file_sertifikat[]" id="file_sertifikat" multiple required="">
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

                        </div>
                    </div>
                </div>
            </div>
            @include('profile.form')
        </div>
        
    </div>
    <script type="text/javascript">
        $(".ajax-form").validate({
            rules: {
                first_name : {required: true, minlength: 3},
                last_name : {required: true, minlength: 3},
                email : {required: true, email:true},
                address : { minlength: 6}
            },
            submitHandler: function(form){
                /*form.preventDefault();*/
                var id = $('#id').val();
                base_url = "profile";
                url =  (id == '') ? base_url : base_url + '/' + id ;
                type = (id == '') ? "POST" : "PUT";
                

                $.ajax({
                    url: url,
                    type: type,
                    data: $('.ajax-form').serialize(),
                    success: function(data){
                        console.log(data);
                        $('.ajax-form')[0].reset();
                        $('#user_id').val(data.user_id);
                        $('#id').val(data.id);
                        $('#address').val(data.address);
                        $('#country').val(data.country);
                        $('#city').val(data.city);
                        $('#zipcode').val(data.zipcode);
                        /*$.alert('Profile updated!')*/
                        $.alert({
                            title: 'Alert!',
                            content: 'Profile updated!',
                            confirm: function(){
                                if (type == 'POST'){ window.location.reload(true); }
                            }
                        });
                    },
                    error: function(data){
                        console.log('Error:', $data);
                    }
                });
            }
        });

    var table = $('#sertifikat-table').DataTable({        
        'pageLength': 25,
        dom: 'rt<"col-sm-14 row"l<"col"p>>',
        "searching": false,
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' ,
            },
        },
        
        "opts": {
          "theme": "bootstrap",
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route("getSertifikat") }}',
        /*deferRender: true,*/
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false
            },
            {data: 'nama_sertifikat', name: 'nama_sertifikat', 'title': "{{ __('Nama File Sertifikat') }}"},
            {data: 'created_at', name: 'created_at', 'title': "{{ __('Tanggal Upload') }}"},
            {data: 'name', name: 'name', 'title': "{{ __('Nama Pengupload') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Aksi') }}"},
        ],
            columnDefs: [             
              { "width": "150px", "targets": 3 },
              { "searchable": false, "orderable": false, "targets": 0 },            
            ],
        "order": [[ 1, 'asc' ]],
    });

    var table = $('#user-lihat-table').DataTable({   
            language: {
                paginate: {
                  next: '&lt;', 
                  previous: '&gt;'  
                }
            },
            processing: true,
            serverSide: true,
            deferRender: true,
            ajax: '{{ route("getDataPegawai") }}',
            columns: [
                {
                    'defaultContent' : '',
                    'data'           : 'DT_RowIndex',
                    'name'           : 'DT_RowIndex',
                    'title'          : 'No',
                    'render'         : null,
                    'orderable'      : false,
                    'searchable'     : false,
                    'exportable'     : false,
                    'printable'      : true,
                    'footer'         : '',
                },
                {data: 'nip', name: 'nip', 'title': "{{ __('NIP') }}"},
                {data: 'full_name', name: 'full_name', 'title': "{{ __('Nama Lengkap') }}"},
                {data: 'phone', name: 'phone', 'title': "{{ __('Telp') }}"},
                {data: 'jabatan', name: 'jabatan', 'title': "{{ __('Jabatan') }}"},
                {data: 'ruang', name: 'ruang', 'title': "{{ __('Ruang') }}"},
                // {data: 'jabatan_ruang', name: 'jabatan_ruang', 'title': "{{ __('Jabatan') }}"},
            ],
            columnDefs: [             
                  { "width": "150px", "targets": 3 },
                  { "searchable": false, "orderable": false, "targets": 0 },            
                ],
            "order": [[ 1, 'asc' ]],
            
        });

    //show sertifikat per auditor
    function showModalLihatSertifikatbyUser(id){        
        $('#modalPemeriksaan').modal('show');
        $('.edited-sertifikat').val(id);
        //var url_prefix = (window.location.pathname == '/admin/sertifikat/myprofile');
        // var get_detail = url_prefix ? "admin/kka/getdata_detail/"+id : "/kka/getdata_detail/"+id;
        var site_url = "/";
        var url = (window.location.pathname == '/admin/sertifikat/myprofile') ? "/admin/sertifikat/myprofile/getDataSertifikatBy/"+id : "/sertifikat/myprofile/getDataSertifikatBy/"+id;
        // console.log(window.location.pathname);

        $.ajax({
            url:url,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                data.forEach(function (val,i){
                    var src = site_url+val.file_sertifikat;
                    $("#img-content").attr("src", src);
                });

                $("#img-content").css({'width': '100%'});

                $('#hapus-sertifkat').on('click', function(){ //ketika button delete di klik maka akan menjalan kan menghapus sertifikat
                    var id = $(this).attr("value");
                    var url_delete = (window.location.pathname == '/admin/sertifikat/myprofile') ? "/admin/sertifikat/myprofile/delete/sertifikatAuditor/"+id : "/sertifikat/myprofile/delete/sertifikatAuditor/"+id;
                    $.confirm({
                        title: "{{ __('Hapus data sertifikat ini?') }}",
                        content: "{{ __('Menghapus data sertifikat akan menghilangkan data sertifikat?') }}",
                        buttons: {
                            delete: {
                                btnClass: 'btn-danger',
                                action: function(){                       
                                    url = url_delete;
                                    $.ajax({
                                        url: url,
                                        type: "GET",                
                                        data: { id },
                                        success: function(data){
                                            console.log(data);
                                            // document.getElementById("img-content").innerHTML = "";
                                            $('#modalPemeriksaan').modal('toggle');
                                        }
                                    });
                                },
                            },
                            cancel: function(){
                                $.alert('Dibatalkan!');
                            }
                        }
                    });    
                });

                $('.edited-sertifikat').on('click', function(){
                    var id = $(this).attr("value");
                    $('#modalPemeriksaan').modal("hide");
                    $('#modalFormEditSertifikatbyUser').modal('show');
                    $('#id_sertifikat').val(id);
                    // popup modal
                    console.log(id);
                })

                $("#file_sertifikat2").change(function(){
                   $('#image_preview3').html("");
                   var total_file=document.getElementById("file_sertifikat2").files.length;
                   for(var i=0;i<total_file;i++)
                   {
                    $('#image_preview3').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
                   }
                });

                $('#close_input_edit_sertifikat').on('click', function(){
                        document.getElementById("image_preview3").innerHTML = "";
                });
            }
        });
    }

    function hapus_sertifkat(id){   /*modal belum bisa menghapus cache pada modal*/
        $.confirm({
            title: "{{ __('Hapus data sertifikat ini?') }}",
            content: "{{ __('Menghapus data sertifikat akan menghilangkan data sertifikat?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        var url_delete = (window.location.pathname == '/admin/sertifikat/myprofile') ? "/admin/sertifikat/myprofile/delete/sertifikatAuditor/"+id : "/sertifikat/myprofile/delete/sertifikatAuditor/"+id;
                        url = url_delete;
                        $.ajax({
                            url: url,
                            type: "GET",                
                            data: { id },
                            success: function(data){
                                console.log('berhasil dihapus');
                                // table.ajax.reload();
                                $('#sertifikat-table').DataTable().ajax.reload();
                                document.getElementById("image_preview").innerHTML = "";
                                // $('#modalwindow').modal('hide');
                                 //note masih belum bisa menghapus cache pada modal
                                // $('#modalPemeriksaan .modal-content').empty();
                            }
                        });
                    },
                },
                cancel: function(){
        $.alert('Dibatalkan!');
                }
            }
        });
    };

    //show modal input sertifikat
    $( "#showFormInput" ).click(function() {
        $('#inputSertifikatKu').modal('show');
        $('.insert-sertifikat')[0].reset();
        var id = $(this).data('id');
        $('#userid').val(id);

    });

    //menampulkan preview sertifikat sebelum di inputkat
    $("#file_sertifikat").change(function(){
         $('#image_preview').html("");
         var total_file=document.getElementById("file_sertifikat").files.length;
         for(var i=0;i<total_file;i++)
         {
          $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
         }
      });

    //fungsi onclick close pada input sertifikat maka akan mereset preview sertifikat yg sebelum di inputkat di modal.
    $('#close_sertifikat').on('click', function(){
            document.getElementById("image_preview").innerHTML = "";
    });

    </script>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">   
@endpush

@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush