<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\models\DetailPpm;
use App\models\DetailSpt;
use App\models\Spt;
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
use Carbon\Carbon;

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
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Auditor');
            }
        )->get();
        // dd(auth()->user()->hasAnyRole(['Super Admin']));
        return view('admin.ppm.index',['listAnggota'=>$listAnggota,'users'=>$users]);
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
              ->addColumn('jenis_ppm', function($col){
                  // $jenis = DetailPpm::where('id_ppm',$col->id)->get();
                  // dd($jenis[0]);
                  // return $col->jenis_ppm;

                  $tambahan = (!is_null($col->jenis_ppm) ) ? '<br /> <small class="text-muted"> ' . ($col->jenis_ppm == 'Diklat Penjenjangan') ? 'PENGEMBANGAN PROFESI' : 'PENJUNJANG' . '</small>' : '';
                  $nama_spt = $col->jenis_ppm;
                  // return $nama_spt . $tambahan ;
                  return $nama_spt;
              })
              ->addColumn('action', function($col){
                    $return = '';
                    $return .= '<a href="#" onclick="showModalListPpm('.$col->id.')" class="btn btn-success">Lihat Anggota</a>';
                    $return .= '<a href="#" onclick="hapus_ppm('.$col->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-danger"><i class="ni ni-fat-remove"></i></a>';
                    return $return;
              })
              ->rawColumns(['ringkasan', 'action'])
              ->make(true);
        return $tb;
    }

    public function getPpmByid($id)
    {
        // return 'jalan';
        // dd($id);
        $querys = DetailPpm::where('id_ppm',$id)->get();
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
        // dd($request);
        // Pelatihan Kantor Sendiri
        $user = auth()->user();
        $this->validate($request, [
            'kegiatan_ppm'=> 'required',
            'tgl_mulai_ppm'=>'required|date_format:"d-m-Y"',
            ]
        );

        // sisipkan proses get value file
         $data = [
            'kegiatan' => Common::cleanInput($request['kegiatan_ppm']),
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm'])),
            'lama' => $request->hari_ppm,
            'jenis_ppm' => $request->unsur_ppm,
        ];

        // NOTE (mohon untuk dibaca terlebih dahulu jika mau mendebug) :
        // terdapat singkatan 
        // m(untuk tanggalan) = tgl_mulai (misal : cek_date_m_workshop)
        // a = tgl_akhir (misal : cek_date_m_workshop)
        // m(biasanya diakhir variable) = moderator (misal : getdata_workshop_m)
        // p(biasanya diakhir variable) = peserta (misal : get_data_p_workshop)

        $ppm = Ppm::create($data);
        $ppm_id = Ppm::find($ppm->id);
        $lama = $ppm_id->lama;

        if ($request->unsur_ppm == 'Pelatihan Kantor Sendiri'){
            /*fungsi workshop*/
            foreach ($request->moderator_narasumber as $index_m_pelatihan => $value_m_Workshop) {
                // $get_spt_workshop = DetailSpt::where('user_id',$request->moderator_narasumber[$index_m_Workshop])->with('spt')->get();

                /*blm bisa menolak input data yg sama > 2*/
                // $cekPpm_lebih_dari_1 = Ppm::where('tgl_mulai',date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm'])))->with('detail_ppm')->get();

                // dd($cekPpm_lebih_dari_1);
                $getdate_spt_pelatihan = DB::table('detail_spt')
                        ->where('user_id','=',$request->moderator_narasumber[$index_m_pelatihan])
                        ->join('spt','detail_spt.spt_id','=','spt.id')
                        ->whereRaw('"'.Carbon::parse($request->tgl_mulai_ppm).'" between `tgl_mulai` and `tgl_akhir`')
                        ->get();
                // dd($getdate_spt_pelatihan->count()>0);
                if (($getdate_spt_pelatihan->count()>0) == true) {
                    if ($getdate_spt_pelatihan) {
                    
                        $tgl_ppm = date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm']));
                        /*cek tb detail_ppm dan ppm jika tanggal ppm dan user sama > 2 / <= 2 maka akan menolak insert*/
                        $check_same_ppm_m = DetailPpm::where('user_id',$request->moderator_narasumber[$index_m_pelatihan])->whereHas('ppm', function($q) use ($tgl_ppm){
                            $q->where('tgl_mulai','=', $tgl_ppm);
                        })->get();
                        // dd(count($check_same_ppm_m) <= 2);
                        if(count($check_same_ppm_m) < 2) {
                            
                            /*start fungsi insert detail ppm*/

                            $hari_efektif_workshop = 1;
                            $lama_jam_workshop = 3;
                            $koefisien_workshop_m = 0.25;
                            $nilai_dupak_workshop = $koefisien_workshop_m * $lama_jam_workshop;
                            $peran = 'Moderator';

                            $dupak_workshop_m = [
                                'lama_jam' => $lama_jam_workshop,
                                'efektif' => $hari_efektif_workshop,
                                'lembur' => 0,
                                'dupak' => $nilai_dupak_workshop,
                                'koefisien' => $koefisien_workshop_m
                            ];
                            // dd($dupak_workshop_m);
                            $save_detail_ppm_m = DetailPpm::insert(['id_ppm' => $ppm_id->id,'user_id' => $request->moderator_narasumber[$index_m_pelatihan],'peran' => $peran,'lama' => $lama,'info_dupak'=>json_encode($dupak_workshop_m),'unsur_dupak' => 'pengembangan profesi']);
                            /*end set moderator ppm*/
                            

                            /*start nilai dupak dari spt workshop yg terimbas*/
                            foreach ($getdate_spt_pelatihan as $i => $v) {
                                
                                $nilai_dupak_workshop = $getdate_spt_pelatihan[$i]->info_dupak;
                                // nilai_dupak_pengawasan
                                $hari_efektif_terimbas_workshop = json_decode($nilai_dupak_workshop)->efektif;
                                if (count($check_same_ppm_m) > 1) {
                                    $lama_jam_terimbas_workshop = json_decode($nilai_dupak_workshop)->lama_jam - 4;
                                }else{
                                    $lama_jam_terimbas_workshop = json_decode($nilai_dupak_workshop)->lama_jam - 2;
                                }
                                $nilai_dupak_terimbas_workshop = json_decode($nilai_dupak_workshop)->koefisien * $lama_jam_terimbas_workshop;
                                
                                $dupak_moderator_terimbas_p = [
                                    'lama_jam' => $lama_jam_terimbas_workshop,
                                    'efektif' => $hari_efektif_terimbas_workshop,
                                    'lembur' => 0,
                                    'dupak' => $nilai_dupak_terimbas_workshop,
                                    'koefisien' => json_decode($nilai_dupak_workshop)->koefisien
                                ];
                                // dd($dupak_moderator_terimbas_p);
                            }
                                $update_pengawasan_terimbas_m = DetailSpt::where('user_id','=',$request->moderator_narasumber[$index_m_pelatihan])->where('spt_id',$getdate_spt_pelatihan[$i]->spt_id)->update(['info_dupak'=>json_encode($dupak_moderator_terimbas_p)]);

                            /*end nilai dupak workshop yg terimbas*/

                            // $return_moderator_succ = 'data moderator';
                            // $return_moderator_workshop_succ = 'data moderator';
                        }else{
                            $return_moderator_workshop_fail = 'Maaf data moderator';
                        }
                    }
                }else{
                    $hari_efektif_workshop = 1;
                    $lama_jam_workshop = 3;
                    $koefisien_workshop_m = 0.25;
                    $nilai_dupak_workshop = $koefisien_workshop_m * $lama_jam_workshop;
                    $peran = 'Moderator';

                    $dupak_workshop_m = [
                        'lama_jam' => $lama_jam_workshop,
                        'efektif' => $hari_efektif_workshop,
                        'lembur' => 0,
                        'dupak' => $nilai_dupak_workshop,
                        'koefisien' => $koefisien_workshop_m
                    ];
                    // dd($dupak_workshop_m);
                    $save_detail_ppm_m = DetailPpm::insert(['id_ppm' => $ppm_id->id,'user_id' => $request->moderator_narasumber[$index_m_pelatihan],'peran' => $peran,'lama' => $lama,'info_dupak'=>json_encode($dupak_workshop_m),'unsur_dupak' => 'pengembangan profesi']);
                }



                
            }

            foreach ($request->id_anggota_ppm as $index_p_pelatihan => $value_p_Workshop) {

                $tgl_ppm_p = date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm']));
                $check_same_ppm_p = DetailPpm::where('user_id',$request->id_anggota_ppm[$index_p_pelatihan])->whereHas('ppm', function($q) use ($tgl_ppm_p){
                        $q->where('tgl_mulai','=', $tgl_ppm_p);
                    })->get();
                    // dd($check_same_ppm_p);

                $getdate_peserta_pelatihan = DB::table('detail_spt')
                        ->where('user_id','=',$request->id_anggota_ppm[$index_p_pelatihan])
                        ->join('spt','detail_spt.spt_id','=','spt.id')
                        ->whereRaw('"'.Carbon::parse($request->tgl_mulai_ppm).'" between `tgl_mulai` and `tgl_akhir`')
                        ->get();
                        // dd($getdate_peserta_pelatihan);
                if (($getdate_peserta_pelatihan->count()>0) == true) {
                    if ($getdate_peserta_pelatihan) {
                        /*BELUM ada*/
                        if (count($check_same_ppm_p) < 2) {
                            
                            $this->storeNotaDinas($ppm->id, $request->file_nota_dinas);

                            $hari_efektif_workshop_p = 1;
                            $lama_jam_workshop_p = 3;
                            $koefisien_workshop_p = 0.1;
                            $nilai_dupak_workshop_p = $koefisien_workshop_p * $lama_jam_workshop_p;
                            $peran_p = 'Peserta';

                            $dupak_pelatihan_p = [
                                'lama_jam' => $lama_jam_workshop_p,
                                'efektif' => $hari_efektif_workshop_p,
                                'lembur' => 0,
                                'dupak' => $nilai_dupak_workshop_p,
                                'koefisien' => $koefisien_workshop_p
                            ];
                            // dd($dupak_pelatihan_p);
                            $save_detail_ppm = DetailPpm::insert(['id_ppm' => $ppm_id->id,'user_id' => $request->id_anggota_ppm[$index_p_pelatihan],'peran' => $peran_p,'lama' => $lama,'info_dupak'=>json_encode($dupak_pelatihan_p),'unsur_dupak' => 'pengembangan profesi']);
                            
                            /*peserta dupak terimbas */
                            foreach ($getdate_peserta_pelatihan as $i => $v) {
                                $nilai_dupak_pelatihan = $getdate_peserta_pelatihan[$i]->info_dupak;
                                // // nilai_dupak_pengawasan
                                $hari_efektif_terimbas_pelatihan = json_decode($nilai_dupak_pelatihan)->efektif;
                                if (count($check_same_ppm_p) > 1) {
                                   $lama_jam_terimbas_pelatihan = json_decode($nilai_dupak_pelatihan)->lama_jam - 4;
                                }else{
                                    $lama_jam_terimbas_pelatihan = json_decode($nilai_dupak_pelatihan)->lama_jam - 2;
                                }
                                $nilai_dupak_terimbas_pelatihan = json_decode($nilai_dupak_pelatihan)->koefisien * $lama_jam_terimbas_pelatihan;
                                $koefisien_terimbas_pelatihan = json_decode($nilai_dupak_pelatihan)->koefisien;

                                $dupak_terimbas_pelatihan_p = [
                                    'lama_jam' => $lama_jam_terimbas_pelatihan,
                                    'efektif' => $hari_efektif_terimbas_pelatihan,
                                    'lembur' => 0,
                                    'dupak' => $nilai_dupak_terimbas_pelatihan,
                                    'koefisien' => $koefisien_terimbas_pelatihan
                                ];
                                // dd($koefisien_terimbas_pelatihan);
                                $update_pengawasan_terimbas = DetailSpt::where('user_id','=',$request->id_anggota_ppm[$index_p_pelatihan])->where('spt_id',$getdate_peserta_pelatihan[$i]->spt_id)->update(['info_dupak'=>json_encode($dupak_terimbas_pelatihan_p)]);
                            }
                            
                        }else{
                            
                            return redirect()->back()->withErrors(['Maaf '.$return_moderator_workshop_fail.' dan data peserta Pelatihan Kantor Sendiri yang anda masukkan sudah ada!']);
                        }
                    }
                }else{
                    $this->storeNotaDinas($ppm->id, $request->file_nota_dinas);

                    $hari_efektif_workshop_p = 1;
                    $lama_jam_workshop_p = 3;
                    $koefisien_workshop_p = 0.1;
                    $nilai_dupak_workshop_p = $koefisien_workshop_p * $lama_jam_workshop_p;
                    $peran_p = 'Peserta';

                    $dupak_pelatihan_p = [
                        'lama_jam' => $lama_jam_workshop_p,
                        'efektif' => $hari_efektif_workshop_p,
                        'lembur' => 0,
                        'dupak' => $nilai_dupak_workshop_p,
                        'koefisien' => $koefisien_workshop_p
                    ];
                    // dd($dupak_pelatihan_p);
                    $save_detail_ppm = DetailPpm::insert(['id_ppm' => $ppm_id->id,'user_id' => $request->id_anggota_ppm[$index_p_pelatihan],'peran' => $peran_p,'lama' => $lama,'info_dupak'=>json_encode($dupak_pelatihan_p),'unsur_dupak' => 'pengembangan profesi']);
                }

                
            }
            return redirect()->back()->with('msg','Data Moderator dan Peserta Pelatihan Kantor Sendiri berhasil diinputkan!');
            /*alasan di bedakan foreachnya karena sudah berbeda index / data arraynya antara moderator dengan peserta*/
        }
    }

    // fungsi upload file nota dinas 
    public function storeNotaDinas($ppm_id,$file)
    {
        if (isset($ppm_id,$file)){
            $ppm = Ppm::find($ppm_id);

            $filename = ($file) ? 'Nota Dinas-' . $ppm->id . '-' . $file->getClientOriginalName() : null ;

            if($filename !== null ){
                if (! File::exists(public_path()."/storage/ppm")) {
                    File::makeDirectory(public_path()."/storage/ppm", 0755, true);
                }
                $file->move(public_path()."/storage/ppm" , $filename);
            }
            $ppm->nota_dinas = ($filename !== null ) ? url('/storage/spt/'.$filename) : null;
            $ppm->nama_file = ($filename !== null ) ? $filename : null;
            $ppm->save();
            return 'Updated file';
        }
        return 'tidak ada file yang diupload';
    }
    // end fungsi

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
        $ppm_id = DetailPpm::where('id', $request->ppm_id)->first();
        //dd($request->spt_id);$this->buildControl('deleteAnggota',$col->id); '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
        $return = '<table class="table table-bordered table-hover">'
                        .'<thead><tr>'
                            .'<th>No.</th>'
                            .'<th>Nama</th>'
                            .'<th></th>'
                        .'</tr></thead>';

        if($ppm_id != null){
            //bukan spt baru, data spt sudah ada, tampilkan data anggota spt dari tabel detail
            $list_anggota = DetailPpm::where('spt_id', $request->ppm_id)->with('user')->get();
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

    public function deletePpm($id)
    {
        // dd('fungsi jalan');
        $id_ppm = Ppm::findOrFail($id);
        $delete_detail_ppm = DetailPpm::where('id_ppm',$id_ppm->id)->delete();
        $delete_nota_dinas = File::delete($id_ppm->nota_dinas);
        Ppm::destroy($id);

        return ($delete_detail_ppm == true) ? 'data has been deleted' : 'data cant deleted cause u got a problem !';
    }

    // public function TableAnggotaPpm(Request $request)
    // {   
    //     // $request->selectedid yang dikirimkan oleh view lebih dari 1 index
    //     if ($request->selectedid == null) {
    //         $data = null;
    //         return response()->json($data);
    //     }else{
    //         // percobaan
    //         // $i = 0;
    //         // foreach ($request->selectedid as $index_user => $value_user ) {
    //         //     $user = User::where('id',$request->selectedid[$index_user])->whereHas(
    //         //         'roles', function($q){
    //         //             $q->where('name', 'Auditor');
    //         //         }
    //         //     )->get();

    //         //     $s[$i] = [
    //         //         $user,
    //         //     ];

    //         //     $i++;
    //         // }
    //         // dd($s);
    //         // end percobaan

    //         // json_decode($request->selectedid[$key])
    //         foreach ($request->selectedid as $key => $value) {
    //             $user = User::where('id',$request->selectedid[$key])->whereHas(
    //                 'roles', function($q){
    //                     $q->where('name', 'Auditor');
    //                 }
    //             )->get();
    //             // $data = [$user[$key]];
    //             return response()->json([$user[$key]]);
    //         }
    //         // NOTE : return $data setelah diloop menghasilkan 1 index
    //         // return response()->json($s);
    //     }
    // }
}
