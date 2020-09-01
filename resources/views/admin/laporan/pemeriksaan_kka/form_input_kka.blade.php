{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 45px !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center" style="margin-bottom: 40px;">
                        <h1>{{ __('Input Temuan KKA') }}</h1>
                    </div>
                    <div class="col-md-12 role-form">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">{{ __('Lokasi Pemeriksaan') }}</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="{{ $lokasi_pemeriksaan->nama_lokasi }}" class="form-control" disabled />
                                </div>
                            </div>
                            <form id ="laporan-kka-form" class="ajax-form needs-validation" novalidate>
                                @csrf

                                <input name="spt_id" id="id" type="hidden" value="{{$spt[0]->spt_id}}">
                                <input name="detai_spt_id" id="id" type="hidden" value="{{$spt[0]->id}}">

                            <div class="form-group kkp" id="form-kkp">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right">{{ __('Input Data KKA') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-control selectize" id="kode" name="file_laporan[kode_temuan_id]">
                                            <option value="">{{ __('Pilih Kode Temuan') }}</option>
                                            @foreach($kode as $kel)
                                                    <option class="form-control" value="{{$kel->id}}" >{{$kel->select_supersub_kode}} {{$kel->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-9">
                                        <input type="text" id="sasaran_audit-file_laporan" name="file_laporan[sasaran_audit]" class="form-control" placeholder="{{ __('Sasaran Audit') }}"<?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-9">
                                        <input type="text" id="judultemuan-file_laporan" name="file_laporan[judultemuan]" class="form-control" placeholder="{{ __('Judul Temuan') }}"<?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-9">
                                            <textarea id="summernote-kondisi" name="file_laporan[kondisi]"></textarea>
                                            <span class="invalid-kondisi" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-9">
                                            <textarea id="summernote-kriteria" name="file_laporan[kriteria]"></textarea>
                                            <span class="invalid-kriteria" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-9">
                                        <select class="form-control selectize" id="ref" disabled="">
                                            <option value="">{{ __('Pilih Refrensi') }}</option>
                                            <!-- {{$refrensi}} -->
                                            @foreach($refrensi as $data)
                                                <option  class="form-control" value="<?php $decoded = base64_decode($data->refrens_kka, true);?>
                                                    <?php if(base64_encode($decoded) != $data->refrens_kka) {  echo json_decode($data->refrens_kka);?>
                                                            <?php ?>
                                                    <?php }?>"><?php $decoded = base64_decode($data->refrens_kka, true);?>
                                                    <?php if(base64_encode($decoded) != $data->refrens_kka) {  echo json_decode($data->refrens_kka);?>
                                                            <?php ?>
                                                    <?php }?>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="col-md-2 text-md-right">{{ __('Lain - lain') }}</span>
                                    <div class="col-md-10 row">
                                        
                                        <div class="col">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" name="roles[]" value="role" id="role-1" class="custom-control-input" disabled="">
                                                <label for="role-1" class="custom-control-label">Tambahan</label>
                                            </div>
                                            <h6>Jika dibutuhkan</h6>
                                        </div>
                                        
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    //#role-5 is role id for auditor. see role table
                                    $('#role-1').change(function() {
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

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary offset-md-3">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                    </div>

                </div>           
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //function select kode temuan
    $(function(){
        $("#kode").change(function() {
            var displayselected=$("#kode option:selected").text();
            $("#judultemuan-file_laporan").val(displayselected);
        })
    })

    $(function(){
        $("#ref").change(function() {
            var displayselected=$("#ref option:selected").text();
            $("#summernote-kriteria").val(displayselected);
            $('#summernote-kriteria').summernote('code', displayselected);
        })
    })

    $('#summernote-kondisi').summernote({
        placeholder: 'Kondisi',
        // codeviewFilterRegex: '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi',
        // codeviewFilterRegex: /<\/*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|ilayer|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|t(?:itle|extarea)|xml)[^>]*?>/gi,
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

     $('#kode').selectize({    
        /*sortField: 'text',*/
        allowEmptyOption: false,
        placeholder: 'Pilih Kode Temuan',
        create: false,
        onchange: function(value){
         
        },
    });

    $('#ref').selectize({    
            /*sortField: 'text',*/
            allowEmptyOption: false,
            placeholder: 'Pilih Refrensi',
            create: false,
            onchange: function(value){
             
        },
    });

    var current = null;
    function showresponddiv(messagedivid){
        var id = messagedivid.replace("Jlaporan-", "form-"),
            div = document.getElementById(id);
        // hide previous one
        if(current && current != div) {
            current.style.display =  'none';
        }   
        if (div.style.display=="none"){
            div.style.display="inline";
            current = div;
        } 
        else {
            div.style.display="none";
        }
    }

    $("#laporan-kka-form").validate({
        rules: {
            spt_id : {required: true},
            detai_spt_id : {required: true},
            file_laporan : {required: true}

        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            var id = $('#id').val();

            base_url = "{{route('laporan_auditor')}}";
            // console.log(base_url)
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        
            $.ajax({
                url: url,
                type: type,
                data: $('#laporan-kka-form').serialize(),
                dataType: 'text',
                success: function(data){
                    console.log(data);
                    window.location.reload();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        }
    });
    

</script>


@include('layouts.footers.auth')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/summernote-master/dist/summernote-lite.min.css') }}" rel="stylesheet">
    
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/summernote-master/dist/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush


