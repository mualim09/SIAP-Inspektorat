<!-- handebar detail -->
<script type="text/javascript">

    $(".ajax-form").validate({
        rules: {
            file : {required: true},         
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            id = $('#id').val();
            base_url = "{{ route('/laporan-auditor') }}"
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