{{-- Pejabat index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 20px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Dashboard</a></breadcrumb-item> 
      <breadcrumb-item>/ Kepegawaian</breadcrumb-item> 
      <breadcrumb-item active>/ Penunjukan Pejabat</a></breadcrumb-item>
    </breadcrumb>
	<div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent text-center">
                    <h1 class="">{{ __('Penunjukan Pejabat') }}</h1>
                </div>
                <div class="alert"></div>
                <div class="card-body">
                    @csrf
                    <form id="satgas_ppm" class="ajax-form needs-validation" novalidate>

                    <!-- inspektur -->
                    <div class="form-group row">
                        <label for="inspektur" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="inspektur" name="inspektur">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_inspektur = (!is_null($inspektur['user']) && $user->id == $inspektur['user']->id) ? 'selected' : '';                                    
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_inspektur }} >{{ $user->full_name_gelar }}</option>                               
                                @endforeach
                            </select>                            
                        </div>
                        @if($inspektur['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif                        
                    </div>

                    <!-- sekretaris -->
                    <div class="form-group row">
                        <label for="sekretaris" class="col-md-2 col-form-label text-md-right">{{ __('Sekretaris') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="sekretaris" name="sekretaris">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_sekretaris = (!is_null($sekretaris['user']) && $user->id == $sekretaris['user']->id) ? 'selected' : '';                                    
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_sekretaris }} >{{ $user->full_name_gelar }}</option>                               
                                @endforeach
                            </select>                            
                        </div>
                        @if($sekretaris['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif
                    </div>

                    <!-- irban 1 -->
                    <div class="form-group row">
                        <label for="irban_i" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah I') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="irban-i" name="irban_i">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_irban_i = (!is_null($irban_i['user']) && $user->id == $irban_i['user']->id) ? 'selected' : '';
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_i }} >{{ $user->full_name_gelar }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($irban_i['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif
                    </div>

                    <!-- irban 2 -->
                    <div class="form-group row">
                        <label for="irban_ii" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah II') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="irban-ii" name="irban_ii">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_irban_ii = (!is_null($irban_ii['user']) && $user->id == $irban_ii['user']->id) ? 'selected' : '';
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_ii }} >{{ $user->full_name_gelar }}</option>
                                @endforeach
                            </select>
                        </div>
                         @if($irban_ii['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif
                    </div>

                    <!-- irban 3 -->
                    <div class="form-group row">
                        <label for="irban_iii" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah III') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="irban-iii" name="irban_iii">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_irban_iii = (!is_null($irban_iii['user']) && $user->id == $irban_iii['user']->id) ? 'selected' : '';
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_iii }} >{{ $user->full_name_gelar }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($irban_iii['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif
                    </div>

                    <!-- irban 4 -->
                    <div class="form-group row">
                        <label for="irban_iv" class="col-md-2 col-form-label text-md-right">{{ __('Inspektur Pembantu Wilayah IV') }}</label>
                        <div class="col-md-4">
                            <select class="form-control selectize" id="irban-iv" name="irban_iv">
                                <option value="">{{ __('Pilih Pejabat') }}</option>
                                @foreach($users as $user)
                                <?php
                                    $selected_irban_iv = (!is_null($irban_iv['user']) && $user->id == $irban_iv['user']->id) ? 'selected' : '';
                                ?>
                                <option class="form-control selectize" value="{{$user->id}}" {{ $selected_irban_iv }}>{{ $user->full_name_gelar }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($irban_iv['is_plt'] === true)
                            <div class="col-md-2 col-form-label "><span class="is_plt">PLT</span></div>
                        @endif
                    </div>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
      $('.selectize').selectize({
       /*sortField: 'text',*/
       allowEmptyOption: false,
       placeholder: 'Pilih Pejabat',
       create: false
  });
</script>
@include('layouts.footers.auth')
@include('admin.permission.js')
@endsection
@push('css')
    <link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>    
@endpush