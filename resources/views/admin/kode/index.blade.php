{{-- Kode index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="margin-top: 30px !important;">
    <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Dashboard</a></breadcrumb-item>
      <breadcrumb-item>Dokumen</breadcrumb-item>  
      <breadcrumb-item active>/ Kode Temuan</a></breadcrumb-item>
    </breadcrumb>    
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-transparent d-flex justify-content-between row">
                   <h1 class="col-md-8">{{ __('Kode Temuan') }}</h1>
                   @include('layouts.alerts')
               </div>
                                  
                <div class="card-body row">
                    <div class="col-md-6 kode-temuan" style="border-right: 1px solid #ccc;">
                        <!-- daftar kode temuan -->
                        <h3>{{ __('Daftar Kode Temuan')}}</h3>
                        <ul id="tree-view">
                            @foreach($kelompok as $kel)
                            <li class="kelompok-{{$kel->kode}}">{{$kel->jenis}}</li>
                                @if(count($kel->childs))
                                    @include('admin.kode.kelompok',['childs' => $kel->childs])
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- <div class="col-md-4">
                        <h3>{{ __('Tambah Kode Temuan')}}</h3>
                        
                        @ include('admin.kode.form')
                    </div> -->
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.kode.js')
@include('layouts.footers.auth')
@push('css')
   <link href="{{ asset('assets/vendor/bootstrap/dist/css/bootstrap-treeview.css') }}" rel="stylesheet" />
@endpush

@endsection