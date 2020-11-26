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
              ->addColumn('action', function($col){
                    $return = '';
                    $return .= '<a href="#" onclick="showModalListPpm('.$col->id.')" class="btn btn-success">Lihat Anggota</a>';
                    $return .= '<a href="#" onclick="hapus_ppm('.$col->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-danger"><i class="ni ni-fat-remove"></i></a>';
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
            'jenis_ppm' => Common::cleanInput($request['unsur_ppm']),
        ];

        // $ppm = Ppm::create($data);
        // if($ppm) {
            
        //     // start fungsi insert detail ppm
        //     $ppm_id = Ppm::find($ppm->id);
        //     $unsur_dupak = $ppm_id->jenis_ppm;
        //     $lama = $ppm_id->lama;

            /*kondisi PENUNJANG (Diklat Teknis Substantif penunjang pengawasan)*/
            if ($request->moderator_narasumber != null && $request->id_anggota_ppm != null){
                
                    /* start foreach moderator & narasumber */
                    foreach ($request->moderator_narasumber as $index_moderator => $value_moderator) {
                        $peran = 'Moderator / Narasumber';

                        /*start set moderator ppm*/
                        $get_spt_pengawasan = DetailSpt::where('user_id',$request->moderator_narasumber[$index_moderator])->with('spt')->get();

                        $tgl_ppm = date('Y-m-d H:i:s',strtotime($request['tgl_mulai_ppm']));
                        
                        $rawq_spt_pengawasan = DB::table('detail_spt')
                                ->where('user_id','=',$request->moderator_narasumber[$index_moderator])
                                ->join('spt','detail_spt.spt_id','=','spt.id')
                                ->whereRaw('"'.Carbon::parse($request->tgl_mulai_ppm).'" between `tgl_mulai` and `tgl_akhir`')
                                ->get();
                        dd($tgl_ppm);
                        die();

                        // $hari_efektif_ppm = 1;
                        // $lama_jam_ppm = 3;
                        // $koefisien_moderator = 0.038;
                        // $nilai_dupak = $koefisien_moderator * $lama_jam_ppm;

                        // $dupak_moderator_ppm = [
                        //     'dupak' => $nilai_dupak,
                        //     'lembur' => 0,
                        //     'efektif' => $hari_efektif_ppm,
                        //     'lama_jam' => $lama_jam_ppm,
                        //     'koefisien' => $koefisien_moderator
                        // ];
                        
                        // $save_detail_ppm = DetailPpm::insert(['id_ppm' => $ppm_id->id,'user_id' => $value_moderator,'peran' => $peran,'lama' => $lama,'info_dupak'=>json_encode($dupak_moderator_ppm),'unsur_dupak' => $unsur_dupak]);
                        // /*end set moderator ppm*/
                        

                        // /*start nilai dupak dari spt pengawasan yg terimbas*/
                        // $nilai_dupak_pengawasan = $get_spt_pengawasan[$index_moderator]->info_dupak;

                        // $nilai_dupak_terimbas = $nilai_dupak_pengawasan['dupak'] - $nilai_dupak;
                        // $hari_efektif_terimbas = $nilai_dupak_pengawasan['efektif'] - $hari_efektif_ppm;
                        // $lama_jam_terimbas = $nilai_dupak_pengawasan['lama_jam'] - $lama_jam_ppm + 1;
                        
                        // $dupak_moderator_terimbas = [
                        //     'dupak' => $nilai_dupak_terimbas,
                        //     'lembur' => 0,
                        //     'efektif' => $hari_efektif_terimbas,
                        //     'lama_jam' => $lama_jam_terimbas,
                        //     'koefisien' => $nilai_dupak_pengawasan['koefisien']
                        // ];

                        // $update_pengawasan_terimbas = DetailSpt::where('user_id','=',$request->moderator_narasumber[$index_moderator])->where('spt_id',$rawq_spt_pengawasan[$index_moderator]->spt_id)->update(['info_dupak'=>json_encode($dupak_moderator_terimbas)]);
                        /*end nilai dupak pengawasan yg terimbas*/
                        
                    }
                    /* end foreach moderator & narasumber */

                    /* start foreach peserta ppm */
                    // foreach (json_decode($request->id_anggota_ppm) as $index_moderator => $value_moderator) {

                    //     $peran = 'Peserta';

                    //     $dupak = [
                    //         'lama' => '3',
                    //         'dupak' => '0,1'
                    //     ];
                    //     // dd($value_moderator);
                    //     // DB::table('detail_ppm')->insertGetId([
                    //     // 'id_ppm' => $ppm->id,
                    //     // 'user_id' => $value_moderator,
                    //     // 'peran' => $peran,
                    //     // 'lama' => '1',
                    //     // 'info_dupak' => json_encode($dupak),
                    //     // 'unsur_dupak' => $unsur_dupak
                    //     // ]);
                        
                    // }
                    /* end foreach peserta ppm */
                }
            // end fungsi insert detail ppm
                /*kondisi PENGEMBANGAN PROFESI (Diklat Penjenjangan)*/
                if($request->moderator_narasumber == null && $request->id_anggota_ppm != null){

                }

            /*throwing id ppm and file nota dinas*/
            // $this->storeNotaDinas($ppm->id, $request->file_nota_dinas);

            // return $ppm;
        // }
    }

    // fungsi upload file nota dinas 
    public function storeNotaDinas($ppm_id,$file)
    {
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
