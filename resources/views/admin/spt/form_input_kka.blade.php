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
                        <h1>{{ __('Input Temuan') }}</h1>
                    </div>
                    <div class="col-md-12 role-form">
                        @csrf
                            <!-- get data nomor spt -->
                            @foreach($spt as $data)
                            <!--  get data nama spt -->
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">{{ __('Jenis SPT') }}</label>
                                <div class="col-md-9">
                                    <input type="text" placeholder="{{ $data->spt->jenisSpt->sebutan }}" class="form-control" disabled />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">{{ __('Nomor SPT') }}</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="800/{{ $data->spt->nomor }}/2019" class="form-control" disabled />
                                    </div>
                            </div>
                            @endforeach
                            <form id ="laporan-form" action="{{route('laporan_auditor')}}" method="post" enctype="multipart/form-data">
                                <input name="spt_id" id="id" type="hidden" value="{{$data->spt_id}}">
                                <input name="detai_spt_id" id="id" type="hidden" value="{{$data->id}}">
                                @csrf
                            <!-- <div class="form-group row">
                                <span class="col-md-2 text-md-right">{{ __('Jenis Laporan') }}</span>
                                <div class="col-md-10 row">
                                    <div class="col">

                                        <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" class="custom-control-input" id="Jlaporan-kkp" name="jenis_laporan" value="KKA" onclick="showresponddiv(this.id)"<?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>>
                                                <label class="custom-control-label" for="Jlaporan-kkp">KKA</label>
                                        </div>

                                        <p><small>silahkan pilih jenis laporan</small></p>
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group kkp" id="form-kkp">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right">{{ __('Data Inputan KKA') }}</label>
                                    <div class="col-md-3">
                                        <select class="form-control selectize" id="kode" name="file_laporan[kode_temuan_id]">
                                            <option value="">{{ __('Pilih Kode Temuan') }}</option>
                                            @foreach($kode as $kel)
                                                    <option class="form-control" value="{{$kel->id}}" >{{$kel->select_supersub_kode}} {{$kel->deskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="sasaran_audit-file_laporan" name="file_laporan[sasaran_audit]" class="form-control" placeholder="{{ __('Sasaran Audit') }}"<?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                        <input type="text" id="judultemuan-file_laporan" name="file_laporan[judultemuan]" class="form-control" placeholder="{{ __('Judul Temuan') }}"<?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <!-- <textarea class="form-control" id="kondisi_id" name="kondisi" placeholder="Kondisi"></textarea> -->
                                            <textarea id="summernote-kondisi" name="file_laporan[kondisi]"></textarea>
                                            <!-- <textarea name="editor1" class="ckeditor"></textarea> -->
                                            <span class="invalid-kondisi" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <!-- <textarea id="summernote-kriteria" name="file_laporan[kriteria]"></textarea> -->
                                            <textarea id="summernote-kriteria" name="file_laporan[kriteria]"></textarea>
                                            <span class="invalid-kriteria" permission="alert"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control selectize" id="ref">
                                            <option value="">{{ __('Pilih Refrensi') }}</option>
                                            <!-- {{$refrensi}} -->
                                            @foreach($refrensi as $data)
                                                <option  class="form-control" value="<?php $decoded = base64_decode($data->refrens_kka, true);?>
                                                    <?php if(base64_encode($decoded) != $data->refrens_kka) {  echo json_decode($data->refrens_kka);?>
                                                            <?php ?>
                                                    <?php }?>" ><?php $decoded = base64_decode($data->refrens_kka, true);?>
                                                    <?php if(base64_encode($decoded) != $data->refrens_kka) {  echo json_decode($data->refrens_kka);?>
                                                            <?php ?>
                                                    <?php }?>
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group lhp" id="form-lhp" style="display: none;">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <textarea type="text" id="kriteria-file_laporan" class="form-control @error('kriteria') is-invalid @enderror" name="file_laporan[kriteria]"placeholder="{{ __('Kriteria') }}" <?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>></textarea>               
                                        <span class="invalid-kriteria" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <textarea type="text" id="sebab-file_laporan" class="form-control @error('sebab') is-invalid @enderror" name="file_laporan[sebab]"placeholder="{{ __('Sebab') }}" <?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>></textarea>              
                                            <span class="invalid-sebab" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <textarea type="text" id="akibat-file_laporan" class="form-control @error('akibat') is-invalid @enderror" name="file_laporan[akibat]"placeholder="{{ __('Akibat') }}" <?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>></textarea>               
                                        <span class="invalid-akibat" permission="alert"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-md-right"></label>
                                    <div class="col-md-6">
                                            <textarea type="text" id="komen-file_laporan" class="form-control @error('komen') is-invalid @enderror" name="file_laporan[komen]"placeholder="{{ __('Komen') }}" <?php if($cek_radiobutts != 'disabledleforfile'){ echo "disabled"; }?>></textarea>              
                                            <span class="invalid-komen" permission="alert"></span>
                                        
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary offset-md-3">
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


