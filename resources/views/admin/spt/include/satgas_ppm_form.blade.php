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
                     <textarea rows="5" id="kegiatan-ppm" class="form-control form-control-alternative @error('kegiatan') is-invalid @enderror" name="kegiatan_ppm" required></textarea>
                     <small id="infoKegiatanHelp" class="form-text text-muted">Masukkan nama <span style="color:red;">Kegiatan</span> yang sedang dilaksanakan. !</small>
                </div>
            </div>
            <!-- end kegiatana -->

            <!-- start tanggal mulai & akhir ppm -->
            <div class="form-group row">                    
                <label for="tgl-mulai-ppm" class="col-md-2 col-form-label">{{ __('Tanggal') }}</label>
                <div class="col-md-6">                      
                    <input type="text" class="form-control datepicker" name="tgl_mulai_ppm" id="tgl-mulai-ppm" autocomplete="off" placeholder="{{ __('Pilih Tanggal')}}" required="">
                </div>

                <!-- <label for="tgl-akhir-ppm" class="col-md-2 col-form-label">{{ __('Berakhir') }}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control datepicker" name="tgl_akhir_ppm" id="tgl-akhir-ppm" autocomplete="off" placeholder="{{ __('Tanggal Akhir')}}" disabled="true">
                </div> -->
                <!-- <label for="lama-ppm" class="col-md-1 col-form-label">{{ __('Lama') }}</label> -->
                <div class="col-md-4" style="display:none;">                      
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
                </script>
            </div>
            <!-- end narasumber/moderator -->

            <!-- start anggota session -->
            <div class="form-group row">
                <label class="col-md-1 col-form-label">{{ __('Peserta') }}</label>
                <div class="col-md-10 col-form-label">
                    <input type="checkbox" name="select-all" id="select-all" /> <span style="color:red;"><b>pilih semua anggota</b></span>
                </div>
            </div>

            <div class="form-group row">
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
                </div>
            </div>
            <script type="text/javascript">
                
                $('#select-all').click(function(event) {   
                        if(this.checked) {
                            // Iterate each checkbox
                            $(':checkbox').each(function() {
                                this.checked = true;                        
                            });
                        } else {
                            $(':checkbox').each(function() {
                                this.checked = false;                       
                            });
                        }
                    });

                $(".form-check-input").prop('checked', true);
                $("#select-all").prop('checked', true);
            </script>
            <!-- end anggota session -->

            <!-- start upload note dinas ppm -->
            <div class="form-group row">                    
                <label for="nota-dinas-ppm" class="col-md-2 col-form-label">{{ __('Upload Nota Dinas') }}</label>
                <div class="col-md-8">
                     <input type="file" id="file-nota-dinas" name="file_nota_dinas" accept=".pdf">
                </div>                  
            </div>
            <!-- end upload note dinas ppm -->


        </form>
            <!-- start submit ppm -->
            <div class="form-group">
                 <div class="col">
                     <button id="id-satgas-btn" class="btn btn-primary offset-md-5 submit-ppm">
                         {{ __('Submit') }}
                     </button>
                 </div>
             </div>
            <!-- end submit ppm -->

        </div>
    </div>
  </div>
</div>


<script type="text/javascript">

$('#btn-input-ppm').on('click', function(){
    $("#form-ppm")[0].reset();
    $('#id-ppm').val('');
    if( !$('#morator-narasumber-id').val() ) { 
        $(".form-check-input").removeAttr("disabled");
        $("#select-all").removeAttr("disabled");
        $(".form-check-input").css({ 'color': '#525f7f'});
        $(".form-check-input").prop('checked', true);
        $("#form-ppm")[0].reset();
        $('#kegiatan-ppm').prop('disabled', false);
        $('#tgl-mulai-ppm').prop('disabled', false);
        $('#id-btn-submit').show();
        $('div .col-md-2').attr('style', 'rgb(82 95 127)');
        // console.log('jalan');
        $('#id-satgas-btn').show();
        $('#file-nota-dinas').show();
        $('#infoKegiatanHelp').show();
        $("#morator-narasumber-id")[0].selectize.enable();
    }
});

$('#close-modal-form-input-PPM').on('click', function(){
    $(".form-check-input").removeAttr("disabled");
    $("#form-ppm")[0].reset();
    var $select = $('#morator-narasumber-id').selectize();
    var control = $select[0].selectize;
    control.clear();
});

function show_ppm(id){
    $("#form-ppm")[0].reset();
    $('#id-ppm').val(id);
    $('#formPpmSatgas').modal('show');
    var id_ppm = $('#id-ppm').val();
    if (id_ppm != null) {
        $('#id-satgas-btn').hide();
        $('#file-nota-dinas').hide();
        $('#infoKegiatanHelp').hide();
        $('#id-btn-note-dinas').show();
        $('#kegiatan-ppm').prop('disabled', true);
        $('#tgl-mulai-ppm').prop('disabled', true);
        $('#select-all').prop('disabled', true);
        $("#morator-narasumber-id")[0].selectize.disable();
    }
    // $('')
    // get-valueData-ppm/{id}
    save_method = 'edit';
        url = "{{ url('admin/ppm/get-valueData-ppm/') }}/" +id_ppm;
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                
                // set value kegiatan
                $('#kegiatan-ppm').val(data[0].ppm.kegiatan);
                
                $('#tgl-mulai-ppm').val(data[0].ppm.tgl_mulai);
                // $('#tgl-mulai').val(data.tgl_mulai);
                if (data[0].nama_file == null) {
                    $('#id-btn-note-dinas').val(data[0].nama_file);
                }else{
                    $('#id-btn-note-dinas').hide();
                }


                var moderator = [];

                $.each(data, function(i,item){
                    if(data[i].peran == 'Moderator'){
                        moderator.push(item.user_id);
                        $('#id-anggota-'+item.user_id).prop('checked', false);
                        // $('#id-anggota-'+item.user_id).attr("disabled", true);
                        $('#id-anggota-'+item.user_id).prop('disabled', true);
                    }
                    if(item.peran == 'Peserta'){
                        $('#id-anggota-'+item.user_id).prop('checked', true);
                        $('#id-anggota-'+item.user_id).prop('disabled', true);
                    }
                });
                $('#morator-narasumber-id')[0].selectize.setValue(moderator);

            },
            error: function(err){
                
            }
        });
};


$('#id-satgas-btn').click(function(){
    $.confirm({
        title: "{{ __('Perhatian!') }}",
        content: "{{ __('Silahkan review kembali data PPM sebelum anda menyimpannya, karena PPM tidak dapat dirubah') }}",
        autoClose: 'Tidak|5000',
        buttons: {
            Ya: {
                btnClass: 'btn-primary simpan-ppm',
                action: function(){                       
                    $('#form-ppm').submit();
                },
            },
            Tidak: function(){
                $.alert('Silahkan review kembali data PPM!');
            }
        }
    });
});

    /*start destroy data pada datatable lihat anggota*/
$(document).on('hide.bs.modal','#modalListAnggotaPpm', function () {
    $('#tabel-list-anggota-ppm').dataTable().fnDestroy();
    $("#form-ppm")[0].reset();
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
</script>