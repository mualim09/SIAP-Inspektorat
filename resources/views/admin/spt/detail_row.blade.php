<!-- handebar detail -->
<script id="details-template" type="text/x-handlebars-template">
    @verbatim
    <table class="table details-table" id="spt-{{id}}">
        <thead>
        <tr>
            <th>Id</th>
            <th>Permissions Name</th>
        </tr>
        </thead>
    </table>
    @endverbatim
</script>

<script type="text/javascript">
    var template = Handlebars.compile($("#details-template").html());
    // Add event listener for opening and closing details
      $('.spt-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var tableId = 'spt-' + row.data().id;
        if (row.child.isShown()) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Open this row
          row.child(template(row.data())).show();
          initTable(tableId, row.data());
          console.log(row.data());
          tr.addClass('shown');
          tr.next().find('td').addClass('no-padding bg-blue');
        }
      });
      function initTable(tableId, data) {
        $('#' + tableId).DataTable({
          language: {
            paginate: {
              next: '&gt;', // or '→'
              previous: '&lt;' // or '←' 
            }
        },
          processing: true,
          serverSide: true,
          ajax: data.details_url,
          columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
          ]
        })
      }

    //end event listener
</script>