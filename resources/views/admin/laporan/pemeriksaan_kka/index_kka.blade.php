@section('nav_tab_auditor')
<li class="nav-item">
  <a class="nav-link active"  href="#auditor-tab" role="tab" aria-controls="auditor-tab" aria-selected="false">Auditor SPT</a>
</li>
@endsection

@section('content_auditor')

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
                    <!-- <a href="#" class="btn btn-success btn-xs" style="display: none;" id="unggah">Unggah</a> --> <!-- dipindahkan fungsi button jadi di lhp insert + unggah -->
                    <a href="#" class="btn btn-primary btn-xs cetak" style="display: none;" id="paparan">Paparan</a>
                    <!-- <a href="#" class="btn btn-danger btn-xs" id="revisi" style="display: none;">Revisi</a> -->
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
                            <input type="hidden" name="detail_spt_id" id=detail_id>
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
                                        <!-- <input type="text" class="form-control" id="kode_temuan" name="file_laporan[kode_temuan_id]" placeholder="Kode Temuan"> -->
                                        <!-- <select class="form-control selectize" id="kode" name="file_laporan[kode_temuan_id]">
                                            <option value="">{{ __('Pilih Kode Temuan') }}</option>
                                                    <option id="id_option" class="form-control" value="" ></option>
                                        </select> -->
                                        <div id="kode_temuan"></div> <!-- cara pertama -->
                                        <h6> sementara get data masih di placeholder tetapi tetap bisa di edit</h6>
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

    @section('js_tabel_auditor')
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

    function showModalLihatLaporanPemeriksaan(id){        
        $('#modalPemeriksaan').modal('show');
        // console.log(id);

        // url get data
        // var url_prefix = (window.location.pathname == '/admin') ? 'admin/spt/' : 'spt/';\

        var url_prefix = (window.location.pathname == '/admin/spt');
        // console.log(window.location.pathname);
        var get_detail = url_prefix ? "/kka/getdata_detail/"+id : "admin/kka/getdata_detail/"+id;

        // get id user_log
        var user_id = {!! auth()->user()->id !!};

        // proses seleksi ajax button
        $.ajax({
            url:get_detail,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                // console.log(data);
                for (var i = 0; i < data.length; i++) {

                    // kondisi jika ketua tim akan mengunggah KKA yang sudah diupload
                    if (data[i].status == null && data[i].user_id == user_id && data[i].peran == 'Ketua Tim'){ //ketua tim telah acc kka
                        // button_unggah.style.display = 'block';
                        $('#unggah').show();
                        $('#revisi').show();
                        $('#paparan').show();
                    }
                    else if (data[i].status != true  && data[i].user_id == user_id && data[i].peran == 'Pengendali Teknis') { //pengendali teknis telah acc kka
                        // $('#menyetujui').show();// jika dalnis merevisi kka & berstatus revisi maka button menyetuji akan hide
                        if(data[i].status != null){
                            $('#menyetujui').hide(); 
                        }else{
                            $('#menyetujui').show();
                        }
                    }
                    else if (data[i].status != true  && data[i].user_id == user_id && data[i].peran == 'Pengendali Mutu') { //pengendali mutu telah acc kka
                        $('#unggah').hide();
                        // $('#revisi').show();
                        $('#menyetujui').show();
                    }
                }

                // $('#unggah').click(function(){
                //     $.confirm({
                //         title: "{{ __('Perhatian!') }}",
                //         content: "{{ __('Apakah anda ingin mengunggah KKA tersebut?') }}",
                //         buttons: {
                //             Ya: {
                //                 btnClass: 'btn-success',
                //                 action: function(){                       
                //                     window.location.href = "/kka/unggah-KKA/"+id;
                //                 },
                //             },
                //             Tidak: function(){
                //     $.alert('Dibatalkan!');
                //             }
                //         }
                //     });
                // });

                $('#menyetujui').click(function(){
                    $.confirm({
                        title: "{{ __('Perhatian!') }}",
                        content: "{{ __('Apakah anda ingin menyetujui KKA tersebut?') }}",
                        buttons: {
                            Ya: {
                                btnClass: 'btn-success',
                                action: function(){                       
                                    window.location.href = "/kka/menyetujui/"+id;
                                },
                            },
                            Tidak: function(){
                    $.alert('Dibatalkan!');
                            }
                        }
                    });
                });

                // (window.location.pathname == '/admin/kka') ? "/kka/input-lhp/"+id : "admin/kka/input-lhp/"+id
                $('#paparan').click(function(){
                    window.location.href = url_prefix ? "/kka/paparan/"+id : "admin/kka/paparan/"+id;
                    // $.confirm({
                    //     title: "{{ __('Perhatian!') }}",
                    //     // content: "{{ __('Apakah anda yakin ingin merevisi semua KKA tersebut? Jika ya maka Auditor terkait akan merevisi KKA tersebut!') }}",
                    //     content: "{{ __('Apakah anda yakin akan melanjutkan Input LHP?') }}",
                    //     buttons: {
                    //         Revisi: {
                    //             btnClass: 'btn-success',
                    //             action: function(){                       
                    //             },
                    //         },
                    //         Tidak: function(){
                    // $.alert('Dibatalkan!');
                    //         }
                    //     }
                    // });
                });
                
                $('#revisi').click(function(){
                    $.confirm({
                        title: "{{ __('Perhatian!') }}",
                        content: "{{ __('Apakah anda yakin ingin merevisi semua KKA tersebut? Jika ya maka Auditor terkait akan merevisi KKA tersebut!') }}",
                        buttons: {
                            Revisi: {
                                btnClass: 'btn-success',
                                action: function(){                       
                                     window.location.href = (window.location.pathname == '/admin/spt') ? "kka/tolak-kka/"+id : "admin/kka/tolak-kka/"+id;
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

        // window.submitComment = function(){console.log('YOLLOOO')}

        // function revisi2(id) {
        //     $.confirm({
        //         title: "{{ __('Perhatian!') }}",
        //         content: "{{ __('Apakah anda yakin ingin merevisi KKA tersebut? Jika ya maka Auditor terkait dalam KKA akan merevisi KKA tersebut!') }}",
        //         buttons: {
        //             Revisi: {
        //                 btnClass: 'btn-danger',
        //                 action: function(){                       
        //                      window.location.href = '#';
        //                 },
        //             },
        //             Tidak: function(){
        //     $.alert('Dibatalkan!');
        //             }
        //         }
        //     });
        // }

        // function revisi_by_id(id) {
        //     console.log(id);
        // //fungsi confirm sebelum mengeksekusi modal
        //     // $.confirm({
        //     //     title: "{{ __('Perhatian!') }}",
        //     //     content: "{{ __('Apakah anda yakin ingin merevisi KKA tersebut? Jika ya maka Auditor terkait dalam KKA akan merevisi KKA tersebut!') }}",
        //     //     buttons: {
        //     //         Ya: {
        //     //             btnClass: 'btn-danger',
        //     //             action: function(){

        //     //             },
        //     //         },
        //     //         Tidak: function(){
        //     //             $.alert('Dibatalkan!');
        //     //         }
        //     //     }
        //     // });
        // }

        // ? "admin/kka/getdata_detail/"+id : "/kka/getdata_detail/"+id;
        var url_data = url_prefix ? "/kka/getDataTemuan_per_auditor/"+id : "admin/kka/getDataTemuan_per_auditor/"+id;
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
                {data: 'judultemuan', name: 'judultemuan', title: 'Judul Temuan'},
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
                        var url_prefix = (window.location.pathname == '/admin');
                        var getdataEditKKA = url_prefix ? 'admin/kka/getdata-editKKA/'+id : '/kka/getdata-editKKA/'+id;
                        $.ajax({
                                url:getdataEditKKA,
                                type: 'GET',
                                dataType: 'JSON',
                                success: function(data){
                                // console.log(data);

                                $.each(data['data_kka'], function( index, value ) { //foreach jquery for data kka except kode temuan
                                    var d = new Date();
                                    var n = d.getFullYear();
                                    var nomor_spt = value.kode_kelompok +"/"+ value.nomor+"/"+"438.4"+"/"+n;
                                    $('#nama_spt').val(value.sebutan);
                                    $('#nomor_spt').val(nomor_spt);
                                    $('#sasaran_audit').val(value.sasaran_audit);
                                    $('#judultemuan').val(value.judultemuan);
                                    // console.log(jQuery.parseJSON(value.kondisi));
                                    
                                    // data value  summernote
                                    $('#summernote-kondisi').summernote('pasteHTML', jQuery.parseJSON(value.kondisi));
                                    $('#summernote-kriteria').summernote('pasteHTML', jQuery.parseJSON(value.kriteria));
                                    // console.log(value.spt_id);
                                    $('#id').val(value.spt_id);
                                    $('#detail_id').val(value.id_detail);
                                    // console.log(value.spt_id)
                                });
                                
                                    var kode = 'kode';
                                    var select = $("<select id=\"kode\" name=\"file_laporan[kode_temuan_id]\" /></select>");
                                    
                                    $.each(data['get_kode_temuan'], function( index, value ) {
                                        select.append($("<option></option>").attr("value", value.id).text(value.select_supersub_kode +' '+ value.deskripsi));
                                    });

                                    $("#kode_temuan").html(select);

                                    $('#kode').selectize({    
                                        /*sortField: 'text',*/
                                        allowEmptyOption: false,
                                        placeholder: data['selected_kode_kka'][0].select_supersub_kode +' '+data['selected_kode_kka'][0].deskripsi,
                                        create: false,
                                        onchange: function(value){
                                         
                                        },
                                    });

                                    var $select = $('#kode').selectize();
                                    $select[0].selectize.setValue("Pilih Kode Temuan");
                            }
                        });
                    },
                },
                Tidak: function(){
                    $.alert('Dibatalkan!');
                }
            }
        });

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
                        setTimeout(function(){// wait for 2 secs
                             location.reload(); // then reload the page
                        }, 2000);
                    },
                    error: function(error){
                        console.log('Error :', error);
                    }
                });
            }
        });
    }

    $('body').on('hidden.bs.modal', '#shotModalEditKKA', function () {
        $('#summernote-kondisi').summernote('reset');
        $('#summernote-kriteria').summernote('reset');
        $("#edit-kka-form")[0].reset();
    });


</script>
@endsection
@push('css')
<link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script> -->
@endpush
