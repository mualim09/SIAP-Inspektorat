@extends('layouts.backend')

@section('content')
	@role('Administrasi Umum')
		@include('layouts.headers.cards')
	@endrole
	@role('TU Perencanaan')
		@include('layouts.headers.cards')
	@endrole
	@role('Auditor')
		@include('layouts.headers.cards')
	@endrole
	@role('Super Admin')
		@include('layouts.headers.cards')
	@endrole
	@role('Inspektur')
		@include('layouts.headers.cards')
	@endrole
	@role('TU Evaluasi')
		@include('layouts.headers.cards')
	@endrole
	<div style="margin-top: 20px !important;">
		@role('Administrasi Umum')
		<breadcrumb list-classes="breadcrumb-links" style="padding-left: 18px;">
		  <breadcrumb-item active>Beranda</breadcrumb-item>
		</breadcrumb>
			@include('admin.dashboard.umum')
		@endrole
		@role('TU Perencanaan')
		<breadcrumb list-classes="breadcrumb-links" style="padding-left: 18px;">
		  <breadcrumb-item active>Beranda</breadcrumb-item>
		</breadcrumb>
			@include('admin.dashboard.rencana')
		@endrole
		@role('Auditor')
		<breadcrumb list-classes="breadcrumb-links" style="padding-left: 18px;">
		  <breadcrumb-item active>Beranda</breadcrumb-item>
		</breadcrumb>
			@include('admin.dashboard.auditor')
		@endrole
		@role('Super Admin')
		<breadcrumb list-classes="breadcrumb-links" style="padding-left: 18px;">
		  <breadcrumb-item active>Beranda</breadcrumb-item>
		</breadcrumb>
			@include('admin.dashboard.admin')
		@endrole
		@role('Inspektur')
			@include('admin.dashboard.inspektur')
		@endrole
		@role('TU Evaluasi')
		<breadcrumb list-classes="breadcrumb-links" style="padding-left: 18px;">
		  <breadcrumb-item active>Beranda</breadcrumb-item>
		</breadcrumb>
			@include('admin.dashboard.eval')
		@endrole
	</div>
	@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">    
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
@endpush