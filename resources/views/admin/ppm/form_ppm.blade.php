<div class="modal fade modal-form" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" id="formPpm" data-backdrop="static" data-keyboard="true" style="z-index: 2000;">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h3>{{ __('Form Program Pelatihan Mandiri') }}</h3>
                <button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-modal-form-input-PPM">
                    <span class="btn-inner--icon"><i class="fa fa-times"></i></span>
                    <span class="btn-inner--text">{{ __('Close') }}</span>
                </button>
            </div>
            
            <div class="modal-body">
                
            <!-- start form insert ppm -->
                <!-- start kegiatan ppm -->
                <div class="form-group row">
                    <label for="kegiatan" class="col-md-2 col-form-label ">{{ __('Kegiatan') }}</label>
                    <div class="col-md-10">
                         <textarea rows="5" id="kegiatan-ppm" class="form-control form-control-alternative @error('kegiatan') is-invalid @enderror" name="kegiatan_ppm" ></textarea>
                         <small id="infoKegiatanHelp" class="form-text text-muted">Masukkan nama <span style="color:red;">Kegiatan</span> yang sedang dilaksanakan. !</small>
                    </div>
                </div>
                <!-- end kegiatan ppm -->

                <!-- start tanggal spt -->
                    <div class="form-group row">
                        <label for="tgl-mulai-ppm" class="col-md-2 col-form-label">{{ __('Mulai') }}</label>
                        <div class="col-md-4">                      
                            <input type="text" class="form-control datepicker" name="tgl_mulai_ppm" id="tgl-mulai-ppm" autocomplete="off" placeholder="{{ __('Tanggal Mulai')}}">
                        </div>

                        <label for="tgl-akhir-ppm" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control datepicker" name="tgl_akhir_ppm" id="tgl-akhir-ppm" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
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
                    </div>
                <!-- end tanggal -->

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
                        <!-- <table id="tabel-anggota-ppm" class="col"></table> -->
                        <button id="add-anggota-ppm" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaPpmModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
                        <!-- <small id="infoanggota" class="form-text text-muted">Anggota pertama dipilih akan automatis menjadi yang ditugaskan</small> -->
                    </div>
                    <div class="col table-responsive" id="tabel-anggota-ppm-wrapper">
                        
                    </div>
                </div>
                <!-- end anggota session -->

                <!-- start upload note dinas ppm -->
                <div class="form-group row">                    
                    <label for="lama-ppm" class="col-md-2 col-form-label">{{ __('Upload File') }}</label>
                    <div class="col-md-4">                      
                        <!-- <input type="file" class="form-control" name="nota_dinas" id="id-nota-dinas" placeholder="{{ __('Lama')}}"> -->
                        <!-- <div class="custom-file"> -->
                            <input type="file" class="custom-file-input" id="id-nota-dinas" name="nota_dinas">
                            <label class="custom-file-label" for="id-nota-dinas">Select file</label>
                        <!-- </div>                            -->
                    </div>                  
                </div>
                <!-- end upload note dinas ppm -->
                
            <!-- end form ppm -->

            </div>
            
        </div>
    </div>
</div>
<!-- form ke 3 tdk memakai id_spt -->

<!-- start javascript -->
<script type="text/javascript">

$('.datepicker').each(function() {
    $(this).datepicker({
        language: "{{ config('app.locale')}}",
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });
});
// $('#formPpm').on('hidden.bs.modal', function(){
//     $('#tgl-akhir-ppm').prop('disabled',true);
// });


// var select_lokasi = $('#session-anggota-ppm').selectize({       
//    /*sortField: 'text',*/
//    allowEmptyOption: false,
//    placeholder: 'Pilih Anggota',
//    closeAfterSelect: true,
//    create: false,
//    maxItems:10,
//    onchange: function(value){
//    },
// });

// function drawTableAnggotaPpm(ppm_id = ''){
//     var ppm_id = ppm_id;
//     url = "{{ route('tabel_anggota_ppm') }}";

//     $.ajax({
//       url : url,
//       data: {ppm_id: ppm_id},
//       type: 'GET',
//       success: function(res){
//         $('#tabel-anggota-ppm-wrapper').html(res);
//       },
//       error: function(err){
//         console.log(err);
//       }
//     });
// }

// function function_ppm(user_id){
//     save_method_ppm = 'delete';
//         var csrf_token = $('meta[name="csrf-token"]').attr('content');
//         var tgl_mulai_ppm = $('#tgl-mulai-ppm').val();
//         var tgl_akhir_ppm = $('#tgl-akhir-ppm').val();
//         ppm_id = ( typeof $('#form-ppm').attr('id-ppm') !== 'undefined' ) ? $('#form-ppm').attr('id-ppm') : '';
//         $.confirm({
//             title: "{{ __('Delete Confirmation') }}",
//             content: "{{ __('Are you sure to delete ?') }}",
//             buttons: {
//                 delete: {
//                     btnClass: 'btn-danger',
//                     action: function(){
//                         url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? "admin/ppm/session/anggota/delete/"+user_id : "ppm/session/anggota/delete/"+user_id;
//                         //url = "session/anggota/delete/"+user_id;
//                         $.ajax({
//                             url: url,
//                             type: "POST",                
//                             data: {_method: 'delete', '_token' : csrf_token, tgl_mulai_ppm:tgl_mulai_ppm, tgl_akhir_ppm:tgl_akhir_ppm, user_id:user_id },
//                             success: function(data){
//                                 drawTableAnggotaPpm(ppm_id);
//                             },
//                             error: function(err){
//                                 console.log(err);
//                             }
//                         });
//                     },
//                 },
//                 cancel: function(){
//                     $.alert('Canceled!');
//                 }
//             }
//     });
// }

// // $(document).ready(function () {
    
// // });

// $("#form-ppm").validate({
//         rules: {
//             jenis_ppm : {required: true},
//             tgl_mulai_ppm : {required: true},
//             tgl_akhir_ppm : {required: true},

//         },

//         submitHandler: function(form){
//             var jenis_ppm = $("#unsur-ppm").val();
//             var tgl_mulai_ppm = $("#tgl-mulai-ppm").val();
//             var tgl_akhir_ppm = $("#tgl-akhir-ppm").val();
//             var lama_ppm = $('#lama-ppm').val();
//             var nota_dinas = document.getElementById('id-nota-dinas').value;

//             var id = $('#id-ppm').val();
//             save_method_ppm = (id == '') ? 'new' : save_method_ppm;
//             var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/ppm/' : 'ppm/';
//             //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
//             url = (save_method_ppm == 'new') ? "{{ route('store_ppm') }}" : '' ;/*edit masih blm*/
//             method = (save_method_ppm == 'new') ? "POST" : "PUT";
//             type = "POST";            
            

//             $.ajax({
//                 url: url,
//                 type: type,
//                 data: {jenis_ppm:jenis_ppm, tgl_mulai_ppm:tgl_mulai_ppm, tgl_akhir_ppm:tgl_akhir_ppm, lama_ppm:lama_ppm, nota_dinas:nota_dinas, _method: method},

//                 success: function(data){
//                     console.log(data);
//                     // $("#form-ppm")[0].reset();
//                     // $('#form-session-anggota-ppm')[0].reset();
//                     // $("#id-nota-dinas").val('');
//                     // // location.reload();
//                     // $('#tabel-anggota-ppm-wrapper').html(data);
//                 },
//                 error: function(error){
//                     console.log(error);
//                 }
//             });
//         }
//     });

</script>
<!-- end javascript -->

