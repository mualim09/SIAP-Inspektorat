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
      if(response.length>0){
	    
	    var header = generate_header(response,'pendidikan');
      var footer = generate_footer(response);

      //No	Uraian Sub Unsur  class="col-print-th"
      var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pendidikan-table">';

          table += '<tr style="background: #ccc; text-align: center">'
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
              +'<td style="text-align: center">'+ item.dupak +'</td>'
              +'<td></td>'
              '</tr>';
          dupak = item.dupak++;
        });
        table += '<tr class="col-print-data">'
          +'<td colspan="3">JUMLAH</td>'
          +'<td colspan="2">'+ dupak +'</td>'
          +'</tr>';

        //close table tag
        table += '</table>';
        
        $( "#dupak-pendidikan-wrapper" ).html( header+table+footer );
        //$('#dupak-pendidikan-table').html(trHTML);
      }else{
        $("#dupak-pendidikan-wrapper").html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
      }
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
      if(response.length>0){
        var header = generate_header(response, 'pengawasan');
	    	var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-pengawasan-table">';

              table += '<tr style="background: #ccc; text-align: center">'
	              +'<th rowspan="2">No.</th>' //1
	              +'<th colspan="2">Uraian Kegiatan</th>' //2
	              +'<th rowspan="2" colspan="2">Tgl Jml Hari Efektif</th>' //3
	              +'<th rowspan="2">Satuan AK</th>'
	              +'<th rowspan="2">Jumlah Jam</th>'
	              +'<th rowspan="2">Jumlah AK</th>'
	              +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
              	  +'<th>Kode</th>'
              	  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr style="background: #ccc; text-align: center">'
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
          //console.log(item);
          //file_url = (window.location.pathname == '/admin' || window.location.pathname == '/public/admin') ? 'storage/spt/'
          var year = new Date().getFullYear();
          var n = i+1;
          if (typeof item.spt !== 'undefined' && item.spt.file !== null) {
            file = document.location.origin+'/storage/spt/'+item.spt.file;
            target = "_blank";
            link = '<td rowspan="2"><a href="'+file+'" target="'+target+'" >SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</a><br/><br/></td>';
          }else{
            file = "#";
            target= "_self";
            link = '<td rowspan="2">SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'<br/><br/></td>';
          }
          table += '<tr>'
          +'<td rowspan="2">' + n + '</td>'
          +'<td rowspan="2"></td>'
          +'<td rowspan="2">'+ item.spt.kegiatan.sebutan +'</td>'
          //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
          +'<td colspan="2" style="text-align: center;">' + item.spt.periode + '</td>'
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.koefisien +'</td>'
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.lama_jam +'</td>' 
          +'<td rowspan="2" style="text-align: center">'+ item.info_dupak.dupak +'</td>'
          //+'<td rowspan="2"><a href="'+file+'" target="'+target+'" >SPT No.700/'+ item.spt.nomor +'/438.4/'+year+'</a><br/><br/></td>'
          +link
          +'</tr>';
          table += '<tr>'
          		+'<td style="width:50%">' + item.spt.lama + ' hari</td>'
          		+'<td style="width:50%">'+ item.peran +'</td>'
          		+'</tr>';
        });
        
        table += '</table>';
        var footer = generate_footer(response);
        
        $( "#dupak-pengawasan-wrapper" ).html(header+table+footer);
      }else{
        $( "#dupak-pengawasan-wrapper" ).html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
      }
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
    url: '{{ route("data_dupak_penunjang") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) { 
	    //console.log(response);
      if(response.length>0){
      var year = new Date().getFullYear();
      var header = generate_header(response,'penunjang pengawasan');
      var footer = generate_footer(response);
	    var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-penunjang-table">';
/* No	Uraian Kegiatan		Tanggal	Satuan AK	Jumlah jam	Jumlah AK	Keterangan
		Kode	Kegiatan	*/
		  table += '<tr style="background: #ccc; text-align: center">'
	              +'<th rowspan="2">No.</th>'
	              +'<th colspan="2">Uraian Kegiatan</th>'
	              +'<th rowspan="2">Tanggal</th>'
	              +'<th rowspan="2">Satuan AK</th>'
	              +'<th rowspan="2">Jumlah Jam</th>'
	              +'<th rowspan="2">Jumlah AK</th>'
	              +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
              	  +'<th>Kode</th>'
              	  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr style="background: #ccc; text-align: center">'
              	  +'<th>1</th>'
              	  +'<th>2</th>'
              	  +'<th>3</th>'
              	  +'<th>4</th>'
              	  +'<th>5</th>'
              	  +'<th>6</th>'
              	  +'<th>7</th>'
              	  +'<th>8</th>'
              +'</tr>';
       //table += '<tr style="height: 100px;"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
				
        //commenting, SPT penunjang belum jadi, sementara tampilkan template saja
       $.each(response, function (i, item) {
          var n = i+1;            
              table += '<tr>'
              +'<td >' + n + '</td>'
              +'<td></td>'
              +'<td>'+ item.spt_umum.info_untuk_umum+'</td>'
              //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td style="text-align: center;">' + item.spt_umum.periode + '</td>'
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td style="text-align: center">'+ item.info_dupak.lama +'</td>' 
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td>SPT No.700/'+ item.spt_umum.nomor +'/438.4/'+year+'<br/><br/></td>'
              +'</tr>';
              /*table += '<tr>'
                  +'<td style="width:50%">' + item.spt_umum.lama + ' hari</td>'
                  +'<td style="width:50%">'+ item.peran +'</td>'
                  +'</tr>';*/
        });

        table += '</table>';        
        $( "#dupak-penunjang-wrapper" ).html(header+table+footer);
      }else{
        $( "#dupak-penunjang-wrapper" ).html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
      }
    }
  });
  }
