<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\models\Ppm;
use App\Common;
use Illuminate\Support\Facades\Session;

class PpmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePpm(Request $request)
    {
        // dd($request); /*jalan*/
        $user = auth()->user();
        $this->validate($request, [
            'jenis_ppm' => 'required'
            // 'lokasi_umum_id' => 'nullable',
            // 'tgl_mulai_umum'=>'required|date_format:"d-m-Y"',
            // 'tgl_akhir_umum' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_umum',
            // 'lama_umum' => 'required|integer',
            // 'info_untuk_umum'=> 'required',
            // 'info_dasar_umum'=> 'required'
            ]
        );
         $data = [
            'unsur_dupak' => Common::cleanInput($request['jenis_ppm'])
            // 'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_umum'])),
            // 'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_umum'])),
            // // 'lokasi_id' => $request['lokasi_umum_id'],
            // 'lama' => $request['lama_umum'],
            // 'info_untuk_umum' => Common::cleanInput($request['info_untuk_umum']),
            // 'info_dasar_umum' => Common::cleanInput($request['info_dasar_umum']),
        ];

        // dd($data);
        // die();

        $ppm = Ppm::create($data);
        if($ppm) {
            // $this->storeDetailAnggotaPpm($ppm->id, $ppm->lama);

            // return $spt;
            $ppm = Ppm::find($ppm->id);
            $unsur_dupak = $ppm->unsur_dupak;
            // $start =$spt->tgl_mulai;
            // $end = $spt->tgl_akhir;
            $lama = $ppm->lama;
            // $counter = array();
            if(Session::has('anggota_ppm'))
            {
                $session_anggota = Session::get('anggota_ppm');
                // dd($session_anggota);
                foreach($session_anggota as $k=>$anggota){
                    //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
                    // $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
                    // $isLembur = ( $lembur->count() > 0) ? true : false;
                    if($k === 0){
                        $peran = 'pejabat_utama';
                    }else{
                        $peran = 'peserta';
                    }
                    $dupak = [
                        'lama' => $anggota['lama'],
                        'dupak' => $anggota['dupak']
                    ];

                    DB::table('detai_ppm')->where('id',$ppm->id)->insertGetId([
                    // 'spt_id' => $spt_id,
                    'user_id' => $anggota['user_id'],
                    'peran' => $peran,
                    'lama' => $lama,
                    'info_dupak' => json_encode($dupak),
                    'unsur_dupak' => $unsur_dupak
                    //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
                ]);
                }
                // $this->clearSessionAnggotaUmum();
            }
            return;
        }
    }

    // public function storeDetailAnggotaPpm($ppm_id,$lama){
    //     $ppm = Ppm::find($ppm_id);
    //     $unsur_dupak = $spt->unsur_dupak;
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
    //             // $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
    //             // $isLembur = ( $lembur->count() > 0) ? true : false;
    //             if($k === 0){
    //                 $peran = 'pejabat_utama';
    //             }else{
    //                 $peran = 'peserta';
    //             }
    //             $dupak = [
    //                 'lama' => $anggota['lama'],
    //                 'dupak' => $anggota['dupak']
    //             ];

    //             DB::table('detai_ppm')->insertGetId([
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

    // contoh store spt umum dengan id mungkin
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
    //         $this->storeDetailAnggotaUmum($spt->id, $spt->lama);
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

    // public function storeDetailAnggotaUmum($spt_id,$lama){
    //     $spt = SptUmum::find($spt_id);
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
    //             $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
    //             $isLembur = ( $lembur->count() > 0) ? true : false;
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

    public function storePpmSessionAnggotaPpm(Request $request)
    {
        // dd($request);
        // die();
        $uid = $request->user_id;
        $tgl_mulai = date($request->tgl_mulai);
        $tgl_akhir = date($request->tgl_akhir);
        // $lama_jam = Common::cleanInput($request->lama_jam);
        // $dupak_anggota = Common::cleanInput($request->dupak_anggota);

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
                    'lama' => $request->lama_jam,
                    'dupak' => $request->dupak_anggota
                ]);
                return "Session anggota ppm updated";
            }

        }else{
            $session = Session::push('anggota_ppm', [
                'user_id'    => $request->user_id,
                // 'peran'   => 'Pegawai'
                'lama' => $request->lama_jam,
                'dupak' => $request->dupak_anggota
            ]);
            return "Session anggota ppm created";
        }
    }

    public function getAnggotaPpm($id_ppm=null)
    {
        $cek_data = ( $id_ppm == 0 ) ? 0 : Ppm::where('kode_kelompok', $id_ppm)->count();

        if($cek_data > 0){

            $cols = Ppm::where('kode_kelompok','=',$id_ppm)->with(['user'])->get();
            $dtt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('full_name', function($col){
                    return ($col->user) ? $col->user->full_name_gelar : 'User tidak ditemukan';
                })
                ->addColumn('nama_anggota', function($col){
                    return $col->user->full_name_gelar;
                })
                ->editColumn('lama', function($col){
                    return $col->spt->lama.' hari';
                })
                ->addColumn('action', function($col){
                    return $this->buildControl('deleteAnggotaUmum',$col->id);
                })->make(true);
                //return $dt;

        }else{
            //cek apakah ada session anggota
            if(Session::has('anggota_ppm')){
                $data = Session::get('anggota_ppm');
                //setup data anggota
                $dtt = Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('nama_anggota', function($col){
                        $user = User::findOrFail($col['user_id']);
                        return $user->full_name_gelar;
                    })
                    ->addColumn('action', function($col){
                        //hapus session by user_id
                        // unset_anggota('.$col['user_id'].')
                        return '<a href="#" class="btn btn-sm btn-outline-danger" onclick="">Hapus</a>';
                    })
                    ->make(true);

            }else{
                //eksekusi empty data karena tidak ditemukan data pada tabel ataupun session
                $data = [0=>['DT_RowIndex'=> '', 'nama_anggota'=>'', 'peran'=>'', 'action' => '']];
                $dtt = Datatables::of($data)->toJson();
            }
        }
        return $dtt;
    }

    // public function getAnggotaUmum($id=null)
    // {
    //     $cek_data = ( $id == 0 ) ? 0 : DetailSpt::where('spt_id', $id)->count();

    //     if($cek_data > 0){

    //         $cols = DetailSpt::where('spt_id','=',$id)->with(['user','spt'])->get();
    //         $dtt = Datatables::of($cols)
    //             ->addIndexColumn()
    //             ->addColumn('full_name', function($col){
    //                 return ($col->user) ? $col->user->full_name_gelar : 'User tidak ditemukan';
    //             })
    //             ->addColumn('nama_anggota', function($col){
    //                 return $col->user->full_name_gelar;
    //             })
    //             ->editColumn('lama', function($col){
    //                 return $col->spt->lama.' hari';
    //             })
    //             ->addColumn('action', function($col){
    //                 return $this->buildControl('deleteAnggotaUmum',$col->id);
    //             })->make(true);
    //             //return $dt;

    //     }else{
    //         //cek apakah ada session anggota
    //         if(Session::has('anggota_umum')){
    //             $data = Session::get('anggota_umum');
    //             //setup data anggota
    //             $dtt = Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('nama_anggota', function($col){
    //                     $user = User::findOrFail($col['user_id']);
    //                     return $user->full_name_gelar;
    //                 })
    //                 ->addColumn('action', function($col){
    //                     //hapus session by user_id
    //                     return '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset_anggota('.$col['user_id'].')">Hapus</a>';
    //                 })
    //                 ->make(true);

    //         }else{
    //             //eksekusi empty data karena tidak ditemukan data pada tabel ataupun session
    //             $data = [0=>['DT_RowIndex'=> '', 'nama_anggota'=>'', 'peran'=>'', 'action' => '']];
    //             $dtt = Datatables::of($data)->toJson();
    //         }
    //     }
    //     return $dtt;
    // }


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
