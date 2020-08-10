 @hasanyrole('Super Admin|TU Perencanaan|TU Umum')
  @include('admin.spt.penomoran')
  @include('admin.spt.arsip')
@endhasrole
 <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="spt-list" role="tablist">
            @yield('nav_tab_penomoran')
            @yield('nav_tab_arsip')
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
            @yield('tab_content_penomoran')
            @yield('tab_content_arsip')
          </div>
          
        </div>
    </div>     
  </div>
  <script type="text/javascript">
    $('#spt-list a').on('click', function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
  </script>
  @yield('form_penomoran')
  @yield('js_penomoran')
  @yield('js_arsip')
@include('admin.spt.form')
@include('admin.spt.js')

@push('css')
  <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
  <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bsdatepicker/locales/bootstrap-datepicker.'.config("app.locale").'.min.js') }}" charset="UTF-8"></script>
@endpush