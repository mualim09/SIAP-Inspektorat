@hasanyrole('Super Admin|Administrasi Umum')
	@include('admin.spt.form_umum')
@endhasanyrole
@hasanyrole('Super Admin|TU Perencanaan')
	@include('admin.spt.form_pengawasan')
@endhasanyrole


@push('css')
	<link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/vendor/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" />
@endpush
@push('js')
	<script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>	
    <script src="{{ asset('assets/vendor/selectize/js/standalone/selectize.min.js') }}"></script>
@endpush