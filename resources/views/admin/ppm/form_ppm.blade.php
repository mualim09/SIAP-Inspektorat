<!-- form ke 3 tdk memakai id_spt -->

<!-- start form ppm -->
<div class="container">
    <form id="form-ppm">
        <input type="hidden" name="id_ppm" id="id-ppm">
        <input type="hidden" name="unsur_ppm" id="unsur-ppm" value="Pengembangan Profesi">
        @csrf

        <!-- start tanggal mulai & akhir ppm -->
        <div class="form-group row">                    
            <label for="tgl-mulai-ppm" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
            <div class="col-md-4">                      
                <input type="text" class="form-control datepicker" name="tgl_mulai_ppm" id="tgl-mulai-ppm" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">
            </div>
            <label for="tgl-akhir-ppm" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
            <div class="col-md-4">
                <input type="text" class="form-control datepicker" name="tgl_akhir_ppm" id="tgl-akhir-ppm" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
            </div>
        </div>
        <script type="text/javascript">                         
            $("#tgl-mulai-ppm").on('changeDate', function(selected) {
                var startDate = new Date(selected.date.valueOf());
                $("#tgl-akhir-ppm").datepicker('setStartDate', startDate);
                $('#tgl-akhir-ppm').prop('disabled',false);
                $('#tgl-akhir-ppm').focus();
            });
            
            $('#tgl-akhir-ppm').on('changeDate', function(){
                var start = $("#tgl-mulai-ppm").val();
                var end = $("#tgl-akhir-ppm").val();
                url = "{{route('durasi_spt')}}"//'admin/spt/durasi/' +start+'/'+end;
                    $.ajax({
                        url: url,
                        type: "GET",
                        //dataType: 'JSON',
                        data: {start:start, end:end},
                        success: function(data){
                            // console.log(data);
                            $('#lama-ppm').val(data);
                        },
                        error: function(response, status, error){
                            //console.log(response);
                        }
                    });
            });
        </script>
        <!-- end tanggal mulai & akhir ppm -->


        <!-- start lama ppm -->
        <div class="form-group row">                    
            <label for="lama-ppm" class="col-md-2 col-form-label">{{ __('Lama') }}</label>
            <div class="col-md-4">                      
                <input type="text" class="form-control" name="lama_ppm" id="lama-ppm" autocomplete="off" placeholder="{{ __('Lama')}}">                           
            </div>                  
        </div>
        <!-- end lama ppm -->


        <!-- start anggota session -->
        <div class="form-group">
            <div class="col-md-2 col-form-label">{{ __('Anggota') }} </div>
            <div class="col">
                <table id="tabel-anggota-ppm" class="col"></table>
                <button id="add-anggota-ppm" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaPpmModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
                <!-- <small id="infoanggota" class="form-text text-muted">Anggota pertama dipilih akan automatis menjadi yang ditugaskan</small> -->
            </div>
        </div>
        <!-- end anggota session -->


        <!-- start submit ppm -->
        <div class="form-group">
             <div class="col">
                 <button type="submit" class="btn btn-primary offset-md-2">
                     {{ __('Submit') }}
                 </button>
             </div>
         </div>
        <!-- end submit ppm -->

    </form>
</div>
<!-- end form ppm -->


