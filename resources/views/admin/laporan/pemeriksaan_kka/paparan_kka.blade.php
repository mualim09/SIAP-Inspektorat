{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<?php
    $i=0; 
    $dasar_spt = array_filter(explode("\n",strip_tags($data_jenis_spt->dasar))); //explode by new line (ENTER)
    $dasar = '';
    
    if(count($dasar_spt)>1){
        foreach($dasar_spt as $dasar2){
            $i = $i+1;
                $dasar .= '<tr>';
                $dasar .= "<td align=\"left\" valign=\"top\" style=\"width:4%\">" . $i. ".</td>";
                $dasar .= "<td style=\"width:100%\">" . $dasar2. "</td>";
                $dasar .= "</tr>";
        }
    }else{
        $dasar .= '<tr>';
        $dasar .= "<td align=\"left\" valign=\"top\" colspan=\"2\">" . $data_jenis_spt->dasar. ".</td>";
        $dasar .= "</tr>";
    }
?>

<div class="container-fluid bg-color" style="margin-top: 45px !important;">
    <div class="row">
        <div class="col col-xl-10 center">
            <div class="card shadow">
                <div class="card-body">
                    <div class="isi paparan" style="margin-left: 300px;margin-right: 300px;">
                        <div id="kop-surat">@include('admin.laporan.header')</div>

                        <div class="judul_paparan">
                            <p style="text-align: center;font-weight: bold;">PAPARAN HASIL PEMERIKSAAN REGULER <br>{{$data_lokasi->nama_lokasi}}<br>TAHUN ANGGARAN {{$tahun}}</p>
                        </div><br>
                        
                        <form id="input-paparan" class="ajax-form needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="id_detail" id="id_detail" value="{{$data_pemeriksaan[0]->detail_spt_id}}">
                            <table class="tabel simpulan">
                                <?php
                                    //judultemuan yang ditampilkan hanya data dari anggota tim
                                    foreach ($data_pemeriksaan as $key => $value) {
                                        $number = $key + 1;
                                        echo "<tr>";
                                        echo "<td>".$number.". ".$value->judultemuan."<br>".'<p style="">Kondisi</p>'.str_replace('www/kosong', $value->url_img_laporan,$value->kondisi)."<br>".'<p style="">Kriteria</p>'.json_decode($value->kriteria)."</td>";
                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td>".'Komentar yang diperiksa<br><div class="point isi-hasil-pemeriksaan" style="width: 97%;margin-left: 20px;margin-top: 0px;"><textarea type="textarea" class="form-control" name="point_komentar['.$value->id.']"></textarea></div>'."<br><br></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </table>
                            <br>
                            <div style="text-align:center;">
                                <button class="btn btn-success" id="finish" type="submit" style="background-color: #2dce89;border: 0px;">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
// buatkan validasi ajax
    // {{route('input-paparan')}}
    $("#input-paparan").validate({
        rules: {
            // id : {required: true},
            id_detail : {required: true},
            point_komentar : {required: true}

        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            // var id = $('#id').val();
            var id_detail = $('#id_detail').val();

            base_url = "{{route('input-paparan')}}";
            // console.log(base_url)
            url =  (save_method == 'new') ? base_url : base_url + '/' + id_detail ;
            type = (save_method == 'new') ? "POST" : "PUT";        
            $.ajax({
                url: url,
                type: type,
                data: $('#input-paparan').serialize(),
                dataType: 'text',
                success: function(data){
                    var url = '{{ route("input_lhp", ":id") }}';
                    url = url.replace(':id', id_detail);
                    document.location = url;
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
    <link href="{{ asset('assets/jquery-smartwizard-master/dist/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/summernote-master/dist/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-smartwizard-master/dist/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush


