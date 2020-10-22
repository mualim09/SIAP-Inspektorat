{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 20px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item>
      <breadcrumb-item>/ Dupak</breadcrumb-item>
      <breadcrumb-item active>/ Data Dupak</a></breadcrumb-item>
    </breadcrumb>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <!-- <div class="card-header bg-transparent d-flex">
                   <h1 class="col-md-12">{{ __('Angka Kredit Pengawasan') }}</h1>
                </div> -->


                <div class="card-body">
                    <div class="col-md-12 justify-content-between row">
                       <!-- <div class="col-md-9">
                           <div class="row">
                               <span class="col-md-3">{{ __('Nama Auditor') }}</span>
                               <span class="col">
                                    @role('Auditor')
                                      {{ Auth::user()->full_name }}
                                    @endrole
                                    @hasanyrole('TU Umum|Super Admin|Tim Dupak|TU Perencanaan')
                                        {{ __('<< Nama auditor dari process request >>') }}
                                    @endhasanyrole
                               </span>
                           </div>
                       </div> -->

                       <!-- dibawah ini adalah form pencariandupak berdasarkan nama auditor, semester dan tahun -->
                       <div class="col-md-6 mb-3">
                            <form id="form-cari-dupak">
                              @hasanyrole('Super Admin|TU Perencanaan|TU Umum')
                              <!-- hanya ditampilkan kepada user yang memiliki role super admin, perencanaan, dan umum. -->
                              <div class="form-row mb-2">
                                  <div class="col-md-9">
                                    <select class="form-control selectize" id="user-id" name="user_id" placeholder="Nama Auditor"></select>
                                  </div>
                              </div>
                              <script type="text/javascript">
                                $('#user-id').selectize({
                                    valueField: 'id',
                                    labelField: 'name',
                                    searchField: 'name',
                                    options: [],
                                    create: false,
                                    load: function(query, callback){
                                      if (!query.length) return callback();
                                      $.ajax({
                                          url: "{{ route('get_auditor') }}",
                                          type: 'GET',
                                          dataType: 'json',
                                          data:{name:query},

                                          error: function(err) {
                                            callback();
                                          },
                                          success: function(result) {
                                            callback(result);
                                           }
                                        });
                                    },
                                });
                              </script>
                              @endhasanyrole

                              <div class="form-row">
                                <div class="col-md-6">
                                    <select class="form-control selectize" id="semester" name="semester">
                                        <option value="" selected disabled>Periode Semester</option>
                                        <option value="1">Januari s.d Juni</option>
                                        <option value="2">Juli s.d Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                  <input type="text" class="form-control" name="tahun" id="tahun" autocomplete="off" placeholder="{{ __('Tahun')}}" value="{{date('Y')}}">
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary" id="cari-dupak">Cari</button>
                                </div>
                              </div>
                            </form>
                       </div>
                    </div>
                    <!-- <div class="table-responsive">
                        <table class="table table-striped table-sm table-bordered ajax-table" id="list-dupak-table">
                        </table>
                    </div> -->
                    <div id="btn-show-dupak" class="row">
                      <a href="#dupak-pengawasan" class="btn btn-default" > Pengawasan </a>
                      <a href="#dupak-pendidikan" class="btn btn-default" > Pendidikan </a>
                      <a onclick="exports();" href="#" class="btn btn-default" > Export js </a>
                      <button onclick="printDiv('print-dupak')">Print only the above div</button>
                    </div>

                    <!-- <ul class="nav nav-tabs justify-content-end">
                      <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#pengawasan">Pengawasan</a></li>
                      <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#pendidikan">Pendidikan</a></li>
                      <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#penunjang">Penunjang</a></li>
                    </ul> -->

                    <div class="dupak-content" id="print-dupak">
                      <div id="dupak-pengawasan" class="mb-20" style="margin-bottom: 30px;">
                        <div class="table-responsive" id="dupak-pengawasan-wrapper">
                            <table class="table table-sm table-bordered ajax-table col-print-12" id="dupak-pengawasan-table">
                            </table>
                        </div>
                      </div>
                      <div id="dupak-pendidikan" class="mb-20" style="margin-bottom: 30px;">
                        <div class="table-responsive ">
                            <table class="table table-sm table-bordered ajax-table col-print-12" id="dupak-pendidikan-table">
                            </table>
                        </div>
                      </div>
                      <div id="dupak-penunjang" class="mb-20" style="margin-bottom: 30px;">
                        <div class="table-responsive ">
                            <table class="table table-sm table-bordered ajax-table col-print-12" id="dupak-penunjang-table">
                            </table>
                        </div>
                      </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.dupak.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor/jquery/print.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/datatables/xlsx.full.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/jquery/print.min.js') }}"></script>
    <script lang="javascript" src="{{ asset('assets/vendor/datatables/FileSaver.min.js') }}"></script>
@endpush
