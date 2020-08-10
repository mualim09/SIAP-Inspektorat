<!-- handebar detail -->
<script type="text/javascript">

    $(".ajax-form").validate({
        rules: {
            nama_skpd : {required: true},
            tujuan : {required: true, minlength: 6},
            sasaran : {required: true, minlength: 6},
            sasaran_kegiatan : {required: true, minlength: 6},
            detail_tujuan_kegiatan : {required: true, minlength: 6},
            nama_kegiatan : {required: true, minlength: 6},
            tujuan_kegiatan : {required: true, minlength: 6},            
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "{{ route('skpd') }}"
            url =  base_url ;
            type = (save_method == 'new') ? "POST" : "PUT";        

            $.ajax({
                url: url,
                type: 'POST',
                data: $('.ajax-form').serialize(),
                success: function($data){
                    $('.ajax-form')[0].reset();
                    table.ajax.reload();
                    console.log('Success!', $data);
                },
                error: function($data){
                    /*console.log('Error:', $data);*/
                    $('.ajax-form')[0].reset();
                    table.ajax.reload();
                }
            });
        }
    });
</script>