<script type="text/javascript">
  $('#btn-exports').on('submit', function(e){


  });

// function exports called to create workbook and adding html tables to workbook
function exports(){
  /* create new workbook */
  var wb = XLSX.utils.book_new();

  var styling = '"A1": {v: "Top left", s: { border: { top: { style: "medium", color: { rgb: "FFFFAA00"}}, left: { style: "medium", color: { rgb: "FFFFAA00"}} }}}';

  /* convert table 'table1' to worksheet named "Sheet1" */
  var ws1 = XLSX.utils.table_to_sheet(document.getElementById('dupak-pengawasan-table'), styling);
  XLSX.utils.book_append_sheet(wb, ws1, "Pengawasan");

  /* convert table 'table2' to worksheet named "Sheet2" */
  var ws2 = XLSX.utils.table_to_sheet(document.getElementById('dupak-pendidikan-table'));
  XLSX.utils.book_append_sheet(wb, ws2, "Pendidikan");

  //add_cell_to_sheet(wb.Sheets.Pengawasan, "A1", 12345);
  //XLSX.writeFile('sheetjs-new.xlsx', wb);

  var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
  saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'export_dupak.xlsx');
}


function s2ab(s) {
              var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
              var view = new Uint8Array(buf);  //create uint8array as viewer
              for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
              return buf;
}

function add_cell_to_sheet(worksheet, address, value) {
	/* cell object */
	var cell = {t:'?', v:value};

	/* assign type */
	if(typeof value == "string") cell.t = 's'; // string
	else if(typeof value == "number") cell.t = 'n'; // number
	else if(value === true || value === false) cell.t = 'b'; // boolean
	else if(value instanceof Date) cell.t = 'd';
	else throw new Error("cannot store value");

	/* add to worksheet, overwriting a cell if it exists */
	worksheet[address] = cell;

	/* find the cell range */
	var range = XLSX.utils.decode_range(worksheet['!ref']);
	var addr = XLSX.utils.decode_cell(address);

	/* extend the range to include the new cell */
	if(range.s.c > addr.c) range.s.c = addr.c;
	if(range.s.r > addr.r) range.s.r = addr.r;
	if(range.e.c < addr.c) range.e.c = addr.c;
	if(range.e.r < addr.r) range.e.r = addr.r;

	/* update range */
	worksheet['!ref'] = XLSX.utils.encode_range(range);
}
</script>
