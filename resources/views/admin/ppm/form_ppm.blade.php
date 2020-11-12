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
            <form id="form-ppm" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id_ppm" id="id-ppm">
                <input type="hidden" name="unsur_ppm" id="unsur-ppm" value="Pengembangan Profesi">

                <!-- start input kegiatan -->
                <div class="form-group row">
                    <label for="kegiatan" class="col-md-2 col-form-label ">{{ __('Kegiatan') }}</label>
                    <div class="col-md-10">
                         <textarea rows="5" id="kegiatan-ppm" class="form-control form-control-alternative @error('kegiatan') is-invalid @enderror" name="kegiatan_ppm" ></textarea>
                         <small id="infoKegiatanHelp" class="form-text text-muted">Masukkan nama <span style="color:red;">Kegiatan</span> yang sedang dilaksanakan. !</small>
                    </div>
                </div>
                <!-- end kegiatana -->

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
                    <div class="col-md-8">                      
                        <input type="file" class="form-control" name="nota_dinas" id="id-nota-dinas" placeholder="{{ __('Lama')}}">                      
                    </div>                  
                </div>
                <!-- end upload note dinas ppm -->

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
            
        </div>
    </div>
</div>
<!-- form ke 3 tdk memakai id_spt -->

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
                        session_anggota_ppm: {required: true, number:true},
                    },
                    submitHandler: function(form){
                        var tgl_mulai = $('#form-ppm').find('#tgl-mulai-ppm').val();
                        var tgl_akhir = $('#form-ppm').find('#tgl-akhir-ppm').val();
                        var lama_jam_ppm = $('#form-session-anggota-ppm').find('#lama-jam-ppm').val();
                        var dupak_anggota_ppm = $('#form-session-anggota-ppm').find('#dupak-id-ppm').val();
                        var user_id = $('#session-anggota-ppm option:selected').val();
                        var ppm_id = null;
                        //break save_method_ppm;

                        if (ppm_id == null) {
                            var save_method_ppm = 'new';
                        }/*else{
                            var save_method_ppm = 'old';
                        }*/
                        

                        url = (save_method_ppm == 'new') ?  "{{ route('store_session_anggota_ppm') }}" : "";
                        //$.alert(save_method_ppm);
                        if(tgl_mulai == '' || tgl_akhir==''){
                            $.alert('Isikan tanggal mulai dan tanggal akhir terlebih dahulu.');
                        }else{
                            // alert(url);
                            $.ajax({
                                url: url,
                                type: 'post',
                                data: {user_id:user_id, ppm_id:ppm_id, tgl_mulai:tgl_mulai, tgl_akhir:tgl_akhir, lama_jam_ppm:lama_jam_ppm, dupak_anggota_ppm:dupak_anggota_ppm},
                                success: function(data){
                                    console.log('success :', data);                                                                
                                    $('#tabel-anggota-ppm').DataTable().ajax.reload();
                                    drawTableAnggotaPpm(ppm_id);
                                    $("#lama-jam-ppm").val('');
                                    $("#dupak-id-ppm").val('');
                                    clearOptionsPpm();
                                },
                                error: function(error){
                                    console.log('Error :', error);
                                }
                            });
                        }
                    }
                });

                function clearOptionsPpm(){
                    var optAnggotaPpm = $('#session-anggota-ppm').selectize();
                    var controlAnggotaPpm = optAnggotaPpm[0].selectize;
                    controlAnggotaPpm.clear();
                }
            </script>
        </div>
    </div>
</div>
<!-- end modal anggota ppm -->

<!-- start javascript -->
<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

function drawTableAnggotaPpm(ppm_id = ''){
    var ppm_id = ppm_id;
    url = "{{ route('tabel_anggota_ppm') }}";

    $.ajax({
      url : url,
      data: {ppm_id: ppm_id},
      type: 'GET',
      success: function(res){
        $('#tabel-anggota-ppm-wrapper').html(res);
      },
      error: function(err){
        console.log(err);
      }
    });
}

function function_ppm(user_id){
    save_method_ppm = 'delete';
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var tgl_mulai_ppm = $('#tgl-mulai-ppm').val();
        var tgl_akhir_ppm = $('#tgl-akhir-ppm').val();
        ppm_id = ( typeof $('#form-ppm').attr('id-ppm') !== 'undefined' ) ? $('#form-ppm').attr('id-ppm') : '';
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? "session/anggota/delete/"+user_id : "session/anggota/delete/"+user_id;
                        //url = "session/anggota/delete/"+user_id;
                        $.ajax({
                            url: url,
                            type: "POST",                
                            data: {_method: 'delete', '_token' : csrf_token, tgl_mulai_ppm:tgl_mulai_ppm, tgl_akhir_ppm:tgl_akhir_ppm, user_id:user_id },
                            success: function(data){
                                drawTableAnggotaPpm(ppm_id);
                            },
                            error: function(err){
                                console.log(err);
                            }
                        });
                    },
                },
                cancel: function(){
                    $.alert('Canceled!');
                }
            }
    });
}

// // $(document).ready(function () {
    
// // });

$("#form-ppm").validate({
        rules: {
            jenis_ppm : {required: true},
            tgl_mulai_ppm : {required: true},
            tgl_akhir_ppm : {required: true},

        },

        submitHandler: function(form){
            var jenis_ppm = $("#unsur-ppm").val();
            var kegiatan_ppm = $('#kegiatan-ppm').val();
            var tgl_mulai_ppm = $("#tgl-mulai-ppm").val();
            var tgl_akhir_ppm = $("#tgl-akhir-ppm").val();
            var lama_ppm = $('#lama-ppm').val();
            var file_nota_dinas = document.getElementById('id-nota-dinas').value;
            
            var id = $('#id-ppm').val();
            save_method_ppm = (id == '') ? 'new' : save_method_ppm;
            var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/ppm/' : 'ppm/';
            //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
            url = (save_method_ppm == 'new') ? "{{ route('store_ppm') }}" : '' ;/*edit masih blm*/
            method = (save_method_ppm == 'new') ? "POST" : "PUT";
            type = "POST";            
            

            $.ajax({
                url: url,
                type: type,
                data: {jenis_ppm:jenis_ppm, tgl_mulai_ppm:tgl_mulai_ppm, tgl_akhir_ppm:tgl_akhir_ppm, lama_ppm:lama_ppm, kegiatan_ppm:kegiatan_ppm, file_nota_dinas:file_nota_dinas, _method: method},

                success: function(data){
                    console.log(data);
                    // $("#form-ppm")[0].reset();
                    // $('#tabel-ppm').DataTable().ajax.reload();
                    // $('#form-session-anggota-ppm')[0].reset();
                    // // location.reload();
                    // $('#tabel-anggota-ppm-wrapper').html(data);
                    // $('#formPpm').modal('hide');
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });

</script>
<!-- end javascript -->

