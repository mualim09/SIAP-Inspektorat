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
use Config, File;
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

    // datatable ppm
    public function getdataPpm()
    {
        $data = Ppm::orderBy('id', 'DESC')->get();
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
                  $return = '<a href="#" onclick="showModalListPpm('.$col->id.')" class="btn btn-sm">Anggota     PPM</a>';
                  return $return;
              })
              ->escapeColumns([])
              ->make(true);
        return $tb;
    }

    public function getPpmByid($id)
    {
        // return 'jalan';
        // dd($id);
        $querys = Detail_ppm::where('id_ppm',$id)->get();
        $tb = Datatables::of($querys)
              ->addIndexColumn()
              ->addColumn('nama', function($col){
                    $user = User::findOrFail($col->user_id);
                    // dd($user);
                    return $user->first_name.' '.$user->last_name.''.$user->gelar;
              })
              ->addColumn('peran', function($col){
                    return $col->peran;
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
        // dd($request->file_nota_dinas);
        // return 'fungsi berjalan '; /*jalan*/
        $user = auth()->user();
        $this->validate($request, [
            'jenis_ppm' => 'required',
            // 'lokasi_umum_id' => 'nullable',
            'kegiatan_ppm'=> 'required',
            'tgl_mulai_ppm'=>'required|date_format:"d-m-Y"',
            'tgl_akhir_ppm' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_ppm',
            'lama_ppm' => 'required|integer'
            // 'info_dasar_umum'=> 'required'
            ]
        );

        // sisipkan proses get value file

         $data = [
            'kegiatan' => Common::cleanInput($request['kegiatan_ppm']),
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_ppm'])),
            // 'lokasi_id' => $request['lokasi_umum_id'],
            'lama' => $request['lama_ppm'],
            'jenis_ppm' => Common::cleanInput($request['jenis_ppm']),
            // 'nota_dinas' => 'isinya url file',
        ];

        // dd($data);
        // die();

        // $file = json_encode();
        $ppm = Ppm::create($data);
        if($ppm) {
            $this->storeDetailPpm($ppm->id, $ppm->lama, $request->file_nota_dinas)  ;

            return $ppm;
        }
    }

    public function storeDetailPpm($ppm_id,$lama,$file)
    {
        // dd($request);
        $ppm = Ppm::find($ppm_id);
        //dd($spt);
        $unsur_dupak = $ppm->jenis_ppm;
        $start =$ppm->tgl_mulai;
        $end = $ppm->tgl_akhir;
        $lama = $ppm->lama;
        $counter = array();
        $file_nota_dinas = $file;
        // dd($file_nota_dinas);

        if(Session::has('anggota_ppm'))
        {
            $session_anggota = Session::get('anggota_ppm');
            // dd($session_anggota);
            foreach($session_anggota as $k=>$anggota){
                //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
                //$lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
                //$isLembur = ( $lembur->count() > 0) ? true : false;
                if($k === 0){
                    $peran = 'Pejabat Utama';
                }else{
                    $peran = 'Peserta';
                }
                $dupak = [
                    'lama' => $anggota['lama'],
                    'dupak' => $anggota['dupak']
                ];

                DB::table('detail_ppm')->insertGetId([
                'id_ppm' => $ppm_id,
                'user_id' => $anggota['user_id'],
                'peran' => $peran,
                'lama' => $lama,
                'info_dupak' => json_encode($dupak),
                'unsur_dupak' => $unsur_dupak
                //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
            ]);
            }
            $this->clearSessionAnggotaPpm();
        }

        // NOTE : masih error untuk upload file 
        // proses update nota dinas
        $filename = ($file_nota_dinas) ? 'Nota Dinas-' . $ppm->id . '-' . $file_nota_dinas->getClientOriginalName() : null ;
        // if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/ppm")) {
                File::makeDirectory(public_path()."/storage/ppm", 0755, true);
            }
            $request->file_spt->move(public_path()."/storage/ppm" , $filename);
        }
        //$spt->file = ($filename !== null ) ? url('/storage/spt/'.$filename) : null;
        $ppm->nota_dinas = ($filename !== null ) ? $filename : null;
        $ppm->save();
        // return 'Updated';
        return;
    }
    
    // public function uploadScanSpt(Request $request){
    //     //metode sama seperti updateNomorSpt, namun hanya untuk upload file spt saja.

    //     $id = $request->spt_id;
    //     $spt = Spt::findOrFail($id);

    //     $filename = ($request->file_spt) ? 'SPT-' . $id . '-' . $request->file_spt->getClientOriginalName() : null ;
    //     //if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
    //     if($filename !== null ){
    //         if (! File::exists(public_path()."/storage/spt")) {
    //             File::makeDirectory(public_path()."/storage/spt", 0755, true);
    //         }
    //         $request->file_spt->move(public_path()."/storage/spt" , $filename);
    //     }
    //     //$spt->file = ($filename !== null ) ? url('/storage/spt/'.$filename) : null;
    //     $spt->file = ($filename !== null ) ? $filename : null;
    //     $spt->save();
    //     return 'Updated';
    // }

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
