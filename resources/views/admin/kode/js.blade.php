<script type="text/javascript">
  
  /*ajax selectize to get kelompok and sub kelompok*/
  var xhr;
  var select_kelompok, $select_kelompok;
  var select_sub, $select_sub;
  
  $select_kelompok = $('#kelompok').selectize({
    onChange: function(value) {
        
        if (!value.length) return;
        select_sub.disable();
        select_sub.clear();
        select_sub.clearOptions();
        select_sub.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ url("/admin/kode/get-sub-kelompok") }}' + '/' + value ,
                success: function(results) {
                    select_sub.enable();
                    console.log(results);
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

  $select_sub = $('#sub-kelompok').selectize({
    
    valueField: 'kode',
    labelField: ['select_deskripsi'],
    searchField: ['deskripsi'],
    allowEmptyOption: true
});


select_sub  = $select_sub[0].selectize;
select_kelompok = $select_kelompok[0].selectize;

select_sub.disable();

/*end selectize*/

/*Ajax form submit kode temuan*/
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#form-kode-temuan").validate({
        rules: {
            kode : {required: true, minlength: 1},
            deskripsi: {required: true, minlength: 10}
        },

        submitHandler: function(form){
            
            var id = $('#id').val();            
            save_method = (id == '') ? 'new' : save_method;
            base_url = "{{ url('admin/kode') }}";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";
            

            $.ajax({
                url: url,
                type: type,
                data: $('#form-kode-temuan').serialize(),
                dataType: 'text',

                /*data: $('#spt-form').serialize(),*/
                success: function(data){                                        
                    $("#form-kode-temuan")[0].reset();
                   // console.log('success:', data);
                    alert(data);
                    select_sub.clear();
                    select_kelompok.clear();
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        }
    });

/*begin bootstrap treeview*/

$.fn.extend({

    treed: function (o) {

      

      var openedClass = 'fas fa-minus';

      var closedClass = 'fas fa-plus';

      

      if (typeof o != 'undefined'){

        if (typeof o.openedClass != 'undefined'){

        openedClass = o.openedClass;

        }

        if (typeof o.closedClass != 'undefined'){

        closedClass = o.closedClass;

        }

      };

      

        /* initialize each of the top levels */

        var tree = $(this);

        tree.addClass("tree");

        tree.find('li').has("ul").each(function () {

            var branch = $(this);

            branch.prepend("");

            branch.addClass('branch');

            branch.on('click', function (e) {

                //console.log(e);
                if (this == e.target) {

                    var icon = $(this).children('i:first');

                    //icon.toggleClass('fas fa-minus' + " " + 'fas fa-plus');
                    icon.toggleClass('has-child');

                    $(this).children().children().toggle();

                }

            })

            branch.children().children().toggle();

        });

        /* fire event from the dynamically added icon */

        tree.find('.branch .indicator').each(function(){

            $(this).on('click', function () {

                $(this).closest('li').click();

            });

        });

        /* fire event to open branch if the li contains an anchor instead of text */

        tree.find('.branch>a').each(function () {

            $(this).on('click', function (e) {

                $(this).closest('li').click();

                e.preventDefault();

            });

        });

        /* fire event to open branch if the li contains a button instead of text */

        tree.find('.branch>button').each(function () {

            $(this).on('click', function (e) {

                $(this).closest('li').click();

                e.preventDefault();

            });

        });

    }

});

/* Initialization of treeviews */

$('#tree-view').treed();

  
</script>
