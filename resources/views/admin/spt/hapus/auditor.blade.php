{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: -50px !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center" style="margin-bottom: 40px;">
                        <h1>{{ __('Input Temuan') }}</h1>
                    </div>
                    @include('admin.spt.laporanAuditor')
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


