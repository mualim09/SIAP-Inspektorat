<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\models\Detail_ppm;
use App\models\Ppm;
use DB;
use App\Common;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use App\models\FileMedia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class PpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listAnggota = User::select(['id','first_name','last_name', 'gelar'])->get();
        return view('admin.ppm.index',['listAnggota'=>$listAnggota]);
    }

    public function getdataPpm()
    {
        $data = Ppm::all()->sortByDesc("id");
        $tb = Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('kegiatan', function($col){
                  return $col->kegiatan;
              })
              ->addColumn('lama', function($col){
                  return $col->lama;
              })
              ->addColumn('nota', function($col){
                  return $col->nota_dinas;
              })
              ->addColumn('action', function($col){
                  //$return = '<a href="javascript:void(0);" onclick="editLokasi('. $data->id .')" outline type="primary" title="Edit Lokasi"><i class="ni ni-single-copy-04"></i></a>';
                  //return $return;
                  return;
                  // $return = $this->buildControl('viewAnggota',$col->id);
                  // $return .= $this->buildControl('cetakPdf',$col->id);
                  // if($col->approval_status == 'processing'){
                  //     $return .= $this->buildControl('editForm',$col->id);
                  //     $return .= $this->buildControl('deleteData',$col->id);
                  // }
                  // return $return;
              })
              ->escapeColumns([])
              ->make(true);
        return $tb;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePpm(Request $request)
    {
        return 'fungsi berjalan ';
    }

    // public function storeUmum(Request $request){
    //     //masukkan kode store SPT bagian umum

    //     $user = auth()->user();
    //     $this->validate($request, [
    //         'jenis_spt_umum' => 'required',
    //         // 'lokasi_umum_id' => 'nullable',
    //         'tgl_mulai_umum'=>'required|date_format:"d-m-Y"',
    //         'tgl_akhir_umum' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_umum',
    //         'lama_umum' => 'required|integer',
    //         'info_untuk_umum'=> 'required',
    //         'info_dasar_umum'=> 'required'
    //         ]
    //     );
    //      $data = [
    //         'jenis_spt_umum' => Common::cleanInput($request['jenis_spt_umum']),
    //         'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_umum'])),
    //         'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_umum'])),
    //         // 'lokasi_id' => $request['lokasi_umum_id'],
    //         'lama' => $request['lama_umum'],
    //         'info_untuk_umum' => Common::cleanInput($request['info_untuk_umum']),
    //         'info_dasar_umum' => Common::cleanInput($request['info_dasar_umum']),
    //     ];

    //     // dd($data);
    //     // die();

    //     $spt = SptUmum::create($data);
    //     if($spt) {
    //         // dd($spt->lama);
    //         $this->storeDetailUmum($spt->id, $spt->lama);
    //         // $this->storeDetailKepadaUmum($spt->id, $spt->lama);

    //         //user id pembuat spt
    //         // $info['user_id'] = $user->id;
    //         // $info['type'] = 'spt';

    //         // //role perencanaan jika membuat spt maka otomatis menjadi spt pengawasan, jika role TU umum: spt umum, selain itu set NULL.
    //         // $info['jenis'] = ( $user->hasRole('TU Perencanaan') ) ? 'pengawasan' : (($user->hasRole('TU Umum')) ? 'umum' : NULL);

    //         // $info['spt_id'] = $spt->id;
    //         // $insertArr = [
    //         //    'title' => $request['jenis_spt_umum'],
    //         //    'start' => $spt->tgl_mulai,
    //         //    'end' => $spt->tgl_akhir,
    //         //    'info' => $info
    //         // ];
    //         // $event = Event::create($insertArr);
    //         // dd($event);

    //         return $spt;
    //     }
    // }

    // //dibawah ini function storeDetailAnggotaUmum punya mas tegar, di nonaktifkan / di comment
    // public function storeDetailUmum($spt_id,$lama){
    //     //dd($request);
    //     $spt = SptUmum::find($spt_id);
    //     //dd($spt);
    //     $unsur_dupak = $spt->jenis_spt_umum;
    //     $start =$spt->tgl_mulai;
    //     $end = $spt->tgl_akhir;
    //     $lama = $spt->lama;
    //     $counter = array();

    //     if(Session::has('anggota_umum'))
    //     {
    //         $session_anggota = Session::get('anggota_umum');
    //         // dd($session_anggota);
    //         foreach($session_anggota as $k=>$anggota){
    //             //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
    //             //$lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
    //             //$isLembur = ( $lembur->count() > 0) ? true : false;
    //             if($k === 0){
    //                 $peran = 'pejabat_utama';
    //             }else{
    //                 $peran = 'anggota';
    //             }
    //             $dupak = [
    //                 'lama' => $anggota['lama'],
    //                 'dupak' => $anggota['dupak']
    //             ];

    //             if($spt->jenis_spt_umum == 'SPT Pengembangan Profesi'){
    //                 $unsur_dupak = 'pengembangan profesi';
    //             }if($spt->jenis_spt_umum == 'SPT Penunjang'){
    //                 $unsur_dupak = 'penunjang';
    //             }if($spt->jenis_spt_umum == 'SPT Diklat'){
    //                 $unsur_dupak = 'diklat';
    //             }

    //             DB::table('detail_spt')->insertGetId([
    //             'spt_id' => $spt_id,
    //             'user_id' => $anggota['user_id'],
    //             'peran' => $peran,
    //             'lama' => $lama,
    //             'info_dupak' => json_encode($dupak),
    //             'unsur_dupak' => $unsur_dupak
    //             //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
    //         ]);
    //         }
    //         $this->clearSessionAnggotaUmum();
    //     }
    //     return;
    // }

    // // dd($request); /*jalan*/
    //     $user = auth()->user();
    //     $digits = 3;
    //     $kode_kelompok = random_int( 2 ** ( $digits - 1 ), ( 5 ** $digits ) - 1); //mengegenerate random interger dengan max $digit(3 character)  

    //     $this->validate($request, [
    //         'jenis_ppm' => 'required',
    //         // 'lokasi_umum_id' => 'nullable',
    //         'tgl_mulai_ppm'=>'required|date_format:"d-m-Y"',
    //         'tgl_akhir_ppm' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_ppm',
    //         'lama_ppm' => 'required|integer',
    //         // 'info_untuk_umum'=> 'required',
    //         'nota_dinas'=> 'required'
    //         ]
    //     );

    //         // $file = $request->file('nota_dinas');
    //         // $fileName = json_decode($request->nota_dinas)->getClientOriginalName();
    //         // if($request->file('nota_dinas')) 
    //         // {
    //             // $file = $request->file('nota_dinas');
    //             // $filename = time() . '.' . $request->file('nota_dinas')->extension();
    //             // $filePath = public_path() . '/files/uploads/';
    //             // $file->move($filePath, $filename);
                
    //             dd(Input::File('nota_dinas'));
    //             die();
    //         // }

    //     // if($request->hasFile('nota_dinas')) {


    //         // dd($filename);
    //         // die();
    //         // $pdf = ($fileName !== null) ? 'NotaDinas'.'-'. $fileName : null ;
    //         //if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
            
    //     // }

    //     // if(Session::has('anggota_ppm'))
    //     // {
    //     //     $session_anggota = Session::get('anggota_ppm');
    //     //     // dd(count($session_anggota));
    //     //     foreach($session_anggota as $k=>$anggota){
    //     //         //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
    //     //         // $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
    //     //         // $isLembur = ( $lembur->count() > 0) ? true : false;
    //     //         // dd($anggota);
    //     //         if($k === 0){
    //     //             $peran = 'pejabat_utama';
    //     //         }else{
    //     //             $peran = 'peserta';
    //     //         }

    //     //         $dupak = [
    //     //             'lama' => $anggota['lama'],
    //     //             'dupak' => $anggota['dupak']
    //     //         ];

    //     //         Ppm::insertGetId([
    //     //         // 'spt_id' => $spt_id,
    //     //         'user_id' => $anggota['user_id'],
    //     //         'peran' => $peran,
    //     //         'lama' => $request['lama_ppm']  ,
    //     //         'tgl_mulai' => date("Y-m-d H:i:s", strtotime($request['tgl_mulai_ppm'])),
    //     //         'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_ppm'])),
    //     //         'kode_kelompok' => $kode_kelompok,
    //     //         'info_dupak' => json_encode($dupak),
    //     //         'unsur_dupak' => Common::cleanInput($request['jenis_ppm'])
    //     //         //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
    //     //     ]);
    //     //     }
    //     //     $this->clearSessionAnggotaPpm();
    //     // }


    //     // return;
    

    public function clearSessionAnggotaPpm(){
        Session::forget('anggota_ppm');
        return "Session Anggota PPM deleted";
    }

    public function storePpmSessionAnggotaPpm(Request $request)
    {
        // dd($request);
        // die();
        $uid = $request->user_id;
        $tgl_mulai = date($request->tgl_mulai);
        $tgl_akhir = date($request->tgl_mulai);

        if(Session::has('anggota_ppm')){
            //'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim'
            $listAnggota = Session::get('anggota_ppm');

            $anggota_uid = [];
            foreach( $listAnggota as $a){
                array_push($anggota_uid, $a['user_id']);
            }

            if(in_array($uid,$anggota_uid)){
                return "User sudah ada dalam list anggota";
            }else{
                $session = Session::push('anggota_ppm', [
                    'user_id'    => $request->user_id,
                    // 'peran'   => 'Pegawai'
                    'lama' => $request->lama_jam_ppm,
                    'dupak' => $request->dupak_anggota_ppm
                ]);
                return "Session anggota ppm updated";
            }

        }else{
            $session = Session::push('anggota_ppm', [
                'user_id'    => $request->user_id,
                // 'peran'   => 'Pegawai'
                'lama' => $request->lama_jam_ppm,
                'dupak' => $request->dupak_anggota_ppm
            ]);
            return "Session anggota ppm created";
        }
    }

    public function drawTableAnggotaPpm(Request $request){
        // dd($request->ppm_id);
        $ppm_id = Detail_ppm::where('id', $request->ppm_id)->first();
        //dd($request->spt_id);$this->buildControl('deleteAnggota',$col->id); '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
        $return = '<table class="table table-bordered table-hover">'
                        .'<thead><tr>'
                            .'<th>No.</th>'
                            .'<th>Nama</th>'
                            .'<th></th>'
                        .'</tr></thead>';

        if($ppm_id != null){
            //bukan spt baru, data spt sudah ada, tampilkan data anggota spt dari tabel detail
            $list_anggota = Detail_ppm::where('spt_id', $request->ppm_id)->with('user')->get();
            //dd($list_anggota);
            foreach($list_anggota as $i=>$anggota){
                $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$anggota->user->full_name_gelar.'</td>'
                            // .'<td>'.$this->buildControl('deleteAnggotaUmum',$anggota->id).'</td>'
                            .'<td>'.''.'</td>'
                            .'</tr>';
            }
            if($list_anggota->count()<=0){
                $return .= '<tr><td colspan="4" align="center">Tidak ada data anggota</td></tr>';
            }

        }else{
            //data belum ada, cek session anggota, jika ada tampilkan data session anggota
            if(Session::has('anggota_ppm')){
                $session_anggota_ppm = Session::get('anggota_ppm');
                //setup data anggota
                foreach($session_anggota_ppm as $i=>$anggota){
                    $user = User::where('id',$anggota['user_id'])->first();
                    $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$user->full_name_gelar.'</td>'
                            .'<td><a href="#" class="btn btn-sm btn-outline-danger" onclick="function_ppm('.$anggota['user_id'].')" title="hapus anggota"><i class="fa fa-times"></i></a></td>'
                            .'</tr>';
                            // 
                }
                if(count($session_anggota_ppm)<=0){
                    $return .= '<tr><td colspan="4" align="center">Tidak ada data anggota</td></tr>';
                }


            }else{
                //data belum ada, session anggota juga tidak ada
                $return .= '<tr><td colspan="4" align="center">Tidak ada data anggota</td></tr>';
            }

        }

        $return .= '</table>';
        return $return;

    }

    public function deleteSessionAnggotaPpm(Request $request){
        $user_id = $request->user_id;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;

        foreach (Session::get('anggota_ppm', []) as $id => $entries) {
            if ($entries['user_id'] === $user_id) {
                Session::forget('anggota_ppm.' . $id);
                break; // stop loop
            }
            $this->clearSessionAnggotaPpm();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