<!-- start modal anggota ppm -->
<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="anggotaPpmModal" data-backdrop="static" data-keyboard="true" style="z-index: 2000;">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3>Anggota PPM</h3>
                <button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-anggota-ppm">
                    <span class="btn-inner--icon"><i class="fa fa-times"></i></span>
                    <span class="btn-inner--text">{{ __('Close') }}</span>
                </button>
            </div>
            
            <div class="modal-body">
                @if(Auth::user()->can(['Create SPT', 'Edit SPT']))
                <form  id="form-session-anggota-ppm" class="ajax-form needs-validation" novalidate>
                    <!-- <input type="hidden" name="spt_id_umum" id="spt-id-umum-anggota"> -->
                    @csrf
                    <div class="form-group row">
                        <label for="anggota" class="col-md-2 col-form-label">{{ __('Anggota') }} </label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="session-anggota-ppm" name="session_anggota_ppm">
                                <option value="">{{ __('Anggota SPT') }}</option>
                                @foreach($listAnggota as $anggota)
                                <option class="form-control selectize" value="{{$anggota->id}}" >{{ $anggota->full_name . $anggota->gelar }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <div class="md-form input-group mb-3">
                              <input type="text" class="form-control" name="lama_jam_ppm" id="lama-jam-ppm" autocomplete="off" placeholder="{{ __('Lama jam')}}">
                              <div class="input-group-prepend">
                                <span class="input-group-text md-addon">/jam</span>
                              </div>
                            </div>
                            <!-- <input type="text" class="form-control" name="lama_jam" id="lama-jam-id" autocomplete="off" placeholder="{{ __('Lama jam')}}"> -->
                        </div>
                        
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="nilai_dupak_ppm" id="dupak-id-ppm" autocomplete="off" placeholder="{{ __('Dupak')}}">
                        </div>
                        
                    <small class="form-text text-muted">Inputkan Data 1(satu) per 1(satu) dari tiap - tiap anggota yang akan dipilih!</small>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary offset-md-4">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
            <script type="text/javascript">
                $("#form-session-anggota-ppm").validate({
                    rules: {
                        session_anggota_umum: {required: true, number:true},
                        // session_peran: {required: true}
                        // session_peran : {
                        //     required: true,
                        //     normalizer: function( value ) {
                        //         var regex = /^[a-zA-Z]+$/;
                        //         if(regex.test(value) == false){
                        //             alert("Must be in alphabets only");
                        //             return false;
                        //         }
                        //     }
                        // }
                    },
                    submitHandler: function(form){
                        var tgl_mulai = $('#form-ppm').find('#tgl-mulai-ppm').val();
                        var tgl_akhir = $('#form-ppm').find('#tgl-akhir-ppm').val();
                        var lama_jam_ppm = $('#form-session-anggota-ppm').find('#lama-jam-ppm').val();
                        var dupak_anggota_ppm = $('#form-session-anggota-ppm').find('#dupak-id-ppm').val();
                        var user_id = $('#session-anggota-ppm option:selected').val();
                        var ppm_id = null;
                        //break save_method_umum;
                        if (ppm_id == null) {
                            var save_method_umum = 'new';
                        }else{
                            var save_method_umum = 'old';
                        }
                        

                        url = (save_method_umum == 'new') ?  "{{ route('store_session_anggota_ppm') }}" : "";
                        //$.alert(save_method_umum);
                        // if(tgl_mulai == '' || tgl_akhir==''){
                        //     $.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
                        // }else{
                            // alert(url);
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: {user_id:user_id, ppm_id:ppm_id, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, lama_jam_ppm:lama_jam_ppm, dupak_anggota_ppm:dupak_anggota_ppm},
                                success: function(data){
                                    console.log('success :', data);                                                                
                                    $('#tabel-anggota-ppm').DataTable().ajax.reload();
                                    // $("#lama-jam-id").val('');
                                    // $("#dupak-id").val('');
                                    // clearOptionsUmum();
                                },
                                error: function(error){
                                    console.log('Error :', error);
                                }
                            });
                        // }
                    }
                });
            </script>
        </div>
    </div>
</div>
<!-- end modal anggota ppm -->


<!-- start javascript -->
<script type="text/javascript">

$(document).ready(function () {

    var id_ppm = $('#id-ppm').val();
    var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/get-anggota/ppm/' : 'spt/get-anggota/ppm/';
    url = (id_ppm == '') ? url_prefix+'0' : url_prefix+id_ppm ;

    $('#tabel-anggota-ppm').DataTable({        
        "language": {
            "emptyTable":  "Data Anggota Belum dimasukkan"
        },
        dom: 'rt',
        "pageLength": 50,
        fixedColumns:   {
            heightMatch: 'auto'
        },
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' 
            }
        },
        "opts": {
          "theme": "bootstrap",
        },
        retrieve: true,
        processing: true,
        aDataSort:true,
        serverSide: true,
        ajax: url,
        /*deferRender: true,*/
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true, width: '10%'
            },
            {data: 'nama_anggota', name: 'nama_anggota', 'title': "{{ __('Nama') }}", width: '40%'},
            // {data: 'peran', name: 'peran', 'title': "{{ __('Peran') }}", width: '40%'},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false, width: '10%'},
        ],
    });
});

$("#form-ppm").validate({
        // rules: {
        //     jenis_spt_umum : {required: true},
        //     tgl_mulai_umum: {required: true},
        //     tgl_akhir_umum: {required: true},
        //     // lokasi_id_umum : {required: true},
        //     // info_kegiatan : {teks: true},

        // },

        submitHandler: function(form){
            var jenis_ppm = $("#unsur-ppm").val();
            // // alert(jenis_spt_umum);
            // var tgl_mulai_umum = $("#tgl-mulai-umum").val();
            // var tgl_akhir_umum = $("#tgl-akhir-umum").val();
            // var lama_umum = $('#lama-spt-umum').val();
            // var lokasi_umum_id = $('#lokasi-id-umum').val();
            // var info_dasar_umum = $('#info-dasar-umum').val();
            // var info_untuk_umum = $('#info-untuk-kegiatan-umum').val();

            var id = $('#id-ppm').val();
            save_method_umum = (id == '') ? 'new' : save_method_umum;
            var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/spt/' : 'spt/';
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            url = (save_method_umum == 'new') ? "{{ route('store_ppm') }}" : '' ;/*edit masih blm*/
            method = (save_method_umum == 'new') ? "POST" : "PUT";
            type = "POST";            
            

            $.ajax({
                url: url,
                type: type,
                data: {jenis_ppm:jenis_ppm,  _method: method},

                success: function(data){
                    console.log(data);
                    // $("#spt-umum-form")[0].reset();
                    // $('#formSptUmum').modal('hide');
                    // //if(save_method_umum == 'new') clearSessionAnggota();
                    // //table.ajax.reload();
                    // $('#spt-umum-table').DataTable().ajax.reload();
                    // clearOptionsUmum();
                    // $('#list-anggota-umum-session').DataTable().clear().destroy();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });    
</script>
<!-- end javascript -->

