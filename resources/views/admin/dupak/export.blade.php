<script type="text/javascript">
  $('#btn-exports').on('submit', function(e){


  });
function exports(){
  /* create new workbook */
  var wb = XLSX.utils.book_new();

  /* convert table 'table1' to worksheet named "Sheet1" */
  var ws1 = XLSX.utils.table_to_sheet(document.getElementById('dupak-pengawasan-table'));
  XLSX.utils.book_append_sheet(wb, ws1, "Sheet1");

  /* convert table 'table2' to worksheet named "Sheet2" */
  var ws2 = XLSX.utils.table_to_sheet(document.getElementById('dupak-pendidikan-table'));
  XLSX.utils.book_append_sheet(wb, ws2, "Sheet2");

  var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
  saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'test.xlsx');
}


function s2ab(s) {
              var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
              var view = new Uint8Array(buf);  //create uint8array as viewer
              for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
              return buf;
}
</script>
