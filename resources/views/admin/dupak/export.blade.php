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


 // start generate table pendidikan

  function generate_tabel_pendidikan(){
    //url:'{{ route("data_dupak") }}'
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak_pendidikan") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
      //console.log(response[0].irban_kepala);
      var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
      var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
      var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
      var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
      /*  var trHTML = '<tr style="background:#fff" class="col-print-header"><td colspan="5" align="center">SURAT PERNYATAAN</td></tr>'
            +'<tr style="background:#fff;" class="col-print-header"><td colspan="5" align="center">MELAKUKAN KEGIATAN PENDIDIKAN SEKOLAH</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5">Yang bertandatangan dibawah ini :</td></tr>' //typeof yourVariable === 'object' && yourVariable !== null
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Nama</td><td colspan="3"> : '+ irban_kepala_name +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">NIP</td><td colspan="3"> : '+ irban_kepala_nip +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Pangkat / golongan ruang</td><td colspan="3"> : '+ irban_kepala_pangkat +'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">J a b a t a n</td><td colspan="3"> : '+irban_kepala_jabatan+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Unit Kerja</td><td colspan="3"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5">Menyatakan Bahwa :</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Nama</td><td colspan="3"> : '+response[0].user_dupak.full_name_gelar+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">NIP</td><td colspan="3"> : '+response[0].user_dupak.nip+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Pangkat / golongan ruang</td><td colspan="3"> : '+response[0].user_dupak.pangkat+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">J a b a t a n</td><td colspan="3"> : '+response[0].user_dupak.jabatan+'</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="2">Unit Kerja</td><td colspan="3"> : Inspektorat Kabupaten Sidoarjo</td></tr>'
            +'<tr style="background:#fff" class="col-print-header"><td colspan="5"></td></tr>';*/
      	var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
        var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
        var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
        var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
	    
	    var header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center">SURAT PERNYATAAN<br/>MELAKUKAN KEGIATAN PENDIDIKAN SEKOLAH</h3></div>'	    			
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
	    				+'<div class="col-print-8 col-md-8">: '+ irban_kepala_jabatan +'</div>'
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
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.pangkat+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Jabatan</div>'
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.jabatan+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Unit kerja</div>'
	    				+'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
	    			+'</div>'
	    			+'<div class="h-20"></div>';

            //No	Uraian Sub Unsur  class="col-print-th"
            var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pendidikan-table">';

            table += '<tr>'
	              +'<th>No.</th>'
	              +'<th>Uraian Sub Unsur</th>'
	              +'<th>Butir Kegiatan</th>'
	              +'<th>Angka Kredit</th>'
	              +'<th>Keterangan</th>'
              +'</tr>';
              //response[0].user_dupak.pendidikan.tingkat
        $.each(response, function (i, item) {

          var n = i+1;
            table += '<tr>'
              +'<td>' + n + '</td>'
              +'<td>' + item.user_dupak.pendidikan.tingkat + '</td>'
              +'<td>' + item.user_dupak.pendidikan.jurusan + '</td>'
              +'<td>'+ item.dupak +'</td>'
              +'<td></td>'
              '</tr>';
          dupak = item.dupak++;
        });
        table += '<tr class="col-print-data">'
          +'<td colspan="3">JUMLAH</td>'
          +'<td colspan="2">'+ dupak +'</td>'
          +'</tr>';

        //close table tag
        table += '</table>'

        var footer = '<div class="row"><div class="col-md-12 col-print-12">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div></div>'
        		+'<div class="h-20"></div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Atasan langsung</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Inspektur Pembantu Wilayah</div>'
        		+'</div>'
        		+'<div class="h-100"></div>' //separator ttd atasan
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4"><strong>'+irban_kepala_name+'</strong></div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+'</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_nip+'</div>'
        		+'</div>';
        $( "#dupak-pendidikan-wrapper" ).html( header+table+footer );
        //$('#dupak-pendidikan-table').html(trHTML);
    }
  });
  }

  //end table pendidikan

  //start generate tabel pengawasan
    function generate_tabel_pengawasan(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
        var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
        var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
        var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
        var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
	    
	    var header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center">SURAT PERNYATAAN<br/>MELAKUKAN KEGIATAN PENGAWASAN</h3></div>'	    			
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
	    				+'<div class="col-print-8 col-md-8">: '+ irban_kepala_jabatan +'</div>'
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
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.pangkat+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Jabatan</div>'
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.jabatan+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Unit kerja</div>'
	    				+'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
	    			+'</div>'
	    			+'<div class="h-20"></div>';
	    	var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pengawasan-table">';

              table += '<tr align="center">'
	              +'<th rowspan="2">No.</th>' //1
	              +'<th colspan="2">Uraian Kegiatan</th>' //2
	              +'<th rowspan="2" colspan="2">Tgl Jml Hari Efektif</th>' //3
	              +'<th rowspan="2">Satuan AK</th>'
	              +'<th rowspan="2">Jumlah Jam</th>'
	              +'<th rowspan="2">Jumlah AK</th>'
	              +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr align="center">'
              	  +'<th>Kode</th>'
              	  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr align="center">'
              	  +'<th>1</th>'
              	  +'<th>2</th>'
              	  +'<th>3</th>'
              	  +'<th colspan="2">4</th>'
              	  +'<th>5</th>'
              	  +'<th>6</th>'
              	  +'<th>7</th>'
              	  +'<th>8</th>'
              +'</tr>';

        $.each(response, function (i, item) {
          
          var year = new Date().getFullYear();
          var n = i+1;            
              table += '<tr>'
              +'<td rowspan="2">' + n + '</td>'
              +'<td rowspan="2"></td>'
              +'<td rowspan="2">'+ item.spt.kegiatan.sebutan +'</td>'
              //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td colspan="2" style="text-align: center;">' + item.spt.periode + '</td>'
              +'<td rowspan="2">'+ item.info_dupak.koefisien +'</td>'
              +'<td rowspan="2">'+ item.info_dupak.lama_jam +'</td>' 
              +'<td rowspan="2">'+ item.info_dupak.dupak +'</td>'
              +'<td rowspan="2">SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</td>'
              +'</tr>';
              table += '<tr>'
              		+'<td style="width:50%">' + item.spt.lama + ' hari</td>'
              		+'<td style="width:50%">'+ item.peran +'</td>'
              		+'</tr>';
        });
        
        table += '</table>';
        var footer = '<div class="row"><div class="col-md-12 col-print-12">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div></div>'
        		+'<div class="h-20"></div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Atasan langsung</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Inspektur Pembantu Wilayah</div>'
        		+'</div>'
        		+'<div class="h-100"></div>' //separator ttd atasan
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4"><strong>'+irban_kepala_name+'</strong></div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+'</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_nip+'</div>'
        		+'</div>';

        //$('#dupak-pengawasan-table').html(trHTML);
        $( "#dupak-pengawasan-wrapper" ).html(header+table+footer);
    }
  });
  }
