<script type="text/javascript">
    /*datatable setup*/
    var table = $('.ajax-table').DataTable({        
        language: {
            paginate: {
              next: '&lt;', 
              previous: '&gt;'  
            }
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: '{{ url("/admin/users/getdata") }}',
        columns: [
            {
                'defaultContent' : '',
                'data'           : 'DT_RowIndex',
                'name'           : 'DT_RowIndex',
                'title'          : 'No',
                'render'         : null,
                'orderable'      : false,
                'searchable'     : false,
                'exportable'     : false,
                'printable'      : true,
                'footer'         : '',
            },
            {data: 'nip', name: 'nip', title: 'NIP'},
            {data: 'full_name', name: 'full_name', title: 'Nama Lengkap'},
            {data: 'email', name: 'email', title:'Email'},
            {data: 'phone', name: 'phone',title:'Telp.'},
            {data: 'pendidikan', name: 'pendidikan',title:'Pendidikan'},
            // {data: 'sertifikat', name: 'sertifikat',title:'sertifikat'},
            {data: 'jabatan', name: 'jabatan', title:'Jabatan'},
            {data: 'ruang_jabatan', name: 'ruang_jabatan', title:'Ruang/Jabatan'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title: 'Action'},
        ],
        columnDefs: [             
              { "width": "150px", "targets": 3 },
              { "searchable": false, "orderable": false, "targets": 0 },            
            ],
        "order": [[ 1, 'asc' ]],
        
    });
    function editForm(id){        
        save_method = 'edit';
        url = "{{ url('admin/users') }}/" +id+"/edit";
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
               console.log(data);
                $('.ajax-form')[0].reset();
                $('#id').val(data.id);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#gelar').val(data.gelar);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#nip').val(data.nip);
                $('#'+data.sex).prop('checked',true);
                $('#jabatan')[0].selectize.setValue(data.jabatan);
                $('#pangkat')[0].selectize.setValue(data.pangkat);
                $('#tempat-lahir').val(data.tempat_lahir);
                $('#tanggal-lahir').datepicker('setDate', data.tanggal_lahir);
                $(data.roles).each(function(i,val){
                    $('#role-'+val.id).prop('checked',true);
                    if(val.name == 'Auditor'){
                        $('#jenis-auditor').show('fast');
                    }
                });
                if(data.jenis_auditor != null){
                    $('#auditor-'+data.jenis_auditor).prop('checked', true);
                }
                if(data.pendidikan != null){
                    $('#tahun-pendidikan').val(data.pendidikan.tahun);
                    $('#tingkat-pendidikan')[0].selectize.setValue(data.pendidikan.tingkat);
                    $('#jurusan-pendidikan').val(data.pendidikan.jurusan);
                }
                
                $('input[type=password]').each(function(){
                    $(this).prop('required', false);
                });
                if(data.sertifikat != null){
                    for(i=1;i<=5;i++){
                        $('#tahun-sertifikat-'+i).val(data.sertifikat[i].tahun);
                        $('#nama-sertifikat-'+i).val(data.sertifikat[i].name);
                        $('#instansi-sertifikat-'+i).val(data.sertifikat[i].instansi);
                    }
                }                
                
                $('html, body').animate({
                    scrollTop: $("#user-card").offset().top
                }, 500);
            }
        });
    }
    
    function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.confirm({
            title: "{{ __('Hapus data pegawai?') }}",
            content: "{{ __('Menghapus data pegawai akan menghapus seluruh data terkait pegawai, lanjutkan ?') }}",
            autoClose: 'cancelAction|8000',
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        url = "{{ url('admin/users') }}/" +id;
                        $.ajax({
                            url: url,
                            type: "POST",                
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                table.ajax.reload();
                            }
                        });
                    },
                },
                cancelAction: function () {
                    $.alert('Dibatalkan!');
                }
            }
        });        
    }
    $(".ajax-form").validate({
        rules: {
            first_name : {required: true, minlength: 3},
            email : {required: true, email:true},
            pendidikan : {required: true,  minlength: 2},
            sex : {required: true,  minlength: 1},
            password : {required: true, minlength: 6}
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            /*form.preventDefault();*/
            var id = $('#id').val();
            base_url = "{{ url('admin/users') }}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";        
            $.ajax({
                url: url,
                type: type,
                data: $('.ajax-form').serialize(),
                dataType: 'text',
                success: function(res){
                    //str = res.responseText;
                    
                    if(res.match(/(error|validation)/i)){
                        alert(res);
                    }else{
                        $('.ajax-form')[0].reset();
                        table.ajax.reload();
                        console.log(res);
                    }
                    
                },
                error: function(request, status, error){
                    json = $.parseJSON(request.responseText);
                    $.each(json.errors, function(key, value){
                        $(".invalid-"+key).show();
                        $('.invalid-'+key).append('<p>'+value+'</p>');
                    });
                   /* console.log('parsed json :',json);*/
                }
            });
        }
    });

    /*by tegar*/

    //show modal input sertifikat
    function insertSertifikat(id){
        $('#modalFormReuploadLaporan').modal('show');
        $('.insert-sertifikat')[0].reset();
        $('#userid').val(id);

    }

    //menampulkan preview sertifikat sebelum di inputkat
    $("#file_sertifikat").change(function(){
         $('#image_preview').html("");
         var total_file=document.getElementById("file_sertifikat").files.length;
         for(var i=0;i<total_file;i++)
         {
          $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
         }
      });

    //fungsi onclick close pada input sertifikat maka akan mereset preview sertifikat yg sebelum di inputkat di modal.
    $('#close_sertifikat').on('click', function(){
            document.getElementById("image_preview").innerHTML = "";
    });

    //show sertifikat per auditor
    function showModalLihatSertifikat(id){        
        $('#modalPemeriksaan').modal('show');
        var site_url = "../";
        var url = "/getdata/sertifikat-auditor/" +id ;

        $.ajax({
            url:url,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){

                data.forEach(function (val,i){
                    // console.log('value :'+val.id+' /i :'+i);
                    $('.carousel').carousel('pause');
                    var img = site_url+val.file_sertifikat; 
                    var id_img = val.id;
                    var active = (i==0) ? 'active' : '';
                    var html = $('<div class="carousel-item '+active+'"><img class="center-block" src="'+img+'" style="width: 80%; margin-left: 150px;"/><br><center><button href=# class="btn btn-success">Ubah Sertifikat</button><button href=# class="btn btn-danger" id="hapus-sertifikat" value='+id_img+'>Hapus Sertifikat</button></center></div>');
                    html.appendTo('#carousel-container');

                });

                $('#hapus-sertifkat').on('click', function(){ //ketika button delete di klik maka akan menjalan kan menghapus sertifikat
                    var id = $(this).attr("value");
                    $.confirm({
                        title: "{{ __('Hapus data sertifikat ini?') }}",
                        content: "{{ __('Menghapus data sertifikat akan menghilangkan data sertifikat?') }}",
                        buttons: {
                            delete: {
                                btnClass: 'btn-danger',
                                action: function(){                       
                                    url = "{{ url('/delete/sertifikatAudito') }}/" +id;
                                    $.ajax({
                                        url: url,
                                        type: "GET",                
                                        data: { id },
                                        success: function(data){
                                            console.log(data);
                                            // document.getElementById("image_preview").innerHTML = "";
                                        }
                                    });
                                },
                            },
                            cancel: function(){
                                $.alert('Dibatalkan!');
                            }
                        }
                    });    
                });
            }
        });

        // onclick akan mereset show sertifikat auditors
        $('#close-view-sertifikat').on('click', function(){
                document.getElementById("carousel-container").innerHTML = "";
        });
    }
    
    $('#delete-sertifikat').on('click', function(){
        document.getElementById("carousel-container").innerHTML = "";
    });

</script>