//end generate tabel penunjang

//start generate table dupak diklat
    function generate_tabel_diklat(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
    url: '{{ route("data_dupak_diklat") }}',
    type: 'GET',
    data: {user_id: user_id, semester: semester, tahun: tahun},
    success: function (response) {
      //console.log(response[0].irban_kepala.pejabat);
      if(response.length > 0) {
        var year = new Date().getFullYear();
        var header = generate_header(response, 'pendidikan dan pelatihan');
        var footer = generate_footer(response);
        var table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-diklat-table">';
       
        table += '<tr style="background: #ccc; text-align: center">'
                +'<th rowspan="2">No.</th>'
                +'<th colspan="2">Uraian Kegiatan</th>'
                +'<th rowspan="2">Tanggal</th>'
                +'<th rowspan="2">Satuan AK</th>'
                +'<th rowspan="2">Jumlah Jam</th>'
                +'<th rowspan="2">Jumlah AK</th>'
                +'<th rowspan="2">Keterangan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>Kode</th>'
                  +'<th>Kegiatan</th>'
              +'</tr>'
              //nomor tabel
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>1</th>'
                  +'<th>2</th>'
                  +'<th>3</th>'
                  +'<th>4</th>'
                  +'<th>5</th>'
                  +'<th>6</th>'
                  +'<th>7</th>'
                  +'<th>8</th>'
              +'</tr>';

        $.each(response, function (i, item) {
          var n = i+1;            
              table += '<tr>'
              +'<td>' + n + '</td>'
              +'<td></td>'
              +'<td>'+ item.spt_umum.info_untuk_umum+'</td>'
              //+'<td>' + item.spt.periode + '<br />' + item.spt.lama + '</td>'
              +'<td style="text-align: center;">' + item.spt_umum.periode + '</td>'
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td style="text-align: center">'+ item.info_dupak.lama +'</td>' 
              +'<td style="text-align: center">'+ item.info_dupak.dupak +'</td>'
              +'<td>SPT No.700/'+ item.spt_umum.nomor +'/438.4/'+year+'<br/><br/></td>'
              +'</tr>';
        });
        
        table += '</table>';
        $( "#dupak-diklat-wrapper" ).html(header+table+footer);
      }else {
          $( "#dupak-diklat-wrapper" ).html('<div class="col-md-12 empty-data text-center">Data DUPAK user Tidak ditemukan. </div>');
      }
    }
  });
  }
  //end tabel diklat

  //tabel LAK
  function generate_tabel_lak(){
    var user_id = ( $( "#user-id" ).length ) ? $("#user-id option:selected").val() : "{{ Auth::user()->id }}";
    var semester = $('#semester option:selected').val();
    var tahun = $('#tahun').val();
    var periode = (semester == 1) ? '1 Januari - 30 Juni' : '1 Juli - 31 Desember';
    $.ajax({
      url : ' {{ route("data_dupak_lak") }}',
      type : 'GET',
      data: {user_id: user_id, semester: semester, tahun: tahun},
      success: function(response){
        var year = new Date().getFullYear();
        pendidikan = ('undefined' !== typeof response.user.pendidikan.tingkat) ? response.user.pendidikan.tingkat : '';
        header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center" style="margin-bottom:0px;">LAPORAN ANGKA KREDIT</h3>'
          +'<h5 class="print-center text-center"  style="margin-top:0px;">Masa Penilaian '+periode+' '+tahun+'</h5></div>'
          +'<div class="h-20"></div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Nama</div>'
            +'<div class="col-print-8 col-md-8">: <strong>'+ response.user.full_name_gelar +'</strong></div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">NIP</div>'
            +'<div class="col-print-8 col-md-8">: '+response.user.nip+'</div>'
          +'</div>'            
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Jabatan</div>'
            +'<div class="col-print-8 col-md-8">: '+response.user.jabatan+'</div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Pendidikan terakhir</div>'
            +'<div class="col-print-8 col-md-8">: '+pendidikan+'</div>'
          +'</div>'
          +'<div class="row">'
            +'<div class="col-print-4 col-md-4">Unit kerja</div>'
            +'<div class="col-print-8 col-md-8">: Inspektorat Kabupaten Sidoarjo</div>'
          +'</div>'
          +'<div class="h-20"></div>';
         
        table = '<table class="table table-sm table-bordered ajax-table col-print-12 table-print-border" id="dupak-lak-table">'       
              +'<tr style="background: #ccc; text-align: center">'
                +'<th rowspan="2">No.</th>'
                +'<th rowspan="2">Uraian Sub Unsur</th>'
                +'<th colspan="2">Jumlah Angka Kredit</th>'
                +'<th colspan="2">Jumlah Hari</th>'
                +'<th rowspan="2">Perbedaan</th>'
                +'<th rowspan="2">Ket Perbedaan</th>'
              +'</tr>'
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>Diusulkan</th>'
                  +'<th>Disetujui</th>'
                  +'<th>Diusulkan</th>'
                  +'<th>Disetujui</th>'
              +'</tr>'
              //nomor tabel
              +'<tr style="background: #ccc; text-align: center">'
                  +'<th>1</th>'
                  +'<th>2</th>'
                  +'<th>3</th>'
                  +'<th>4</th>'
                  +'<th>5</th>'
                  +'<th>6</th>'
                  +'<th>7</th>'
                  +'<th>8</th>'
              +'</tr>';

          //AK pendidikan
          table += '<tr>'
                  +'<td style="text-align: center;"><strong>I</strong></td>'
                  +'<td><strong>Pendidikan Sekolah</strong></td>';
          if(response.pendidikan.length>0 && 'undefined' !== response.pendidikan[0].dupak){            
            table += '<td style="text-align: center">'+response.pendidikan[0].dupak+'</td>'; 
          }else{
            table += '<td></td>';
          }
          table +='<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //table breaker
          table += '<tr>'
                  +'<td style="text-align: center;"><strong>II</strong></td>'
                  +'<td><strong>ANGKA KREDIT PENJENJANGAN</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          table += '<tr>'
                  +'<td style="text-align: right;"><strong>A</strong></td>'
                  +'<td><strong>Unsur Utama</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>1. Pendidikan dan Pelatihan</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK diklat
          var sumDiklat=0 , sumLamaDiklat = 0;
          if(response.diklat.length > 0){
            $.each(response.diklat, function(i,item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumDiklat += parseFloat(item.info_dupak.dupak);
              sumLamaDiklat += parseFloat(item.info_dupak.lama);
            });          
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pendidikan dan Pelatihan</strong></td>'
                  +'<td>'+sumDiklat.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaDiklat+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker AK diklat
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>2. Pengawasan</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK Pengawasan
          var sumPengawasan = 0, sumLamaPengawasan = 0;
          if(response.pengawasan.length > 0){                        
            $.each(response.pengawasan, function(i,item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //pengawasan[0].spt.kegiatan.sebutan
                +'<td style="padding-left:50px;">'+n+'. '+item.spt.kegiatan.sebutan+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.spt.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPengawasan += parseFloat(item.info_dupak.dupak);
              sumLamaPengawasan += parseFloat(item.spt.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pengawasan</strong></td>'
                  +'<td>'+sumPengawasan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPengawasan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker AK pengawasan
          table += '<tr>'
                  +'<td></td>'
                  +'<td><strong>3. Pengembangan profesi</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK pengembangan profesi
          var sumPengembangan = 0, sumLamaPengembangan = 0;
          if(response.pengembangan.length > 0){            
            $.each(response.pengembangan, function(i, item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPengembangan += parseFloat(item.info_dupak.dupak);
              sumLamaPengembangan += parseFloat(item.info_dupak.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Pengembangan Profesi</strong></td>'
                  +'<td>'+sumPengembangan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPengembangan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
            sumUtama = sumDiklat+sumPengawasan+sumPengembangan;
            sumLamaUtama = sumLamaDiklat+sumLamaPengawasan+sumLamaPengembangan;

            table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Unsur Utama</strong></td>'
                  +'<td>'+sumUtama.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaUtama+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //breaker unsur utama
          table += '<tr>'
                  +'<td style="text-align: right;"><strong>B</strong></td>'
                  +'<td><strong>Unsur Penunjang</strong></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

          //AK Penunjang
          var sumPenunjang = 0, sumLamaPenunjang = 0;
          if(response.penunjang.length > 0){            
            $.each(response.penunjang, function(i, item){
              n = i+1
              table += '<tr>'
                +'<td></td>' //item.spt_umum.info_untuk_umum
                +'<td style="padding-left:50px;">'+n+'. '+item.spt_umum.info_untuk_umum+'</td>'
                +'<td style="text-align: center">'+item.info_dupak.dupak+'</td>'
                +'<td></td>'
                +'<td style="text-align: center">'+item.info_dupak.lama+'</td>'
                +'<td></td>'
                +'<td></td>'
                +'<td></td>'
                +'</tr>';
              sumPenunjang += parseFloat(item.info_dupak.dupak);
              sumLamaPenunjang += parseFloat(item.info_dupak.lama);
            });            
          }
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>Jumlah Unsur Penunjang</strong></td>'
                  +'<td>'+sumPenunjang.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPenunjang+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';
          sumPenjenjangan = sumUtama+sumPenunjang;
          sumLamaPenjenjangan = sumLamaUtama+sumLamaPenunjang;
          //jumlah AK Penjenjangan
          table += '<tr style="background: #ccc; text-align: center">'
                  +'<td></td>'
                  +'<td><strong>jumlah AK Penjenjangan</strong></td>'
                  +'<td>'+sumPenjenjangan.toFixed(3)+'</td>'
                  +'<td></td>'
                  +'<td>'+sumLamaPenjenjangan+'</td>'
                  +'<td></td>' 
                  +'<td></td>'
                  +'<td></td>'
                  +'</tr>';

        //penutup tabel
          table +='</table>'
        $("#dupak-lak-wrapper").html(header+table);
        
      },
      error: function(error){
        console.log(error);
      }
    });
  }
  //end tabel LAK

//set generate header function
function generate_header(response, jenis=''){
  var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
  var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
  var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
  var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : (typeof response[0].irban_kepala.pejabat === 'undefined') ? response[0].irban_kepala.jabatan : 'Plt. '+response[0].irban_kepala.pejabat.name;
  //status_pejabat = (response[0].irban_kepala.pejabat !== null) ? 'PLT ' : '';
  
  var header = '<div class="col-print-12 col-md-12"><h3 class="print-center text-center">SURAT PERNYATAAN<br/>MELAKUKAN KEGIATAN '+jenis.toUpperCase()+'</h3></div>'           
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
  return header;
}

//set generate_footer function
function generate_footer(response){
  var irban_kepala_name = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.full_name_gelar ;
  var irban_kepala_nip = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.nip;
  var irban_kepala_pangkat = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.pangkat;
  var irban_kepala_jabatan = ( response[0].irban_kepala === null ) ? '' : response[0].irban_kepala.jabatan;
  var irban_kepala_atasan = ( response[0].irban_kepala === null ) ? '' : (typeof response[0].irban_kepala.pejabat === 'undefined') ? response[0].irban_kepala.jabatan : 'Plt. '+response[0].irban_kepala.pejabat.name;
  var footer = '<div class="row"><div class="col-md-12 col-print-12">Demikian pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</div></div>'
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
              +'<div class="col-md-4 col-print-4">'+irban_kepala_jabatan+' '+irban_kepala_pangkat+'</div>'
            +'</div>'
            +'<div class="row">'
              +'<div class="col-md-8 col-print-8"></div>'
              +'<div class="col-md-4 col-print-4">'+irban_kepala_nip+'</div>'
            +'</div>';
  return footer;
}

</script>