//end generate tabel pengawasan

//start generate tabel penunjang

function generate_tabel_penunjang(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
        var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
        var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
        var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
        var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
	    
	    var header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center">SURAT PERNYATAAN<br/>MELAKUKAN KEGIATAN PENUNJANG PENGAWASAN</h3></div>'	    			
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
	    				+'<div class="col-print-8 col-md-8">: '+ irban_kepala_jabatan +'</div>'
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
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.pangkat+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Jabatan</div>'
	    				+'<div class="col-print-8 col-md-8">: '+response[0].user_dupak.jabatan+'</div>'
	    			+'</div>'
	    			+'<div class="row">'
	    				+'<div class="col-print-4 col-md-4">Unit kerja</div>'
	    				+'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
	    			+'</div>'
	    			+'<div class="h-20"></div>';
	    var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-penunjang-table">';
/* No	Uraian Kegiatan		Tanggal	Satuan AK	Jumlah jam	Jumlah AK	Keterangan
		Kode	Kegiatan	*/
		table += '<tr align="center">'
	              +'<th rowspan="2">No.</th>'
	              +'<th colspan="2">Uraian Kegiatan</th>'
	              +'<th rowspan="2">Tanggal</th>'
	              +'<th rowspan="2">Satuan AK</th>'
	              +'<th rowspan="2">Jumlah Jam</th>'
	              +'<th rowspan="2">Jumlah AK</th>'
	              +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr align="center">'
              	  +'<th>Kode</th>'
              	  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr align="center">'
              	  +'<th>1</th>'
              	  +'<th>2</th>'
              	  +'<th>3</th>'
              	  +'<th>4</th>'
              	  +'<th>5</th>'
              	  +'<th>6</th>'
              	  +'<th>7</th>'
              	  +'<th>8</th>'
              +'</tr>';
        table += '<tr style="height: 100px;"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
				
        //commenting, SPT penunjang belum jadi, sementara tampilkan template saja
       /*$.each(response, function (i, item) {
          
          var year = new Date().getFullYear();
          var n = i+1;            
              table += '<tr>'
              +'<td>' + n + '</td>'
              +'<td></td>'
              +'<td>'+ item.spt.kegiatan.sebutan +'</td>'
              +'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td>'+ item.info_dupak.koefisien +'</td>'
              +'<td>'+ item.info_dupak.lama_jam +'</td>' 
              +'<td>'+ item.info_dupak.dupak +'</td>'
              +'<td>SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</td>'
              '</tr>';
        });*/

        table += '</table>';
        var footer = '<div class="row"><div class="col-md-12 col-print-12">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div></div>'
        		+'<div class="h-20"></div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Atasan langsung</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">Inspektur Pembantu Wilayah</div>'
        		+'</div>'
        		+'<div class="h-100"></div>' //separator ttd atasan
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4"><strong>'+irban_kepala_name+'</strong></div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+'</div>'
        		+'</div>'
        		+'<div class="row">'
        			+'<div class="col-md-8 col-print-8"></div>'
        			+'<div class="col-md-4 col-print-4">'+irban_kepala_nip+'</div>'
        		+'</div>';

        //$('#dupak-pengawasan-table').html(trHTML);
        $( "#dupak-penunjang-wrapper" ).html(header+table+footer);
    }
  });
  }
//end generate tabel penunjang
</script>
