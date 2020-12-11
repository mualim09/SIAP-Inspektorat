<button id="btn-input-ppm" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#formPpmSatgas" style="margin-bottom: 20px;display: none;">{{ __('Tambah PPM') }}</button>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="formPpmSatgas">
  <div class="modal-dialog modal-xl" style="max-width: 85%;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>{{ __('Form Program Pelatihan Mandiri') }}</h3>
            <button type="button" class="btn btn-icon btn-3 btn-outline-secondary" data-dismiss="modal" aria-label="Close" id="close-modal-form-input-PPM">
                <span class="btn-inner--icon"><i class="fa fa-times"></i></span>
                <span class="btn-inner--text">{{ __('Close') }}</span>
            </button>
        </div>

        <div class="modal-body">
        <form id="form-ppm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_ppm" id="id-ppm">
            <input type="hidden" name="unsur_ppm" id="unsur-ppm" value="Pelatihan Kantor Sendiri">

            <!-- <div class="form-group row">
                <label for="dasar" class="col-md-2 col-form-label ">{{ __('Jenis PPM') }}</label>
                <div class="col-md-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="jenis-ppm2" name="unsur_ppm" value="Studi Banding" disabled="">
                        <label class="custom-control-label" for="jenis-ppm2">Studi Banding</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="jenis-ppm3" name="unsur_ppm" value="Konverensi/Kongres">
                        <label class="custom-control-label" for="jenis-ppm3">Konverensi/Kongres</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="jenis-ppm4" name="unsur_ppm" value="Workshop">
                        <label class="custom-control-label" for="jenis-ppm4">Workshop</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="jenis-ppm5" name="unsur_ppm" value="Pelatihan Kantor Sendiri" disabled="">
                        <label class="custom-control-label" for="jenis-ppm5">Pelatihan Kantor Sendiri</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="jenis-ppm1" name="unsur_ppm" value="Diklat Penjenjangan">
                        <label class="custom-control-label" for="jenis-ppm1">Diklat Penjenjangan</label>
                    </div>
                    <small id="infoDasarHelp" class="form-text text-muted">Silahkan pilih Jenis PPM yang dibutuhkan.</small>
                </div>
            </div> -->

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

                <!-- <label for="tgl-akhir-ppm" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control datepicker" name="tgl_akhir_ppm" id="tgl-akhir-ppm" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
                </div> -->
                <label for="lama-ppm" class="col-md-1 col-form-label">{{ __('Lama') }}</label>
                <div class="col-md-4">                      
                    <input type="text" class="form-control" autocomplete="off" placeholder="{{ __('1')}}" disabled=""> 
                    <input type="hidden" name="hari_ppm" id="hari-ppm" value="{{'1'}}">                     
                </div>
            </div>
            <!-- <script type="text/javascript">                         
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
                                // $('#lama-ppm').val(data);
                            },
                            error: function(response, status, error){
                                //console.log(response);
                            }
                        });
                });
            </script> -->
            <!-- end tanggal mulai & akhir ppm -->


            <!-- start lama ppm -->
            <!-- <div class="form-group row">                    
                <label for="lama-ppm" class="col-md-2 col-form-label">{{ __('Lama') }}</label>
                <div class="col-md-4">                      
                    <input type="text" class="form-control" name="lama_ppm" id="lama-ppm" autocomplete="off" placeholder="{{ __('Lama')}}">                           
                </div>                  
            </div> -->
            <!-- end lama ppm -->

            <!-- start select narasumber/moderator  -->
            <div class="form-group row" id="moderator_id">
                <label for="ppm" class="col-md-2 col-form-label ">{{ __('Narasumber/Moderator') }}</label>
                    

                <div class="col-md-6">
                        <select class="selectize" name="moderator_narasumber[]" multiple="multiple" id="morator-narasumber-id">
                            @foreach($user_ppm as $i=>$user)
                                <option value="{{$user->id}}">{{ $user->full_name_gelar }}</option>
                            @endforeach
                        </select>
                </div>
                <script type="text/javascript">
                    $('#morator-narasumber-id').selectize({       
                       /*sortField: 'text',*/
                       // allowEmptyOption: false,
                       placeholder: 'Pilih Narasumber / Moderator',
                       // closeAfterSelect: true,
                       // create: false,
                       // maxItems:10,
                       onchange: function(value){
                        // console.log(value);
                       },
                       onItemAdd: function(item){
                        $('#id-anggota-'+item).prop('checked', false);
                        $('#id-anggota-'+item).prop('disabled', true);
                        $("#name-user-"+item).css({ 'color': '#A9A9A9'});
                       },
                       onItemRemove: function(item){
                        // $('#id-anggota-'+item).prop('checked', true);
                        $('#id-anggota-'+item).prop('disabled', false);
                        $("#name-user-"+item).css({ 'color': '#525f7f'});
                       },
                    });
                    // di hide
                    // console.log($('#formPpm').modal('hide') == true);
                    /*if(){   
                        $('#morator-narasumber-id').selectize({
                            onChange(item){
                                console.log(item);
                                $('#id-anggota-'+item).prop('disabled', false);
                                $("#name-user-"+item).css({ 'color': '#525f7f'});
                            }
                        });
                    }*/
                </script>
            </div>
            <!-- end narasumber/moderator -->

            <!-- start anggota session -->
            <div class="form-group" style="margin-left: -13px;">
                <div class="col-md-2 col-form-label">{{ __('Peserta') }} </div><br>
                <div class="col-md-12">
                    <div class="row">
                        @foreach($user_ppm as $i=>$user)
                            <div class="col-md-2" id="name-user-{{$user->id}}">{{ $user->full_name_gelar }}</div>
                                <div class="col-md-1">
                                <input class="form-check-input" name="id_anggota_ppm[]" multiple="multiple" id="id-anggota-{{$user->id}}" type="checkbox" value="{{$user->id}}"></div>
                                <?php $i++ ?>
                                @if($i%4 == 0)
                                    </div><div class="row">
                                @endif
                        @endforeach
                    </div>
                    <!-- <input type="hidden" name="id_anggota_ppm" id="anggota_ppm"> -->
                </div>
                <!-- <div class="col">
                    <table id="tabel-anggota-ppm" class="col"></table>
                    <button id="add-anggota-ppm" class="btn btn-outline-primary btn-sm" type="button" data-toggle="modal" data-target="#anggotaPpmModal"> <i class="fa fa-plus"></i> <span>Tambah Anggota</span></button>
                    <small id="infoanggota" class="form-text text-muted">Anggota pertama dipilih akan automatis menjadi yang ditugaskan</small>
                </div>
                <div class="col table-responsive" id="tabel-anggota-ppm-wrapper">
                    
                </div> -->
            </div>
            <!-- end anggota session -->

            <!-- start upload note dinas ppm -->
            <div class="form-group row">                    
                <label for="nota-dinas-ppm" class="col-md-2 col-form-label">{{ __('Upload Nota Dinas') }}</label>
                <div class="col-md-8">
                     <input type="file" id="file-nota-dinas" name="file_nota_dinas" accept=".pdf">
                </div>                  
            </div>
            <!-- end upload note dinas ppm -->

            <!-- start submit ppm -->
            <div class="form-group">
                 <div class="col">
                     <button type="submit" class="btn btn-primary offset-md-2 submit-ppm">
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


