{{-- Pejabat index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 20px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Dashboard</a></breadcrumb-item> 
      <breadcrumb-item>/ Dokumen</breadcrumb-item> 
      <breadcrumb-item active>/ PPM</a></breadcrumb-item>
    </breadcrumb>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent text-center">
                    <h1 class="">{{ __('Data Program Pelatihan Mandiri') }}</h1>
                </div>
                <div class="alert"></div>
                <div class="card-body">
                    <button id="btn-input-ppm" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#formPpm" style="margin-left: 170px;margin-bottom: 20px;">{{ __('Tambah PPM') }}</button><br>
                    <div class="col-md-10" style="float:none;margin:auto;">

                        <!-- start tabel data ppm -->
                        <div class="table-responsive">
                            <table id="tabel-ppm" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <!-- end tabel -->

                        <!-- starat js tabel pelatihan mandiri tanpa spt -->
                        <script type="text/javascript">
                            var table = $('#tabel-ppm').DataTable({        
                                'pageLength': 10,
                                dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
                                buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
                                language: {
                                    paginate: {
                                      next: '&gt;', 
                                      previous: '&lt;' ,
                                    },
                                },
                                
                                "opts": {
                                  "theme": "bootstrap",
                                },
                                processing: true,
                                serverSide: true,
                                ajax: "{{ route('getdata_ppm') }}",
                                /*deferRender: true,*/
                                columns: [
                                    {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
                                    },
                                    {data: 'kegiatan', name: 'kegiatan', 'title': "{{ __('Kegiatan') }}"},
                                    {data: 'lama', name: 'lama', 'title': "{{ __('Lama') }}"},
                                    {data: 'nota', name: 'nota', 'title': "{{ __('Nota Dinas') }}"},
                                    {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
                                ],        
                                "order": [[ 1, 'asc' ]],
                            });
                        </script>
                        <!-- end js -->

                    </div>
                </div>
                    <div class="col-md-12">
                        @include('admin.ppm.form_ppm')
                    </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth')

@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>    
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush