<script type="text/javascript">

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

//set generate header function
function generate_header(response, jenis=''){
  var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
  var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
  var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.formatted_pangkat;
  var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : (typeof response[0].irban_kepala.pejabat === 'undefined') ? response[0].irban_kepala.jabatan : 'Plt. '+response[0].irban_kepala.pejabat.name;
  //status_pejabat = (response[0].irban_kepala.pejabat !== null) ? 'PLT ' : '';
  
  var header = '<div class="d-none">'
        +'<div class="col-print-12 col-md-12"><h3 class="print-center text-center">SURAT PERNYATAAN<br/>MELAKUKAN KEGIATAN '+jenis.toUpperCase()+'</h3></div>'           
        +'<div class="h-20"></div>'
        +'<div class="row"><div class="col-print-12 col-md-12">Yang bertandatangan dibawah ini :</div></div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Nama</div>'
          +'<div class="col-print-8 col-md-8">: <strong>'+ irban_kepala_name +'</strong></div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">NIP</div>'
          +'<div class="col-print-8 col-md-8">: '+ irban_kepala_nip +'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Pangkat / golongan ruang</div>'
          +'<div class="col-print-8 col-md-8">: '+ irban_kepala_pangkat +'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Jabatan</div>'
          +'<div class="col-print-8 col-md-8">: '+irban_kepala_jabatan +'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Unit kerja</div>'
          +'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
        +'</div>'
        +'<div class="h-20"></div>' //separator
        +'<div class="row"><div class="col-print-12 col-md-12">Menyatakan bahwa :</div></div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Nama</div>'
          +'<div class="col-print-8 col-md-8">: <strong>'+response[0].user_dupak.full_name_gelar+'</strong></div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">NIP</div>'
          +'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.nip+'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Pangkat / golongan ruang</div>'
          +'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.formatted_pangkat+'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Jabatan</div>'
          +'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.jabatan+'</div>'
        +'</div>'
        +'<div class="row">'
          +'<div class="col-print-4 col-md-4">Unit kerja</div>'
          +'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
        +'</div>'
        +'<div class="h-20"></div>'
        +'</div>';
  return header;
}

//set generate_footer function
function generate_footer(response){
  var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
  var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
  var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.formatted_pangkat;
  var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
  var irban_kepala_atasan = ( response[0].irban_kepala === null ) ? '' : (typeof response[0].irban_kepala.pejabat === 'undefined') ? response[0].irban_kepala.jabatan : 'Plt. '+response[0].irban_kepala.pejabat.name;
  var footer = '<div class="d-none">'
            +'<div class="row"><div class="col-md-12 col-print-12">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div></div>'
            +'<div class="h-20"></div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">Atasan langsung</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+irban_kepala_atasan+'</div>'
            +'</div>'
            +'<div class="h-100"></div>' //separator ttd atasan
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4"><strong>'+irban_kepala_name+'</strong></div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+irban_kepala_pangkat+'</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+irban_kepala_nip+'</div>'
            +'</div>'
            +'</div>';
  return footer;
}

</script>
