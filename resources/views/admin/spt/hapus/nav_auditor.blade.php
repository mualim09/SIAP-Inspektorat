         @section('tab_content_auditor')
            <li class="nav-item">
              <a class="nav-link active" href="#home-tab" role="tab" aria-controls="home-tab" aria-selected="true">Progress</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="#semua-tab" role="tab" aria-controls="semua-tab" aria-selected="false">Semua</a>
            </li>
        @endsection

      @section('table_auditor')
      <div class="card-body table-responsive">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane active" id="home-tab" role="tabpanel">
            <div class="table-responsive">
                <table id="tabel_kka" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            <div class="table-responsive">
                <div class="tab-pane" id="semua-tab" role="tabpanel" aria-labelledby="semua-tab">
                  
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="modalPemeriksaan">
      <div class="modal-dialog modal-xl" style="max-width: 75%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mySmallModalPemeriksaan">Data Temuan Per Auditor Dari SPT yg sama</h4>
            <button type="button" class="close" id="close-modalData-pemeriksaan" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body table-responsive">
                <div class="text">
                    <a href="#" class="btn btn-success btn-xs" style="display: none;" id="unggah">Unggah</a>
                    <a href="#" class="btn btn-primary btn-xs cetak" style="display: none;" id="nhp">Cetak NHP</a>
                    <a href="#" class="btn btn-warning btn-xs" id="revisi" style="display: none;">Revisi</a>
                    <a href="#" class="btn btn-success btn-xs" id="menyetujui" style="display: none;">Menyetujui</a>
                </div>
                <div class="table-responsive">
                    <table id="dataKKA-perAuditor" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                        <thead></thead>
                        <tbody></tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="shotModalEditKKA">
      <div class="modal-dialog modal-xl" style="max-width: 50%;">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4 class="modal-title" id="mySmallModalPemeriksaan">Form Edit KKA</h4>
            <button type="button" class="close" id="close-modalData" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-body table-responsive">
                <div class="text">
                </div>
                <div class="table-responsive">
                    <div class="col-md-12 role-form">
                        <form id="edit-kka-form" class="ajax-form needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="edit_kka" value="edit_kka">
                            <input type="hidden" name="detai_spt_id" id=detail_id>
                            <!-- nav_auditor_submit
                            get -->
                            <div class="row">
                                <div class="col-md-6">
                                <label class="col-4 col-form-label">{{ __('Nama SPT') }}</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama_spt" name="nama_spt" placeholder="nama spt" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <label class="col-4 col-form-label">{{ __('Nomor SPT') }}</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nomor_spt" name="nomor_spt" placeholder="Nomor spt" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <!-- <label class="col-4 col-form-label">{{ __('Kode Temuan') }}</label> -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="kode_temuan" name="file_laporan[kode_temuan_id]" placeholder="Kode Temuan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <!-- <label class="col-4 col-form-label">{{ __('Sasaran Audit') }}</label> -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="sasaran_audit" name="file_laporan[sasaran_audit]" placeholder="Sasaran Audit" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- <label class="col-4 col-form-label">{{ __('Judul Temuan') }}</label> -->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="judultemuan" name="file_laporan[judultemuan]" placeholder="Judul Temuan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- <label class="col-4 col-form-label">{{ __('Kondisi') }}</label> -->
                                    <div class="form-group">
                                        <textarea type="textarea" class="form-control" id="summernote-kondisi" name="file_laporan[kondisi]" placeholder="Kondisi"></textarea> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <!-- <label class="col-4 col-form-label">{{ __('Kriteria') }}</label> -->
                                    <div class="form-group">
                                        <textarea type="textarea" class="form-control" id="summernote-kriteria" name="file_laporan[kriteria]" placeholder="Kriteria"></textarea> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                               <div class="col-md-8" style="margin-left: 208px;">
                                    <button type="submit" class="btn btn-primary offset-md-8 default-button">
                                        {{ __('Submit') }}
                                    </button>
                               </div>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endsection
    