<script type="text/javascript">
    /*start destroy data pada datatable lihat anggota*/
$(document).on('hide.bs.modal','#modalListAnggotaPpm', function () {
    $('#tabel-list-anggota-ppm').dataTable().fnDestroy();
});
/*end*/

$('.datepicker').each(function() {
    $(this).datepicker({
        language: "{{ config('app.locale')}}",
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });
});


$("#form-ppm").validate({
    /*rules: {
        jenis_ppm : {required: true},
        tgl_mulai_ppm : {required: true},
        tgl_akhir_ppm : {required: true},

    },*/

    submitHandler: function(form){        
        var anggota_id = []; //array user id
        $("input:checkbox[type=checkbox]:checked").each(function(){
            anggota_id.push($(this).val()); //get value anggota id checked
        });
        var anggota_array = JSON.stringify(anggota_id);
        // console.log('anggota isinya ' +anggota_array);
        $('#anggota_ppm').val(anggota_array);

        // var jenis_ppm = $("#unsur-ppm").val();
        // var kegiatan_ppm = $('#kegiatan-ppm').val();
        // var tgl_mulai_ppm = $("#tgl-mulai-ppm").val();
        // var tgl_akhir_ppm = $("#tgl-akhir-ppm").val();
        // var lama_ppm = $('#hari-ppm').val();
        // var file_nota_dinas = /*$('#file-nota-dinas').val();*/document.getElementById('file-nota-dinas').value;

        var id = $('#id-ppm').val();
        save_method_ppm = (id == '') ? 'new' : save_method_ppm;
        var url_prefix = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/ppm/' : 'ppm/';
        //url =  (save_method == 'new') ? "{{ route('spt.store') }}" : base_url + '/' + id ;
        url = (save_method_ppm == 'new') ? "{{ route('store_ppm') }}" : '' ;/*edit masih blm*/
        method = (save_method_ppm == 'new') ? "POST" : "PUT";
        type = "POST";
        var formData = new FormData($(form)[0]);

        $.ajax({
            url: url,
            type: type,
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                // console.log('success:',data);
                $("#form-ppm")[0].reset();
                $('#tabel-ppm').DataTable().ajax.reload();
                // $('#form-session-anggota-ppm')[0].reset();
                // location.reload();
                // $('#tabel-anggota-ppm-wrapper').html(data);
                $('#formPpmSatgas').modal('hide');                   
            },
            error: function(request, status, error){                      
              console.log(request);
            }
        });
    }
});

function hapus_ppm(id){   /*modal belum bisa menghapus cache pada modal*/
    // console.log(id); /*parameter id ada isinya */
    save_method = 'delete';
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: "{{ __('Hapus data PPM') }}",
        content: "{{ __('Apakah anda yakin ingin menghilangkan data PPM ini?') }}",
        buttons: {
            delete: {
                btnClass: 'btn-danger',
                action: function(){  /*button action confirm*/
                    // console.log('jalan');
                    url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'admin/delete/data-ppm/'+id : 'delete/data-ppm/'+id;

                    $.ajax({
                        url: url,
                        type: "delete",
                        data: {_method: 'delete', '_token' : csrf_token },
                        success: function(data){
                            // table.ajax.reload();
                            $('#tabel-ppm').DataTable().ajax.reload();
                            $('#form-session-anggota-ppm')[0].reset();
                            // location.reload();
                        }
                    });

                },
            },
                cancel: function(){ /*button cancel confirm*/
                    $.alert('Dibatalkan!');
                }
        }
    });
};
</script>