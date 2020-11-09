@section('nav_tab_ppm')
<li class="nav-item">
  <a class="nav-link" href="#ppm-tab" role="tab" aria-controls="ppm-tab" aria-selected="true">PPM</a>
</li>
@endsection

@section('tab_content_ppm')
<div class="tab-pane" id="ppm-tab">
    <div class="card-header bg-transparent text-center">
        <h1 class="">{{ __('Form Program Pelatihan Mandiri') }}</h1>
    </div>
    <!-- <div class="alert"></div> -->
    <div class="card-body">
        @include('admin.ppm.form_ppm')
    </div>
</div>
@endsection

@section('js_ppm')
<script type="text/javascript">
    
    // get id ppm sebelumnya buat parameter pembeda
    // $("#form-input-ppm").validate({

    //     submitHandler: function(form){
            
    //         // var inspektur = $('select[name=inspektur] option').filter(':selected').val();
    //         // var sekretaris = $('select[name=sekretaris] option').filter(':selected').val();
    //         // var irban_i = $('select[name=irban_i] option').filter(':selected').val();
    //         // var irban_ii = $('select[name=irban_ii] option').filter(':selected').val();
    //         // var irban_iii = $('select[name=irban_iii] option').filter(':selected').val();
    //         // var irban_iv = $('select[name=irban_iv] option').filter(':selected').val();
    //         // alert(inspektur+'<br/>'+sekretaris+'<br/>'+irban_i+'<br/>'+irban_ii+'<br/>'+irban_iii+'<br/>'+irban_iv+'<br/>');

    //         url = "{{ route('submit_pejabat') }}"

    //         $.ajax({
    //             url: url,
    //             type: "POST",
    //             data: $('.ajax-form').serialize(),
    //             success: function($data){
    //                 $('.ajax-form')[0].reset();
    //                 // location.reload();
    //                 success(data);
    //             },
    //             error: function($data){
    //                 error(data);
    //             }
    //         });
    //     }
    // });

</script>
@endsection