@section('js_nav_auditor')
<script type="text/javascript">

    //summernote
    $('#summernote-kondisi').summernote({
        placeholder: 'Kondisi',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    $('#summernote-kriteria').summernote({
        placeholder: 'Kriteria',
        tabsize: 2,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['picture', 'hr']],
            ['view', ['fullscreen']]
        ]
    });

    //jika message ini muncul maka logika kondisi pada button error atau salah
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

    /*datatable setup*/
    
    var table = $('#tabel_kka').DataTable({        
        'pageLength': 50,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' 
            }
        },
        "opts": {
          "theme": "bootstrap",
        },
        processing: true,
        serverSide: true,
        ajax: '{{ url("spt/myspt") }}',
        deferRender: true,
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
            {data: 'lokasi', name: 'lokasi', 'title': "{{ __('Lokasi') }}"},
            {data: 'lama_detail', name: 'lama_detail', title: 'lama (jam)'},
            {data: 'status', name: 'status', title: 'Status'},
            {data: 'ketuaTim', name: 'ketuaTim', title: 'Ketua Tim'},
            {data: 'pengendaliTeknis', name: 'pengendaliTeknis', title: 'Pengendali Teknis'},
            {data: 'pengendaliMutu', name: 'pengendaliMutu', title: 'Pengendali Mutu'},
            {data: 'dupak', name: 'dupak', 'title': "{{ __('Dupak') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

    // function showModalPemeriksaan(id){
    //     $('#modalPemeriksaan').modal('show');
    //     console.log('yuhuu');
    //     var url = "getDataTemuan_per_auditor";
    //     var tabelPemeriksaan = $('#uploadLaporan-spt').DataTable({
    //         retrieve: true,
    //         paging: false,
    //         ajax : url,
    //         type: "GET",
    //         dataType: "JSON",
    //         columns: [
    //             {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
    //             },
    //             {data: 'nomor', name: 'nomor', title: 'Nomor SPT'},
    //             {data: 'name', name: 'name', title: 'Nama SPT'},
    //             {data: 'lokasi', name: 'lokasi', title: 'Lokasi'},
    //             {data: 'nama', name: 'nama', title: 'Nama Auditor'},
    //             {data: 'kode', name: 'kode', title: 'Kode Temuan'},
    //             {data: 'jenislaporan', name: 'jenislaporan', title: 'Status Laporan'},
    //             {data: 'filename', name: 'filename', title: 'Nama File Upload'},
    //             {data: 'note', name: 'note', title:'Catatan'},
    //             {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
    //         ],        
    //         "order": [[ 1, 'asc' ]],
    //     })

    //     $('#close-pemeriksaan').on('click', function(){
    //         tabelPemeriksaan.destroy();
    //         $('#uploadLaporan-spt').empty();
    //     });
    // }

    function sign(user_id){
        var id = user_id;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var status = {!! json_encode((array)auth()->user()->id) !!};      
        $.ajax({
            url : '/verifikasi/status',
            type: 'POST',
            data: {id:id, '_token' : csrf_token, status:status},
            success : function(data){
                console.log('success:',data);
                $('#uploadLaporan-spt').DataTable().ajax.reload();
            },
            error: function(error){
                console.log('Error:', error);
            }
        });
    }

    function showRejectFormModal(user_id){
        $('#modalFormCatatanLaporan2').modal('show');
        $('#laporan-id2').val(user_id);
    }

    $('#form-note2').submit(function(event){
            event.preventDefault();
            var form = $(this);
            var id = $('#laporan-id2').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var status = {!! json_encode((array)auth()->user()->id) !!};   
            var note = $('#note').val();
            $.ajax({
                url: '/verifikasi/status',
                type: 'post',
                data: {id:id, status:status, '_token' : csrf_token, note:note},
                success: function(data){                    
                    console.log('success:',data);
                    $('#modalFormCatatanLaporan2').modal('hide');
                    $('#uploadLaporan-spt').DataTable().ajax.reload();
                    form[0].reset();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        });

    function showModalLihatSertifikat(id){        
        $('#modalPemeriksaan').modal('show');
        // console.log(id);

        // url get data
        var get_detail = "/getdata_detail/" +id;
        var kka_view = "/spt/myspt/"+id;

        // get id user_log
        var user_id = {!! auth()->user()->id !!};

        // proses seleksi ajax button
        $.ajax({
            url:get_detail,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                for (var i = 0; i < data.length; i++) {
                    // console.log(data[i].status == null && data[i].peran == 'Ketua Tim' && data[i].user_id == user_id);

                    // kondisi jika ketua tim akan mengunggah KKA yang sudah diupload
                    if (data[i].status == null && data[i].user_id == user_id && data[i].peran == 'Ketua Tim'){ //ketua tim telah acc kka
                        // button_unggah.style.display = 'block';
                        $('#unggah').show();
                        $('#revisi').hide();
                        $('#menyetujui').hide();
                    }
                    else if (data[i].status != null && data[i].user_id == user_id && data[i].peran == 'Ketua Tim' ) { //cetak kka
                        // console.log(data[i].status == null)
                        $('#nhp').show();
                        $('#unggah').hide();
                        $('#revisi').hide();
                        $('#menyetujui').hide();
                    }
                    else if (data[i].status != true  && data[i].user_id == user_id && data[i].peran == 'Pengendali Teknis') { //pengendali teknis telah acc kka
                        $('#menyetujui').show();// jika dalnis merevisi kka & berstatus revisi maka button menyetuji akan hide
                        // if(data[i].status != null){
                        //     // $('#menyetujui').hide(); 
                        // }else{
                        //     $('#menyetujui').show();
                        // }
                    }
                    else if (data[i].status != true  && data[i].user_id == user_id && data[i].peran == 'Pengendali Mutu') { //pengendali mutu telah acc kka
                        $('#unggah').hide();
                        // $('#revisi').show();
                        $('#menyetujui').show();
                    }
                }

                $('#unggah').click(function(){
                    $.confirm({
                        title: "{{ __('Perhatian!') }}",
                        content: "{{ __('Apakah anda ingin mengunggah KKA tersebut?') }}",
                        buttons: {
                            Ya: {
                                btnClass: 'btn-success',
                                action: function(){                       
                                    window.location.href = "/unggah-KKA/"+id;
                                },
                            },
                            Tidak: function(){
                    $.alert('Dibatalkan!');
                            }
                        }
                    });
                });

                $('#menyetujui').click(function(){
                    $.confirm({
                        title: "{{ __('Perhatian!') }}",
                        content: "{{ __('Apakah anda ingin menyetujui KKA tersebut?') }}",
                        buttons: {
                            Ya: {
                                btnClass: 'btn-success',
                                action: function(){                       
                                    window.location.href = "/menyetujui/"+id;
                                },
                            },
                            Tidak: function(){
                    $.alert('Dibatalkan!');
                            }
                        }
                    });
                });

                $('#revisi').click(function(){
                    $.confirm({
                        title: "{{ __('Perhatian!') }}",
                        content: "{{ __('Apakah anda ingin merevisi KKA tersebut?') }}",
                        buttons: {
                            Revisi: {
                                btnClass: 'btn-danger',
                                action: function(){                       
                                     window.location.href = kka_view;
                                },
                            },
                            Tidak: function(){
                    $.alert('Dibatalkan!');
                            }
                        }
                    });
                });

                $('#nhp').click(function(){
                    window.location.href = "/cetak-Nhp/"+id;
                });
            }
        });
        var url_data = "getDataTemuan_per_auditor/"+id;
        // data table menampilkan data user yang telah menginputkan KKA 
        var table = $('#dataKKA-perAuditor').DataTable({

            retrieve: true,
            paging: false,
            ajax: url_data,
            type: "GET",
            dataType: "JSON",
            columns: [
                {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
                },
                {data: 'kode_temuan_id', name: 'kode_temuan_id', title:'Kode Temuan'},
                {data: 'judultemuan', name: 'judultemuan', title: 'Temuan'},
                {data: 'nama_anggota', name: 'nama_anggota', title: 'Oleh'},
                {data: 'action', name: 'action', orderable: false, searchable: false,title: 'Action'},
            ],        
            "order": [[ 1, 'asc' ]],
        });

    }

    $(document).on('hide.bs.modal','#modalPemeriksaan', function () { //fungsi ketika modal hide mendestroy data table yg di dlm modal
        // alert('jalan');
        $('#dataKKA-perAuditor').dataTable().fnDestroy(); //mendestroy data table
    });


    function showmodal(){
        $('#showDataTemuan').modal('show');

        $("close-modalShowDataTemuan").click(function() { 
             $('#showDataTemuan').modal.close();
        });
    }

    function showModalEditKKA(id) {
        // console.log(id)
        //fungsi confirm sebelum mengeksekusi modal
        $.confirm({
            title: "{{ __('Perhatian!') }}",
            content: "{{ __('Apakah anda ingin mengedit KKA tersebut?') }}",
            buttons: {
                Ya: {
                    btnClass: 'btn-danger',
                    action: function(){
                        $('#shotModalEditKKA').modal('show'); //show edit kka modal
                        $('#modalPemeriksaan').modal('hide'); //hide list kka modal
                        var getdataEditKKA = 'getdata-editKKA/'+id;
                        $.ajax({
                                url:getdataEditKKA,
                                type: 'GET',
                                dataType: 'JSON',
                                success: function(data){
                                $.each(data, function( index, value ) {
                                    var d = new Date();
                                    var n = d.getFullYear();
                                    var nomor_spt = value.kode_kelompok +"/"+ value.nomor+"/"+"438.4"+"/"+n;
                                    $('#nama_spt').val(value.sebutan);
                                    $('#nomor_spt').val(nomor_spt);
                                    $('#sasaran_audit').val(value.sasaran_audit);
                                    $('#judultemuan').val(value.judultemuan);
                                    $('#kode_temuan').val(value.kode_temuan_id);

                                    // data value  summernote
                                    $('#summernote-kondisi').summernote('insertText', value.kondisi);
                                    $('#summernote-kriteria').summernote('insertText', value.kriteria);
                                    console.log(value.spt_id);
                                    $('#id').val(value.spt_id);
                                    $('#detail_id').val(value.id_detail);
                                    // console.log(value.spt_id)
                                });
                            }
                        });
                    },
                },
                Tidak: function(){
                    $.alert('Dibatalkan!');
                }
            }
        });

        // $(".ajax-form").validate({
        //     rules: {
        //         lokasi : {required: true, minlength: 3},
        //         sebutan_pimpinan : {required: true},
        //         kecamatan : {required: true}

        //     },
        //     submitHandler: function(form){
        //         save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
        //         /*form.preventDefault();*/
        //         var id = $('#id').val();

        //         base_url = "{{ route('store_lokasi') }}";
        //         console.log(base_url)
        //         url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
        //         type = (save_method == 'new') ? "POST" : "PUT";        
        //         $.ajax({
        //             url: url,
        //             type: type,
        //             data: $('#lokasi-form').serialize(),
        //             dataType: 'text',
        //             success: function(res){
        //                 //str = res.responseText;
                        
        //                 if(res.match(/(error|validation)/i)){
        //                     alert(res);
        //                 }else{
        //                     $('.ajax-form')[0].reset();
        //                     $("#id_kecamatan").hide();
        //                     table.ajax.reload();
        //                     console.log(res);
        //                 }
                        
        //             },
        //             error: function(request, status, error){
        //                 json = $.parseJSON(request.responseText);
        //                 $.each(json.errors, function(key, value){
        //                     $(".invalid-"+key).show();
        //                     $('.invalid-'+key).append('<p>'+value+'</p>');
        //                 });
        //                /* console.log('parsed json :',json);*/
        //             }
        //         });
        //     }
        // });

        $("#edit-kka-form").validate({
            rules: {
                detai_spt_id : {required: true},
                edit_kka : {required: true},
                nama_spt : {required: true},
                nomor_spt : {required: true},
                file_laporan : {required: true}

            },
            submitHandler: function(form){
                save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
                /*form.preventDefault();*/
                var id = $('#id').val();

                base_url = "{{ route('laporan_auditor') }}";
                // console.log(base_url)
                url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
                type = (save_method == 'new') ? "POST" : "PUT";        
                $.ajax({
                    url: url,
                    type: type,
                    data: $('#edit-kka-form').serialize(),
                    dataType: 'text',
                    success: function(data){
                        //str = res.responseText;
                        console.log(data)
                        $("#edit-kka-form")[0].reset();
                        $('#shotModalEditKKA').modal('hide'); //show edit kka modal
                    },
                    error: function(error){
                        console.log('Error :', error);
                    }
                });
            }
        });
    }

</script>
@endsection
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script> -->
@endpush
