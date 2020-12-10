<?php

/***
 *                    _      _____                   _                    _   _
 *                   | |    / ____|                 | |                  | | | |
 *      ___   _ __   | |_  | |        ___    _ __   | |_   _ __    ___   | | | |   ___   _ __
 *     / __| | '_ \  | __| | |       / _ \  | '_ \  | __| | '__|  / _ \  | | | |  / _ \ | '__|
 *     \__ \ | |_) | | |_  | |____  | (_) | | | | | | |_  | |    | (_) | | | | | |  __/ | |
 *     |___/ | .__/   \__|  \_____|  \___/  |_| |_|  \__| |_|     \___/  |_| |_|  \___| |_|
 *           | |
 *           |_|
 */

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\models\Spt;
use App\models\SptUmum, App\models\Pejabat;
use App\models\JenisSpt;
use App\models\DetailSpt;
use App\models\Lokasi, App\models\DetailKuota;
use App\User;
use App\models\Dupak, App\models\KodeTemuan;
use App\Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Config, File;
use DB, PDF;
use App\Common;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Response;
use App\models\FileMedia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\Element\Table;


class SptController extends Controller
{

    private $list_peran = ['Penanggungjawab', 'Pembantu Penanggungjawab','Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota'];

    public function __construct() {
        $this->middleware(['auth', 'spt']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spt = Spt::orderBy('created_at', 'asc')->get();
        $listLokasi = Lokasi::all();
        $jenisSpt = JenisSpt::all();
        $listAnggota = User::select(['id','first_name','last_name', 'gelar'])->get();
        $pj = User::whereHas('pejabat', function($q){
            $q->where( 'name','Inspektur Kabupaten');
        })->first();
        $user_ppm = User::select(['id','first_name','last_name', 'gelar'])->whereNotNull('jenis_auditor')->whereNotIn('jabatan', ['Inspektur Pembantu Wilayah I','Inspektur Pembantu Wilayah II','Inspektur Pembantu Wilayah III','Inspektur Pembantu Wilayah IV'])->get();
        $ppjs = User::whereHas('pejabat', function($q){
            $q->where('name','like', 'Inspektur Pembantu%');
        })->get();

        $pms = User::whereIn('jabatan', ['Auditor Utama', 'Auditor Madya'])->get(); 
        $pts = User::whereIn('jabatan', ['Auditor Utama', 'Auditor Madya', 'Auditor Muda'])->get(); 
        $kets = User::whereIn('jabatan', ['Auditor Madya', 'Auditor Muda','Auditor Pertama'])->get();
        $anggotas = User::whereNotIn('jabatan', ['Auditor Utama'])->doesntHave('pejabat')
                ->where('email','!=','admin@local.host')
                ->orderBy('ruang->nama','asc')
                ->get();
                
        return view('admin.spt.index',
            [
            'user_ppm' =>$user_ppm,
            'spt'=>$spt,
            'jenis_spt'=>$jenisSpt,
            'listAnggota'=>$listAnggota,
            'pj'=>$pj,
            'ppjs'=>$ppjs,
            'pms'=>$pms,
            'pts'=>$pts,
            'kets'=>$kets,
            'anggotas'=>$anggotas,
            //'checkbox'=>$checkbox,
            'listPeran'=>$this->list_peran,
            'listLokasi' => $listLokasi,
            ]
        );
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
    public function store(Request $request)
    {
       $user = auth()->user();
        //dd($request->pj.':penanggungjawab '.$request->a3.':anggota ke 3');
        $this->validate($request, [
            'jenis_spt_id' => 'required|integer',
            'tgl_mulai'=>'required|date_format:"d-m-Y"',
            'tgl_akhir' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai',
            'lama' => 'required|integer',
            'lokasi_id' => 'nullable',
            'tambahan' => 'nullable|string|min:10',
            'info' => 'nullable'
            ]
        );
         $data = [
            'jenis_spt_id' => $request['jenis_spt_id'],
            'name' => Common::cleanInput($request['name']),
            'tgl_mulai' => date("Y-m-d H:i:s", strtotime($request['tgl_mulai'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir'])),
            'lama' => $request['lama'],
            'lokasi_id' => $request['lokasi_id'],
            'tambahan' => Common::cleanInput($request['tambahan']),
            'info' => $request['info'],
        ];

        $spt = Spt::create($data);
        if($spt) {

            //$this->storeDetail($spt->id, $spt->lama);
            //direct insert
            //$unsur_dupak = $spt->jenisSpt->kategori;
            if($request->pj){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $spt->id,
                    'user_id' => $request->pj,
                    'peran' => 'Penanggungjawab',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->ppj){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $spt->id,
                    'user_id' => $request->ppj,
                    'peran' => 'Pembantu Penanggungjawab',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->pm){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $spt->id,
                    'user_id' => $request->pm,
                    'peran' => 'Pengendali Mutu',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->pt){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $spt->id,
                    'user_id' => $request->pt,
                    'peran' => 'Pengendali Teknis',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->ket){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $spt->id,
                    'user_id' => $request->ket,
                    'peran' => 'Ketua Tim',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->anggota_id){
                foreach($request->anggota_id as $anggota_id){
                    DB::table('detail_spt')->insertGetId([
                        'spt_id' => $spt->id,
                        'user_id' => $anggota_id,
                        'peran' => 'Anggota',
                        'unsur_dupak' => 'pengawasan',
                    ]);
                }
            }
            /*//user id pembuat spt
            $info['user_id'] = $user->id;
            $info['type'] = 'spt';

            //role perencanaan jika membuat spt maka otomatis menjadi spt pengawasan, jika role TU umum: spt umum, selain itu set NULL.
            $info['jenis'] = 'pengawasan';

            $info['spt_id'] = $spt->id;
            $insertArr = [
               'title' => $spt->jenisSpt->sebutan,
               'start' => $spt->tgl_mulai,
               'end' => $spt->tgl_akhir,
               'info' => $info
            ];
            $event = Event::create($insertArr);*/

            return $spt;
        }

    }

    public function storeUmum(Request $request){
        //masukkan kode store SPT bagian umum

        $user = auth()->user();
        $this->validate($request, [
            'jenis_spt_umum' => 'required',
            // 'lokasi_umum_id' => 'nullable',
            'tgl_mulai_umum'=>'required|date_format:"d-m-Y"',
            'tgl_akhir_umum' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_umum',
            'lama_umum' => 'required|integer',
            'info_untuk_umum'=> 'required',
            'info_dasar_umum'=> 'required'
            ]
        );
         $data = [
            'jenis_spt_umum' => Common::cleanInput($request['jenis_spt_umum']),
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_umum'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_umum'])),
            // 'lokasi_id' => $request['lokasi_umum_id'],
            'lama' => $request['lama_umum'],
            'info_untuk_umum' => Common::cleanInput($request['info_untuk_umum']),
            'info_dasar_umum' => Common::cleanInput($request['info_dasar_umum']),
        ];

        // dd($data);
        // die();

        $spt = SptUmum::create($data);
        if($spt) {
            // dd($spt->lama);
            $this->storeDetailUmum($spt->id, $spt->lama);
            // $this->storeDetailKepadaUmum($spt->id, $spt->lama);

            //user id pembuat spt
            // $info['user_id'] = $user->id;
            // $info['type'] = 'spt';

            // //role perencanaan jika membuat spt maka otomatis menjadi spt pengawasan, jika role TU umum: spt umum, selain itu set NULL.
            // $info['jenis'] = ( $user->hasRole('TU Perencanaan') ) ? 'pengawasan' : (($user->hasRole('TU Umum')) ? 'umum' : NULL);

            // $info['spt_id'] = $spt->id;
            // $insertArr = [
            //    'title' => $request['jenis_spt_umum'],
            //    'start' => $spt->tgl_mulai,
            //    'end' => $spt->tgl_akhir,
            //    'info' => $info
            // ];
            // $event = Event::create($insertArr);
            // dd($event);

            return $spt;
        }
    }

    //dibawah ini function storeDetailAnggotaUmum punya mas tegar, di nonaktifkan / di comment
    public function storeDetailUmum($spt_id,$lama){
        //dd($request);
        $spt = SptUmum::find($spt_id);
        //dd($spt);
        $unsur_dupak = $spt->jenis_spt_umum;
        $start =$spt->tgl_mulai;
        $end = $spt->tgl_akhir;
        $lama = $spt->lama;
        $counter = array();

        if(Session::has('anggota_umum'))
        {
            $session_anggota = Session::get('anggota_umum');
            // dd($session_anggota);
            foreach($session_anggota as $k=>$anggota){
                //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
                //$lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
                //$isLembur = ( $lembur->count() > 0) ? true : false;
                if($k === 0){
                    $peran = 'pejabat_utama';
                }else{
                    $peran = 'anggota';
                }
                $dupak = [
                    'lama' => $anggota['lama'],
                    'dupak' => $anggota['dupak']
                ];

                if($spt->jenis_spt_umum == 'SPT Pengembangan Profesi'){
                    $unsur_dupak = 'pengembangan profesi';
                }if($spt->jenis_spt_umum == 'SPT Penunjang'){
                    $unsur_dupak = 'penunjang';
                }if($spt->jenis_spt_umum == 'SPT Diklat'){
                    $unsur_dupak = 'diklat';
                }

                DB::table('detail_spt')->insertGetId([
                'spt_id' => $spt_id,
                'user_id' => $anggota['user_id'],
                'peran' => $peran,
                'lama' => $lama,
                'info_dupak' => json_encode($dupak),
                'unsur_dupak' => $unsur_dupak
                //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
            ]);
            }
            $this->clearSessionAnggotaUmum();
        }
        return;
    }

    public function storeDetailAnggotaUmum(Request $request){
        $cek = DetailSpt::where('spt_id', $request->spt_id)->where('user_id', $request->user_id)->where('unsur_dupak', '!=', 'pengawasan')->count();
        //user_id:user_id, peran:peran, spt_id:id_spt, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir
        $cek_peran =  DetailSpt::where('spt_id', $request->spt_id)->where('unsur_dupak', '!=', 'pengawasan')->where('peran','pejabat_utama')->count();
        $peran = ($cek_peran>0) ? 'anggota' : 'pejabat_utama' ;
        if($cek>0):
            return 'User sudah ada dalam list anggota';
        else:
            $spt = SptUmum::where('id',$request->spt_id)->first();
            //dd($spt);
            $unsur_dupak = $spt->jenis_spt_umum;
            $start =$spt->tgl_mulai;
            $end = $spt->tgl_akhir;
            $lama = $spt->lama;
            $dupak = [
                    'lama' => $request->lama_jam,
                    'dupak' => $request->dupak_anggota
                ];
            $counter = array();
            $store = DB::table('detail_spt')->insertGetId([
                    'spt_id' => $request->spt_id,
                    'user_id' => $request->user_id,
                    'peran' => Common::cleanInput($peran),
                    'unsur_dupak' => $unsur_dupak,
                    'info_dupak' => json_encode($dupak)
                ]);
            if($store){
                return $store;
            }else{
                return 'Gagal menambahkan anggota SPT!';
            }
        endif;
        //_token: CSRF_TOKEN, user_id:user_id, spt_id:id_spt, tgl_mulai: tgl_mulai, tgl_akhir:tgl_akhir, lama_jam:lama_jam, dupak_anggota:dupak_anggota
    }

    public function storeDetail($spt_id,$lama){
        $spt = Spt::find($spt_id);
        $unsur_dupak = $spt->jenisSpt->kategori;
        $start =$spt->tgl_mulai;
        $end = $spt->tgl_akhir;
        $lama = $spt->lama;
        $counter = array();

        if(Session::has('anggota'))
        {
            $session_anggota = Session::get('anggota');
            foreach($session_anggota as $anggota){
                //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
                $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $anggota['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
                $isLembur = ( $lembur->count() > 0) ? true : false;

                //$unsur_dupak = $spt->jenisSpt->kategori;
                DB::table('detail_spt')->insertGetId([
                'spt_id' => $spt_id,
                'user_id' => $anggota['user_id'],
                'peran' => Common::cleanInput($anggota['peran']),
                'unsur_dupak' => $unsur_dupak,
                //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
            ]);
            }
            $this->clearSessionAnggota();
        }
        return;
    }

    public function storeDetailAnggota(Request $request){
        /*$cek = DetailSpt::where('spt_id', $request->spt_id)->where('user_id', $request->user_id)->count();        
        if($cek>0):
            return 'User sudah ada dalam list anggota';
        else:
            $spt = Spt::where('id',$request->spt_id)->first();            
            $unsur_dupak = 'pengawasan';
            $start =$spt->tgl_mulai;
            $end = $spt->tgl_akhir;
            $lama = $spt->lama;
            $counter = array();
            $store = DB::table('detail_spt')->insertGetId([
                    'spt_id' => $request->spt_id,
                    'user_id' => $request->user_id,
                    'peran' => Common::cleanInput($request->peran),
                    'unsur_dupak' => $unsur_dupak,                    
                ]);
            if($store){
                return 'Anggota SPT berhasil ditambahkan';
            }else{
                return 'Gagal menambahkan anggota SPT!';
            }
        endif;*/
        $spt = Spt::where('id',$request->spt_id)->first();            
        $unsur_dupak = 'pengawasan';
        $start =$spt->tgl_mulai;
        $end = $spt->tgl_akhir;
        $lama = $spt->lama;
        $counter = array();
        $store = DB::table('detail_spt')->insertGetId([
                'spt_id' => $request->spt_id,
                'user_id' => $request->user_id,
                'peran' => Common::cleanInput($request->peran),
                'unsur_dupak' => $unsur_dupak,                    
            ]);
        if($store){
            return 'Anggota SPT berhasil ditambahkan';
        }else{
            return 'Gagal menambahkan anggota SPT!';
        }
    }

    public function updateUmum(Request $request){
        //masukkan kode untuk update SPT bagian umum
        //info_dasar_umum:info_dasar_umum, info_untuk_umum:info_untuk_umum, jenis_spt_umum:jenis_spt_umum, lokasi_umum_id:lokasi_umum_id, tgl_mulai_umum:tgl_mulai_umum, tgl_akhir_umum:tgl_akhir_umum, lama_umum:lama_umum,  _method: method
        $this->validate($request, [
            'jenis_spt_umum' => 'required|string',
            'info_untuk_umum'=> 'string',
            'info_dasar_umum'=> 'string',
            'tgl_mulai_umum'=>'required|date_format:"d-m-Y"',
            'tgl_akhir_umum' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai_umum',
            'lama_umum' => 'required|integer',
            'lokasi_umum_id' => 'nullable'
            ]
        );
         $data = [
            'jenis_spt_umum' => $request['jenis_spt_umum'],
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai_umum'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir_umum'])),
            'lama'=> $request->lama_umum,
            'lokasi_id' => $request['lokasi_umum_id'],
            'info_untuk_umum' => Common::cleanInput($request['info_untuk_umum']),
            'info_dasar_umum' => Common::cleanInput($request['info_dasar_umum']),            
        ];

        $spt = SptUmum::findOrFail($request->spt_umum_id);
        $spt->jenis_spt_umum = $data['jenis_spt_umum'];
        $spt->tgl_mulai = $data['tgl_mulai'];
        $spt->tgl_akhir = $data['tgl_akhir'];
        $spt->lama = $data['lama'];
        $spt->lokasi_id = $data['lokasi_id'];
        $spt->info_dasar_umum = $data['info_dasar_umum'];
        $spt->info_untuk_umum = $data['info_untuk_umum'];
        if($spt->save()){
            return $spt;
        }else{
            return 'error';
        }

    }

    public function updateDetail(Request $request){

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
        $spt = Spt::where('id',$id)->with(['jenisSpt','detailSpt'=>function($q){
            $q->where('unsur_dupak','pengawasan');
        }])->first();
        //dd($spt);
        //$jenis_spt = $spt->jenisSpt;
        $spt['tgl_mulai'] = date('d-m-Y', strtotime($spt->tgl_mulai));
        $spt['tgl_akhir'] = date('d-m-Y', strtotime($spt->tgl_akhir));
        return $spt;
        //return $jenis_spt;
        //return $detail_spt;
    }

    public function editSptUmum($id){
        $spt_umum = SptUmum::find($id);
        $spt_umum['tgl_mulai'] = date('d-m-Y', strtotime($spt_umum->tgl_mulai));
        $spt_umum['tgl_akhir'] = date('d-m-Y', strtotime($spt_umum->tgl_akhir));
        return $spt_umum;
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

        $this->validate($request, [
            'jenis_spt_id' => 'required|integer',
            'tgl_mulai'=>'required|date_format:"d-m-Y"',
            'tgl_akhir' =>'required|date_format:"d-m-Y"|after_or_equal:tgl_mulai',
            'lama' => 'required|integer',
            'lokasi_id' => 'nullable',
            'tambahan' => 'nullable|string|min:10',
            'info' => 'nullable'
            ]
        );
         $data = [
            'jenis_spt_id' => $request['jenis_spt_id'],
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir'])),
            'lama'=> $request->lama,
            'lokasi_id' => $request['lokasi_id'],
            'tambahan' => Common::cleanInput($request['tambahan']),
            'info' => $request['info'],
        ];


        $spt = Spt::findOrFail($id);
        $spt->jenis_spt_id = $data['jenis_spt_id'];
        $spt->tgl_mulai = $data['tgl_mulai'];
        $spt->tgl_akhir = $data['tgl_akhir'];
        $spt->lama = $data['lama'];
        $spt->lokasi_id = $data['lokasi_id'];
        $spt->tambahan = Common::cleanInput($data['tambahan']);
        $spt->info = $data['info'];
        $spt = $spt->save();
        if($spt){
            $updated_spt = Spt::findOrFail($id);
            $jenis_spt = JenisSpt::select('name','sebutan')->where('id',$updated_spt['jenis_spt_id'])->first();            

            //hapus data detail terlebih dahulu
            DetailSpt::where('spt_id',$id)->where('unsur_dupak','pengawasan')->delete();

            //setelah itu, mutakhirkan data detail spt
            if($request->pj){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $id,
                    'user_id' => $request->pj,
                    'peran' => 'Penanggungjawab',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->ppj){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $id,
                    'user_id' => $request->ppj,
                    'peran' => 'Pembantu Penanggungjawab',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->pm){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $id,
                    'user_id' => $request->pm,
                    'peran' => 'Pengendali Mutu',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->pt){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $id,
                    'user_id' => $request->pt,
                    'peran' => 'Pengendali Teknis',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->ket){
                DB::table('detail_spt')->insertGetId([
                    'spt_id' => $id,
                    'user_id' => $request->ket,
                    'peran' => 'Ketua Tim',
                    'unsur_dupak' => 'pengawasan',
                ]);
            }

            if($request->anggota_id){
                foreach($request->anggota_id as $anggota_id){
                    DB::table('detail_spt')->insertGetId([
                        'spt_id' => $id,
                        'user_id' => $anggota_id,
                        'peran' => 'Anggota',
                        'unsur_dupak' => 'pengawasan',
                    ]);
                }
            }

            

            //update event SPT dipindah saat register baru memasukkan event (event valid)
           /* $user = auth()->user();
            $event = Event::where('info->spt_id',$id)->update([
               'title' => $jenis_spt->sebutan,
               'start' => $updated_spt->tgl_mulai,
               'end' => $updated_spt->tgl_akhir,
               'info' => json_encode([
                           'user_id' => $user->id, //user id pembuat spt
                           'type' => 'spt',
                           'jenis'=>'pengawasan',
                           'spt_id' => $id
                      ])
            ]);*/
            /*$event->title = $jenis_spt->sebutan;
            $event->start = $updated_spt->tgl_mulai;
            $event->end = $updated_spt->tgl_akhir;
            $event->info = $info;
            $event->save();*/
        }
        return $updated_spt;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->hasPermissionTo('Delete SPT')){
            Spt::destroy($id);
            return 'SPT deleted!';
        }
    }

    public function getData($jenis_data){
        $user = auth()->user();
        if($user->hasRole('Auditor')){
            return $this->mySpt();
        }else{
            return $this->getDataSpt($jenis_data);
        }

    }

    public function getDataSpt($jenis_data)
    {
        $spt = Spt::select('*');
        switch($jenis_data){
            case 'penomoran':
                $spt = $spt->where('nomor',null);
                break;
            case 'arsip' :
                $spt = $spt->whereNotNull('nomor');
                break;
            case 'scan' :
                $spt = $spt->whereNotNull('file');
                break;
            default :
                $spt = $spt;
                break;
        }

        $user = auth()->user();
       /* $cols = Spt::orderBy('created_at', 'desc')->get();*/
        $cols = $spt->orderBy('created_at', 'desc')->get();
        $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('jenis_spt', function($col){
                    return $col->jenisSpt->nama_sebutan;
                })
                ->addColumn('tanggal_mulai', function($col){
                    return $col->tanggal_mulai;
                })
                ->addColumn('tanggal_akhir', function($col){
                    return $col->tanggal_akhir;
                })
                ->addColumn('periode', function($col){
                    return $col->periode;
                })
                ->addColumn('lama', function($col){
                    return $col->lama;
                })
                ->addColumn('nomor', function ($col){
                    return ($col->nomor !== null ) ? $col->nomor : 'SPT belum diregister';
                })
                ->addColumn('lokasi', function ($col){
                    return $col->lokasi_spt;
                })
                ->addColumn('ringkasan', function($col){
                    $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->tambahan, 2, 70) . '</small>' : '';
                    $lokasi = (!is_null($col->lokasi_id) ) ? '<small class="text-muted">di ' . $col->lokasi_spt . '</small>' : '';
                    return $col->jenisSpt->name . $tambahan . $lokasi;
                    /*$tambahan = (!is_null($col->tambahan) ) ? Common::cutText($col->tambahan, 2) : '';
                    $ringkasan = [
                        'jenis' => $col->jenisSpt->nama_sebutan,
                        'tambahan' => $tambahan];
                    return $ringkasan;*/

                })
                ->addColumn('action', function($col){

                    $return = "";
                    if( !is_null($col->nomor) ){
                        if(!is_null($col->file) || $col->file != ""){
                            $return .= '<a href="'.url('/storage/spt/'.$col->file).'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                        }else{
                            $return .= '<a href="#" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-danger btn-sm disabled" ><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                            if( auth()->user()->hasAnyRole(['TU Umum', 'Super Admin']) ){
                                $return .= '<a href="#" data-toggle="tooltip" title="Upload File Scan SPT" class="btn btn-outline-primary btn-sm" onclick="uploadSpt('.$col->id.')"><i class="fa fa-file-pdf"></i><span>Upload</span></a>';
                            }
                        }
                    }
                    if($col->nomor == null){
                        $return .= $this->buildControl('penomoran', $col->id);
                        $return .= $this->buildControl('cetakPdf',$col->id);
                        $return .= $this->buildControl('docx',$col->id);
                        $return .= $this->buildControl('editForm',$col->id);
                        $return .= $this->buildControl('deleteData',$col->id);
                    }
                    return $return;
                })
                ->rawColumns(['ringkasan', 'action'])
                ->make(true);
        return $dt;
    }

    public function getArsipUmum()
    {
        $spt2 = SptUmum::where('nomor','!=','null');
        $spt = SptUmum::where('nomor',null);
        $cols = ($spt == true) ? $spt2->orderBy('id', 'desc')->get() : $spt->orderBy('id', 'desc')->get();
        // dd($cols);
        $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('jenis_spt', function($col){
                    return $col->jenis_spt_umum;
                })
                ->addColumn('periode', function($col){
                    $start = Carbon::parse($col->tgl_mulai)->formatLocalized('%d %B');
                    $end = Carbon::parse($col->tgl_akhir)->formatLocalized('%d %B %Y');
                    return $start . ' s.d ' . $end;
                })
                ->addColumn('lama', function($col){
                    return $col->lama;
                })
                ->addColumn('nomor', function ($col){
                    return ($col->nomor !== null ) ? $col->nomor : 'SPT belum diregister';
                })
               ->addColumn('ringkasan', function($col){
                    // $tambahan = (!is_null($col->info_untuk_umum) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->info_untuk_umum, 2, 70) . '</small>' : '';
                    $tambahan = (!is_null($col->info_untuk_umum) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->info_untuk_umum, 2, 70) . '</small>' : '';
                    $nama_spt = preg_replace("/SPT/","", $col->jenis_spt_umum);
                    return $nama_spt . $tambahan ;
                    // $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->tambahan, 2) . '</small>' : '';
                    // return $col->jenis_spt . $tambahan ;
                    /*$tambahan = (!is_null($col->tambahan) ) ? Common::cutText($col->tambahan, 2) : '';
                    $ringkasan = [
                        'jenis' => $col->jenis_spt,
                        'tambahan' => $tambahan];
                    return $ringkasan;*/

                })
                ->addColumn('action', function($col){
                    $return = "";
                    if( !is_null($col->nomor) && auth()->user()->hasAnyRole(['TU Umum', 'Super Admin'])){
                        if(!is_null($col->file) || $col->file != ""){
                            $return .= '<a href="'.url('/storage/spt/'.$col->file).'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                            // $return .= 'button download';
                        }else{
                            $return .= '<a href="#" data-toggle="tooltip" title="Download SPT" class="btn btn-outline-danger btn-sm disabled" ><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                            // $return .= 'button download disable karena blm upload';
                            $return .= '<a href="#" data-toggle="tooltip" title="Upload File Scan SPT" class="btn btn-outline-primary btn-sm" onclick="PopUpFunctionUploadScan('.$col->id.')"><i class="fa fa-file-pdf"></i><span>Upload</span></a>';
                            // $return .= 'button upload';
                            // if( auth()->user()->hasAnyRole(['TU Umum', 'Super Admin']) ){
                            // }
                        }
                    }
                    if($col->nomor == null){
                        $return .= $this->buildControl('penomoran', $col->id);
                        $return .= $this->buildControl('cetakPdf',$col->id);
                        $return .= $this->buildControl('editForm',$col->id);
                        $return .= $this->buildControl('deleteData',$col->id);
                    }
                    return $return;
                })
                ->escapeColumns([])
                ->make(true);
        return $dt;
    }

    public function buildControl($method,$id){
        //$id = id SPT
        $user = auth()->user();
        $control = '';
        if($user->hasPermissionTo('Edit SPT') && $method == 'editForm'){
            $control = '<a href="#" data="'.$id.'" onclick="editForm('.$id.')" data-toggle="tooltip" title="Edit SPT" class="btn btn-outline-primary btn-sm edit-spt"><i class="fa fa-edit"></i></a>';
        }
        if($user->hasPermissionTo('Delete SPT') && $method == 'deleteData'){
            $control = '<a href="javascript:void(0);" onclick="deleteData('. $id .')" data-toggle="tooltip" title="Hapus SPT" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }
        if($user->hasPermissionTo('Delete SPT') && $method == 'deleteDataSptUmum'){
            $control = '<a href="javascript:void(0);" onclick="deleteDataSptUmum('. $id .')" data-toggle="tooltip" title="Hapus SPT" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }
        if($user->hasAnyPermission(['Create SPT', 'Edit SPT', 'Delete SPT']) && $method == 'deleteAnggota'){
            $control = '<a href="javascript:void(0);" onclick="deleteAnggota('. $id .')" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }        
        if($user->hasPermissionTo('View SPT') && $method === 'cetakPdf'){
        $control = '<a href="'.route('spt_pdf',$id).'" data-toggle="tooltip" title="Cetak PDF" class="btn btn-outline-primary btn-sm" target="__blank"><i class="fa fa-file-pdf"></i></a>';
        }
        if($user->hasPermissionTo('View SPT') && $method === 'cetakPdfUmum'){
        $control = '<a href="'.route('spt_pdf_umum',$id).'" data-toggle="tooltip" title="Cetak PDF" class="btn btn-outline-primary btn-sm" target="__blank"><i class="fa fa-file-pdf"></i></a>';
        }
        if($user->hasPermissionTo('View SPT') && $method === 'viewAnggota'){
            $control = '<a href="javascript:void(0);" onclick="viewAnggota('. $id .')" data-toggle="tooltip" title="Anggota SPT" class="btn btn-outline-primary btn-sm"><i class="ni ni-single-02"></i></a>';
        }
        if($user->hasPermissionTo('Sign SPT') && $method === 'signOrReject'){
            $control = '<a href="#" onclick="showRejectFormModal('.$id.')" class="btn btn-outline-danger btn-sm">Tolak</a>
                    <a href="#" onclick="sign('.$id.')" class="btn btn-outline-success btn-sm">Setuju</a> ';
        }

        if ( $user->hasAnyRole(['TU Perencanaan', 'Super Admin','TU Umum']) && $method == 'penomoran') {
                    $control = '<a href="#" onclick="showFormModal('.$id.')" class="btn btn-outline-primary btn-sm" title="Teruskan"><i class="fa fa-share"></i></a>';
                    return $control;
        }
        if ( $user->hasAnyRole(['TU Umum', 'Super Admin']) && $method == 'showFormModalUmum') {            
            $control = '<a href="#" onclick="showFormModalUmum('.$id.')" class="btn btn-outline-primary btn-sm" title="Teruskan"><i class="fa fa-share"></i></a>';
            return $control;
        }
        if( $user->hasAnyRole(['TU Umum', 'Super Admin']) && $method == 'editSptUmum' ){
            $control = '<a href="#" data="'.$id.'" onclick="editSptUmum('.$id.')" data-toggle="tooltip" title="Edit SPT" class="btn btn-outline-primary btn-sm edit-spt"><i class="fa fa-edit"></i></a>';
        }
        if($user->hasAnyRole(['TU Umum', 'Super Admin']) && $method == 'deleteAnggotaUmum'){
            $control = '<a href="javascript:void(0);" onclick="deleteAnggotaUmum('. $id .')" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }
        if($user->hasAnyRole(['TU Perencanaan', 'Super Admin']) && $method == 'docx'){
            $control = '<a href="'.route('spt_docx',$id).'" class="btn btn-outline-primary btn-sm" title="Download word e-buddy"><i class="fas fa-file-word"></i></a>';
        }



        return $control;
    }

    public function sptPdf($id){
        $spt = Spt::findOrFail($id);
        $sort_detail = implode(",",$this->list_peran);
        $detail_spt = DetailSpt::where('spt_id','=',$id)->with(['spt','user'])
            ->orderByRaw(DB::raw("FIELD(peran,'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota')"))->get();
        $template_name = 'pdfsplit'; // default template name

        //untuk debug html saja (tanpa pdf)
        //return view('admin.laporan.spt.pdfsplit', compact('spt','detail_spt'));

        /*
        ** Template untuk jenis spt yang memiliki radio button contoh : kasus perceraian
        ** TODO : generate blade template dengan nama file dari opsi radio button
        ** Sementara karena penggunaannya hanya di kasus cerai, build blade manual
        */
        if( isset($spt->info['radio']) && $spt->info['radio'] !== null){
            $radio = $spt->info['radio'];
            $template_name = str_replace( ' ', '-', strtolower($spt->jenisSpt->radio[$radio]) );
        }
        //dd($template_name);

        //$pdf = new PDF::setOptions(['dpi' => 150, 'defaultFont' => 'arial','debugCss' => true]);
        $pdf = PDF::loadView('admin.laporan.spt.'.$template_name, compact('spt','detail_spt'))->setPaper([0,0,583.65354,877.03937],'portrait'); //setpaper = ukuran kertas custom sesuai dokumen word dari mbak ita
        return @$pdf->stream('SPT-'.$id.'.pdf',array('Attachment'=>1));
        //return $pdf->setWarnings(false)->save('spt-'.$id.'.pdf');
    }

    public function sptDocx($id){
        //https://alfinchandra4.medium.com/catatan-laravel-pass-dynamic-values-when-export-to-docx-using-phpword-32e2746b0bfa
        //dd(storage_path('spt\template-spt.docx'));
        $spt = Spt::findOrFail($id);
        $sort_detail = implode(",",$this->list_peran);
        $detail_spt = DetailSpt::where('spt_id','=',$id)->with(['spt','user'])
            ->orderByRaw(DB::raw("FIELD(peran,'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota')"))->get();
        $template_name = (File::exists(storage_path("spt/template-spt.docx"))) ? storage_path('spt\template-spt.docx') : 'tidak ada'; // default template name        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_name);
        $default_font = [
            'name'=>'arial',
            'size'=>12
        ];

        //setup variabel
        $dasar_spt = array_filter(explode("\n",strip_tags($spt->jenisSpt->dasar))); //explode by new line (ENTER)
        $lanjutan = ($spt->info_lanjutan !== 'undefined') ? 'lanjutan' : '';
        $lokasi = ($spt->jenisSpt->input_lokasi == true) ? 'di '.$spt->lokasi_spt.' Kabupaten Sidoarjo.' : '';
        $tambahan = ($spt->jenisSpt->inputTambahan == true) ? $spt->tambahan : '';

        //setup dasar spt perceraian
        preg_match_all('/(?P<izin>(?<=izin:)(.*))/', $spt->jenisSpt->dasar, $izin);
        preg_match_all('/(?P<ket>(?<=keterangan:)(.*))/', $spt->jenisSpt->dasar, $ket);
        if( isset(($izin['izin'])) && count($izin['izin'])>0){
            $dasar_spt = $izin['izin'][0];            
        }
        if( isset(($ket['ket'])) && count($ket['ket'])>0){
            $dasar_spt = $ket['ket'][0];            
        }
        $izin_cerai = ( isset(($matches['izin'])) && count($izin['izin'])>0 ) ? 'pemeriksaan guna menyelesaikan Permohonan Izin melakukan  Perceraian' : '';
        $keterangan_cerai = ( isset(($matches['ket'])) && count($ket['ket'])>0 ) ? 'pemeriksaan atas terjadinya' : '';

        //setup block dasar SPT
        $tabel_dasar = new Table();
        $n = 1;
        if( is_array($dasar_spt) && count($dasar_spt)>1){                     
            foreach($dasar_spt as $i=>$dasar2){
                $tabel_dasar->addRow();
                if($i==0){
                    $tabel_dasar->addCell(900)->addText('Dasar', $default_font);
                    $tabel_dasar->addCell(100)->addText(':', $default_font);
                }else{
                    $tabel_dasar->addCell(900)->addText('', $default_font);
                    $tabel_dasar->addCell(100)->addText('', $default_font);
                }
                $tabel_dasar->addCell(300)->addText(++$i, $default_font); //nomer
                $tabel_dasar->addCell(7700)->addText($dasar2, $default_font);
            }
        }else{
           $tabel_dasar->addRow();
           $tabel_dasar->addCell(900)->addText('Dasar', $default_font);
           $tabel_dasar->addCell(100)->addText(':', $default_font);
           $tabel_dasar->addCell(8000)->addText($dasar_spt, $default_font);
        }
        $templateProcessor->setComplexBlock('dasar', $tabel_dasar);

        //setup block anggota
        $tabel_anggota = new Table();        
        foreach($detail_spt as $i=>$detail){
            $tabel_anggota->addRow();
            if($i==0){
                $tabel_anggota->addCell(1000)->addText('Kepada', $default_font);
            }else{
                $tabel_anggota->addCell(1000)->addText('', $default_font);
            }
            $tabel_anggota->addCell(300)->addText(++$i, $default_font);
            $tabel_anggota->addCell(4000)->addText($detail->user->full_name_gelar, $default_font);
            $tabel_anggota->addCell(3700)->addText($detail->peran, $default_font);
        }
        $templateProcessor->setComplexBlock('anggota', $tabel_anggota);

        $templateProcessor->setValue('izin_cerai', $izin_cerai);
        $templateProcessor->setValue('keterangan_cerai', $keterangan_cerai);
        
        $templateProcessor->setValue('lanjutan', $lanjutan);
        $templateProcessor->setValue('nama_jenis_spt',$spt->jenisSpt->name);
        $templateProcessor->setValue('lokasi',$lokasi);
        $templateProcessor->setValue('tambahan',$tambahan);
        $templateProcessor->setValue('lama_hari',$spt->lama_hari);
        $templateProcessor->setValue('periode',$spt->periode);               
       
        //setup download
        $file = 'SPT-'.$id.'-'.time().'.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.msword');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $templateProcessor->saveAs('php://output'); //direct download
       // $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($templateProcessor, 'Word2007');
        //ob_clean();
        //$xmlWriter->save("php://output");
        exit;
    }

    public function sptPdfUmum($id){
        $spt = SptUmum::findOrFail($id);
        // $sort_detail = implode(",",$this->list_peran);
        $detail_spt = DetailSpt::where('spt_id','=',$id)->with(['spt','user'])->get();
        //     ->orderByRaw(DB::raw("FIELD(peran,'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim')"))->get();
        // $template_name = 'pdfsplit'; // default template name

        //untuk debug html saja (tanpa pdf)
        // return view('admin.laporan.spt_umum.sptUmum', compact('spt','detail_spt'));
        // return view('admin.laporan.spt_umum.sptUmum', compact('spt','detail_spt'));

        // if( isset($spt->info['radio']) && $spt->info['radio'] !== null){
        //     $radio = $spt->info['radio'];
            // $template_name = str_replace( ' ', '-', strtolower($spt->jenis_spt_umum) );
        // }
        //dd($template_name);

        //$pdf = new PDF::setOptions(['dpi' => 150, 'defaultFont' => 'arial','debugCss' => true]);
        // $pdf = PDF::loadView('admin.laporan.spt.'.$template_name, compact('spt','detail_spt'))->setPaper([0,0,583.65354,877.03937],'portrait'); //setpaper = ukuran kertas custom sesuai dokumen word dari mbak ita
        $pdf = PDF::loadView('admin.laporan.spt_umum.PdfsptUmum', compact('spt','detail_spt'))/*->setPaper([0,0,583.65354,877.03937],'portrait')*/; //setpaper = ukuran kertas custom sesuai dokumen word dari mbak ita
        return @$pdf->stream('SPT-'.$id.'.pdf',array('Attachment'=>1));
        //return $pdf->setWarnings(false)->save('spt-'.$id.'.pdf');
    }

    public function getAnggota(Request $request)
    {
        //setup tabel anggota spt, jika ada data di detail_spt maka mengambil data anggota dari tabel, jika tidak, cek apakah ada data session, selebihnya set empty data untuk menghindari pesan error

        //cek data di tabel

        //$cek_data = ( ) ) ? 0 : DetailSpt::where('spt_id', $id)->count();

        if( !is_null($request->id_spt) ){

            $id = $request->id_spt;

            $cols = DetailSpt::where('spt_id','=',$id)->with(['user','spt'])
            ->orderByRaw(DB::raw("FIELD(peran,'Penanggung Jawab', 'Pembantu Penanggung jawab', 'Supervisor','Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim')"))->get();
            $dt = Datatables::of($cols)
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
                    return $this->buildControl('deleteAnggota',$col->id); 
                })->make(true);
                //return $dt;

        }else{
            //cek apakah ada session anggota
            if(Session::has('anggota')){
                $data = Session::get('anggota');
                //setup data anggota
                $dt = Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('nama_anggota', function($col){
                        $user = User::findOrFail($col['user_id']);
                        return $user->full_name_gelar;
                    })
                    ->addColumn('action', function($col){
                        //hapus session by user_id
                        return '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
                    })
                    ->make(true);

            }else{
                //eksekusi empty data karena tidak ditemukan data pada tabel ataupun session
                $data = [0=>['DT_RowIndex'=> '', 'nama_anggota'=>'', 'peran'=>'', 'action' => '']];
                $dt = Datatables::of($data)->toJson();
            }
        }
        return $dt;
    }

    public function getAnggotaUmum($id=null)
    {
        $cek_data = ( $id == 0 ) ? 0 : DetailSpt::where('spt_id', $id)->count();

        if($cek_data > 0){

            $cols = DetailSpt::where('spt_id','=',$id)->with(['user','spt'])->get();
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
            if(Session::has('anggota_umum')){
                $data = Session::get('anggota_umum');
                //setup data anggota
                $dtt = Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('nama_anggota', function($col){
                        $user = User::findOrFail($col['user_id']);
                        return $user->full_name_gelar;
                    })
                    ->addColumn('action', function($col){
                        //hapus session by user_id
                        return '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset_anggota('.$col['user_id'].')">Hapus</a>';
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

    //penomoran spt datatable
    public function getPenomoranSpt(){
        $cols = Spt::where('nomor',null)->orderBy('tgl_mulai');
        $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('jenis_spt', function($col){
                    return $col->jenisSpt->nama_sebutan;
                })
                ->addColumn('tanggal_mulai', function($col){
                    return $col->tanggal_mulai;
                })
                ->addColumn('tanggal_akhir', function($col){
                    return $col->tanggal_akhir;
                })
                ->addColumn('lama', function($col){
                    //$common = new Common;
                    //return $col->lama_spt . ' (' .$common->terbilang($col->lama_spt) .') hari'; //--> if using terbilang
                    return $col->lama;
                })
                ->addColumn('lokasi', function ($col){
                    return $col->lokasi_spt;
                })
                ->addColumn('action', function($col){
                    if (auth()->user()->hasRole('TU Perencanaan') == null) {
                    $control = '<a href="#" onclick="showFormModalUmum('.$col->id.')" class="btn btn-sm">Penomoran</a>';
                    return $control;
                    }else{
                        // liaht spt pada rencanaan
                        $lihatSpt = '<a href="'.route('spt_pdf',$col).'" class="btn btn-sm">Lihat SPT</a>';
                        return $lihatSpt;
                    }
                    /*$control = '<a href="#" onclick="showFormModal('.$col->id.')" class="btn btn-sm">Penomoran</a>';
                    return $control;*/
                })
                ->make(true);

        return $dt;
    }

    public function getPenomoranSptUmum(){
        $cols = SptUmum::where('nomor',null)->orderBy('id', 'DESC')->get();
        $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('jenis_spt', function($col){
                    return $col->jenis_spt_umum;
                })

                ->addColumn('periode', function($col){
                    $start = Carbon::parse($col->tgl_mulai)->formatLocalized('%d %B');
                    $end = Carbon::parse($col->tgl_akhir)->formatLocalized('%d %B %Y');
                    return $start . ' s.d ' . $end;
                })
                ->addColumn('lama', function($col){
                    //$common = new Common;
                    //return $col->lama_spt . ' (' .$common->terbilang($col->lama_spt) .') hari'; //--> if using terbilang
                    return $col->lama;
                })
                ->addColumn('lokasi', function ($col){
                    return $col->lokasi_spt;
                })
                ->addColumn('ringkasan', function($col){
                    // $tambahan = (!is_null($col->info_untuk_umum) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->info_untuk_umum, 2, 70) . '</small>' : '';
                    $tambahan = (!is_null($col->info_untuk_umum) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->info_untuk_umum, 2, 90) . '</small>' : '';
                    $nama_spt = preg_replace("/SPT/","", $col->jenis_spt_umum);
                    return $nama_spt . $tambahan ;
                    // $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->tambahan, 2) . '</small>' : '';
                    // return $col->jenis_spt . $tambahan ;
                    /*$tambahan = (!is_null($col->tambahan) ) ? Common::cutText($col->tambahan, 2) : '';
                    $ringkasan = [
                        'jenis' => $col->jenis_spt,
                        'tambahan' => $tambahan];
                    return $ringkasan;*/

                })
                ->addColumn('action', function($col){

                    $return = "";
                    if( !is_null($col->nomor) ){
                        if(!is_null($col->file) || $col->file != ""){
                            $return .= '<a href="'.url('/storage/spt/'.$col->file).'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                        }else{
                            $return .= '<a href="#" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-danger btn-sm disabled" ><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                            if( auth()->user()->hasAnyRole(['TU Umum', 'Super Admin']) ){
                                $return .= '<a href="#" data-toggle="tooltip" title="Upload File Scan SPT" class="btn btn-outline-primary btn-sm" onclick="uploadSpt('.$col->id.')"><i class="fa fa-file-pdf"></i><span>Upload</span></a>';
                            }
                        }
                    }
                    if($col->nomor == null){

                        $return .= $this->buildControl('showFormModalUmum', $col->id); //upload + update nomor spt umum
                        $return .= $this->buildControl('cetakPdfUmum',$col->id); //cetak pdf spt Umum
                        $return .= $this->buildControl('editSptUmum',$col->id); //belum bisa

                        $return .= $this->buildControl('deleteDataSptUmum',$col->id);
                    }
                    return $return;
                })
                ->rawColumns(['ringkasan', 'action'])
                ->make(true);

        return $dt;
    }

    public function delelteSptUmum($id)
    {
        if(auth()->user()->hasPermissionTo('Delete SPT')){
            $spt = SptUmum::findOrFail($id);
            $delete = DetailSpt::where('spt_id',$id)->where('jenis_laporan',$spt->jenis_spt_umum)->delete();
            // dd($delete);
            SptUmum::destroy($id);
            return 'SPT deleted!';
        }
    }
    
    public function ajaxUpload(Request $request){        
        $filename = ($request['formData']) ? 'SPT-' . $request['id'] . '-' . $request['formData']->getClientOriginalName() : null ;
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/spt")) {
                File::makeDirectory(public_path()."/storage/spt", 0755, true);
            }
            $request['formData']->move(public_path()."/storage/spt" , $filename);
            $parser = new \Smalot\PdfParser\Parser();
            $pdf  = $parser->parseFile(storage_path("app/public/spt/$filename"));
            $text = $pdf->getText();
            preg_match('/\/(.*?)\//', $text, $match);            
            $nomor = ( isset($match[1]) && is_numeric($match[1]) ) ? $match[1] : '';
            return $nomor;
        }
    }

    public function updateNomorSpt(Request $request){
        $spt_umum = $request->jenis_spt_umum;
        switch ($request->jenis_spt_umum) {
          case "SPT Pengembangan Profesi":
            $spt_umum = 'umum';
            break;
          case "SPT Penunjang":
            $spt_umum = 'umum';
            break;
          case "SPT Diklat":
            $spt = 'umum';
            break;
          default:
            $spt_umum = $spt_umum;
        }
        //$umum = (in_array($request->jenis_spt_umum, ['SPT Pengembangan Profesi', 'SPT Penunjang', 'SPT Diklat'])) ? 'umum' : null;
        // dd($spt_umum == null);
        $id = $request->spt_id;
        $id_umum = $request->spt_id_umum;

        if($spt_umum == null){

            $spt = Spt::findOrFail($id);
            $filename = ($request->file_spt) ? 'SPT-' . $id . '-' . $request->file_spt->getClientOriginalName() : null ;
            //dd(storage_path()."/spt");
            /*if($filename !== null ){
                if (! File::exists(public_path()."/storage/spt")) {
                    File::makeDirectory(public_path()."/storage/spt", 0755, true);
                }
                $request->file_spt->move(public_path()."/storage/spt" , $filename);
            }*/
            $spt->file = ($filename !== null ) ? $filename : null;
            $spt->nomor = $request->nomor;
            $spt->tgl_register = date('Y-m-d H:i:s',strtotime($request->tgl_register));

            //setup info_spt untuk tabel dupak
            $info_spt = json_encode([
                 'spt_id' => $spt->id,
                 'nomor_spt' => $spt->nomor,
                 'jenis_spt' => $spt->jenisSpt->name,
                 'unsur_dupak' => $spt->jenisSpt->kategori,
                 'tgl_mulai'=> $spt->tgl_mulai,
                 'tgl_akhir' => $spt->tgl_akhir,
                 'tgl_register' => $spt->tgl_register
            ]);

        }else{

            $sptumum = SptUmum::findOrFail($id_umum);
            $filename = ($request->file_spt_umum) ? 'SPT-UMUM-' . $id_umum . '-' . $request->file_spt_umum->getClientOriginalName() : null ;
            //dd(storage_path()."/spt");
            if($filename !== null ){
                if (! File::exists(public_path()."/storage/spt")) {
                    File::makeDirectory(public_path()."/storage/spt", 0755, true);
                }
                $request->file_spt_umum->move(public_path()."/storage/spt" , $filename);
            }
            //$spt->file = ($filename !== null ) ? url('/storage/spt-umum/'.$filename) : null;
            $sptumum->file = ($filename !== null ) ? $filename : null;
            //$spt->nomor = $request->nomor;
            $parser = new \Smalot\PdfParser\Parser();
            $pdf    = $parser->parseFile(storage_path("app/public/spt/$filename"));     
            $text = $pdf->getText();
            preg_match('/\/(.*?)\//', $text, $match);
            $nomor = $match[1];
            $tgl_register = date('Y-m-d H:i:s',strtotime($request->tgl_register_umum));

            $info_spt = null;
            $sptumum->update(['nomor'=>$nomor,'tgl_register'=>$tgl_register]);
        }

        if($spt_umum == null && $spt->save()) {

           //ambil data detail spt terkait sesuai id spt
           $detail_spt = DetailSpt::where('spt_id', $id)->with('spt')->get();

           //update detail kuota dan dupak di detail_spt
           $detail_kuota = [];
           for($i=0;$i<count($detail_spt);$i++){
            $detail_kuota[] = $this->detailKuota( $detail_spt[$i]['user_id'],$spt->tgl_mulai,$spt->tgl_akhir); // result array lama jam per user per spt per tanggal
           }
           //end update detail kuota

           foreach($detail_spt as $i=>$detail){

            //perhitungan kumulatif lama_jam per detail_spt (sesuai user_id dan data detail kuota per tanggal kalender spt)
            $lama_jam = array_sum($detail_kuota[$i][$detail->user_id]);

            //perhitungan dupak berdasarkan lama_jam kuota kalender dan fungsi peran spt
            $dupak = $this->hitungDupak($detail->user_id,$detail->peran,$lama_jam);

            $jam_efektif = intval($lama_jam/6.5);
            //$jam_lembur = (($lama_jam % 6.5) == 1) ? 0 : $lama_jam % 6.5;
            $jam_lembur = fmod($lama_jam, 6.5);

            $info = [
                'lama_jam' => $lama_jam,
                'efektif' => $jam_efektif,
                'lembur' => $jam_lembur,
                'dupak' => $dupak['nilai'],
                'koefisien' => $dupak['koef']
            ];
            //$info['koefisien'] = $dupak['koef'];

            //update lama_jam dan nilai dupak pada detail_spt
            //DetailSpt::where('id', $detail->id)->update(['lama_jam' => $lama_jam, 'dupak'=>$dupak['nilai'], 'info_dupak'=>json_encode($info)]);
            DetailSpt::where('id', $detail->id)->update(['info_dupak'=>json_encode($info)]);

            //set array var $data untuk membuat data dupak di tabel dupak
            $data = [
                'user_id' => $detail->user_id,
                'dupak' => $detail->dupak,
                'unsur_dupak' => $spt->jenisSpt->kategori,
                'status' => 'baru',
                'info_spt' => $info_spt
            ];
            //Dupak::create($data);
           }
           //buat event terkait spt untuk penerapan di kalender
           $this->createEventSpt($spt);
           return $spt;
        }
        if($spt_umum !== null && isset($sptumum)){
            $detail_spt = DetailSpt::where('spt_id', $id_umum)->with('sptUmum')->get();
            $this->createEventSpt($sptumum, true);
            return $sptumum;
        }
        //return false;
    }

    //test retrieve nomor spt from pdf file
    public function updateNomorSptTest(Request $request){
        $id = $request->spt_id;
        $spt = Spt::findOrFail($id);
        $filename = ($request->file_spt) ? $request->file_spt->getClientOriginalName().time() : null ;
        //dd(storage_path()."/spt");
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/spt")) {
                File::makeDirectory(public_path()."/storage/spt", 0755, true);
            }
            $request->file_spt->move(public_path()."/storage/spt" , $filename);
        }
        $spt->file = ($filename !== null ) ? $filename : null;
        //$spt->nomor = $request->nomor;
        //$spt->tgl_register = date('Y-m-d H:i:s',strtotime($request->tgl_register));D:\app\inspektorat\storage\app\public\spt D:\app\inspektorat\storage\storage/app/public/spt/tgr.pdf
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile(storage_path("app/public/spt/$filename"));
 
        $text = $pdf->getText();

        preg_match('/\/(.*?)\//', $text, $match);
        $spt->nomor = $match[1];
        $spt->tgl_register = date('Y-m-d H:i:s',strtotime($request->tgl_register));

    }

    public function detailKuota($user_id, $tgl_mulai, $tgl_akhir){
        $available = Common::getAvailableDate($tgl_mulai,$tgl_akhir);//result : array tanggal (ie: [0=>21-03-1986, 1=>13-03-1986])

        //set var array lama_jam
        $lama_jam = [];
        foreach($available as $date){
            //panggil data tanggal atau buat jika belum ada.
            $kuota_kalender = DetailKuota::firstOrCreate(['tanggal'=>$date]);

            //cek data detail kuota berdasarkan tanggal di atas
            $detail_kuota = json_decode($kuota_kalender->detail_kuota, true);

            //jika data detail_kuota sudah terisi atau not null
            if(!is_null($detail_kuota)){

                 //cocokkan user id di tanggal detail_kuota, dan update sesuai user_id nya
                 $users = array_column($detail_kuota,'user_id');
                 $key = array_search($user_id, $users);
                if(False !== $key){
                    $detail_kuota[$key]['jumlah_spt']= ++$detail_kuota[$key]['jumlah_spt'];
                }else{
                    //jika data bersifat baru, push data baru ke data yang sudah tersedia
                    array_push($detail_kuota, [
                        'user_id'=>$user_id,
                        'jumlah_spt'=>1
                    ]);
                }
            }
            //namun jika data detail_kuota masih belum terisi atau null, maka buat update data tanggal dengan mengisikan data detail_kuota sesuai user_id yang terkirim
            else{
                $detail_kuota = [];
                $data_baru['user_id'] = $user_id;
                $data_baru['jumlah_spt'] = 1;
                array_push($detail_kuota, $data_baru);
            }

            //update data detail_kuota berdasar data diatas
            $data = tap(DetailKuota::where('tanggal', $date))->update(['detail_kuota'=>json_encode($detail_kuota)])->first();

            //ambil lama jam sebagai nilai return untuk proses penghitungan dupak di penomoran spt
            $users = array_column($detail_kuota,'user_id');
            $key = array_search($user_id, $users);
            $lama_jam[$user_id][] = $this->jamDetailKuota($detail_kuota[$key]['jumlah_spt']);
        }
        return $lama_jam;
    }


    //func createEventSpt use var $spt berupa stdClass object
    public function createEventSpt($spt,$spt_umum = false){
        $user = auth()->user();
        //user id pembuat spt
        $info['user_id'] = $user->id;
        $info['type'] = 'spt';
        $info['jenis'] = ($spt_umum == false) ? $spt->jenisSpt->kategori : 'umum';
        $info['spt_id'] = $spt->id;
        $title = ($spt_umum == false) ? $spt->jenisSpt->sebutan : $spt->jenis_spt_umum ;
        $insertArr = [
           'title' => $title,
           'start' => $spt->tgl_mulai,
           'end' => $spt->tgl_akhir,
           'info' => $info
        ];
        $event = Event::create($insertArr);
    }

    public function jamDetailKuota($jumlah_spt){
        switch($jumlah_spt){
            case 1:
                $lama_jam = 6.5;
                break;
            case 2:
                $lama_jam = 1;
                break;
            default:
                $lama_jam = 0;
        }
        return $lama_jam;
    }


    /*public function detailKuota($user_id, $tgl_mulai, $tgl_akhir){
        $available = Common::getAvailableDate($tgl_mulai,$tgl_akhir);//result : array tanggal (ie: [0=>21-03-1986, 1=>13-03-1986])

        foreach($available as $date){
            $kuota_kalender = DetailKuota::where('tanggal',$date)->first();
            if($kuota_kalender){
                //data tanggal di kuota kalender sudah ada, selanjutnya cek ketersediaan user_id di detail kuota, jika
                $detail_kuota = json_decode($kuota_kalender->detail_kuota, true); //array
                $data_kuota = [];
                for($i=0;$i<count($detail_kuota);$i++){
                    if($detail_kuota[$i]['user_id'] == $user_id){
                        $detail_kuota[$i]['jumlah_spt']= ++$detail_kuota[$i]['jumlah_spt'];
                    }
                }
                $kuota_detail = DetailKuota::where('tanggal', $date)->update(['detail_kuota'=>json_encode($detail_kuota)]);
                //return $detail_kuota;
            }else{
                $data_detail = [];
                $data['user_id'] = $user_id;
                $data['jumlah_spt'] = 1;
                array_push($data_detail, $data);
                $kuota_detail = DetailKuota::create(['tanggal'=>$date, 'detail_kuota'=>json_encode($data_detail)]);
                //return $data;
            }
        }
    }*/

    public function uploadScanSpt(Request $request){
        //metode sama seperti updateNomorSpt, namun hanya untuk upload file spt saja.

        $id = $request->spt_id;
        $spt = Spt::findOrFail($id);

        $filename = ($request->file_spt) ? 'SPT-' . $id . '-' . $request->file_spt->getClientOriginalName() : null ;
        //if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/spt")) {
                File::makeDirectory(public_path()."/storage/spt", 0755, true);
            }
            $request->file_spt->move(public_path()."/storage/spt" , $filename);
        }
        //$spt->file = ($filename !== null ) ? url('/storage/spt/'.$filename) : null;
        $spt->file = ($filename !== null ) ? $filename : null;
        $spt->save();
        return 'Updated';
    }

    public function uploadScanSptumum(Request $request)
    {
        $id = $request->spt_id;
        $spt = SptUmum::findOrFail($id);
        // dd($spt);
        // die();

        $filename = ($request->scan_file_spt_umum) ? 'SPT-'. $spt->jenis_spt_umum .'-'. $id . '-' . $request->scan_file_spt_umum->getClientOriginalName() : null ;
        //if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/spt")) {
                File::makeDirectory(public_path()."/storage/spt", 0755, true);
            }
            $request->scan_file_spt_umum->move(public_path()."/storage/spt" , $filename);
        }
        $spt->file = ($filename !== null ) ? $filename : null;
        $spt->save();
        return 'Updated';
    }

    //hapus anggota spt
    public function deleteAnggota($detail_id){
        if(auth()->user()->hasPermissionTo('Delete SPT')){
            DetailSpt::destroy($detail_id);
            return 'Anggota deleted!';
        }
    }

    // hapus anggota spt umum
    public function deleteAnggotaUmum($detail_id){
        if(auth()->user()->hasPermissionTo('Delete SPT')){
            DetailSpt::destroy($detail_id);
            return 'Anggota Umum deleted!';
        }
    }

    //pemrosesan SPT oleh inspektur currently disabled, uncomment to enable
    /*public function getProcessingSpt(){
        $cols = Spt::where('approval_status','=','processing')->get();
        $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('jenis_spt', function($col){
                    return $col->jenisSpt->name;
                })
                ->addColumn('lama', function($col){
                    return $col->lama;
                })
                ->addColumn('action', function($col){
                    $control = $this->buildControl('signOrReject',$col->id);
                    $control .= $this->buildControl('cetakPdf',$col->id);
                    return $control;
                })
                ->make(true);

        return $dt;
    }*/

    /*public function signOrRejectSpt(Request $request){
        //sign or reject with memo
        $id = $request->spt_id;
        $spt = Spt::findOrFail($id);
        $spt->approval_status = $request->approval_status;
        $spt->notes = $request->notes;
        $spt->approval_by = auth()->user()->id;
        if($spt->save()) {
            DetailSpt::where('spt_id',$request->spt_id)->update(['status_dupak'=>'aktif']);
            return "SPT updated!";
        }else{
            return "Error update SPT!";
            }

    }*/
    public function hitungDupakKhusus($user_id,$peran,$lama_jam){
        //perhitungan AK untuk SPT berindikasi tindak pidana korupsi
    }

    public function hitungDupak($user_id,$peran,$lama_jam){
        $user = User::findOrFail($user_id,['jabatan']);
        $jabatan = $user->jabatan;
        //coba penyesuaian untuk jenis SPT kategori A (Sidak, Kasus, AKIP, Lakip, Monev)/ bukan audit khusus berindikasi tindak pidana korupsi
        switch($peran){
            case 'Pengendali Mutu' :
                if ('Auditor Utama' == $jabatan ) {
                    $dupak = [
                        'koef' => 0.04,
                        'nilai'=> 0.04 * $lama_jam
                    ];
                }
                elseif ('Auditor Madya' == $jabatan) {
                    $dupak = [
                        'koef' => 0.032,
                        'nilai'=> 0.032 * $lama_jam
                    ];
                }
                else {
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Pengendali Teknis' :
                if ('Auditor Utama' == $jabatan ) {
                    $dupak = [
                        'koef' => 0.03,
                        'nilai'=> 0.03 * $lama_jam
                    ];
                }
                elseif('Auditor Madya' == $jabatan) {
                    $dupak = [
                        'koef' => 0.032,
                        'nilai'=> 0.032 * $lama_jam
                    ];
                }
                elseif('Auditor Muda' == $jabatan) {
                    $dupak = [
                        'koef' => 0.024,
                        'nilai'=> 0.024 * $lama_jam
                    ];
                }
                else {
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Ketua Tim' :
                if('Auditor Madya' == $jabatan) {
                    $dupak = [
                        'koef' => 0.02,
                        'nilai'=> 0.02 * $lama_jam
                    ];
                }
                elseif('Auditor Muda' == $jabatan) {
                    $dupak = [
                        'koef' => 0.02,
                        'nilai'=> 0.02 * $lama_jam
                    ];
                }
                elseif('Auditor Pertama' == $jabatan) {
                    $dupak = [
                        'koef' => 0.016,
                        'nilai'=> 0.016 * $lama_jam
                    ];
                }
                else {
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Anggota' :
                if('Auditor Madya' == $jabatan) {
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Muda' == $jabatan) {
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Pertama' == $jabatan) {
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Penyelia'== $jabatan){
                    $dupak = [
                        'koef' => 0.02,
                        'nilai'=> 0.02 * $lama_jam
                    ];
                }
                elseif('Auditor Pelaksana Lanjutan' == $jabatan) {
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Pelaksana' == $jabatan) {
                    $dupak = [
                        'koef' => 0.004,
                        'nilai'=> 0.004 * $lama_jam
                    ];
                }
                else {
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            default:
                $dupak = [
                    'koef' => 0,
                    'nilai'=> 0
                ];
        }
        return $dupak;

    }

    /*public function mySpt(){
        $user_id = auth()->user()->id;
        $cols = DB::table('spt')
                ->join('detail_spt','spt.id','=','detail_spt.spt_id')
                ->join('jenis_spt','jenis_spt.id','=','spt.jenis_spt_id')
                ->where('detail_spt.user_id','=',$user_id)
                ->whereNotNull('spt.nomor')
                ->select('jenis_spt.name as jenis_spt','spt.*','detail_spt.id as id_detail','detail_spt.peran as peran','detail_spt.lama as lama_detail','detail_spt.dupak', 'detail_spt.status as status_detail','detail_spt.spt_id')
                ->get();
         $dt = Datatables::of($cols)
                ->addIndexColumn()
                ->addColumn('lama_detail', function($col){
                    return $col->lama_detail * 6.5;
                })
                ->addColumn('action', function($col){
                    $control = $this->buildControl('cetakPdf',$col->spt_id);
                    $get_id_detail = DetailSpt::where('id',$col->id_detail)->first(); //get by id detail
                    if($get_id_detail != false){
                        $control .= $this->buildControl('buatLaporan',$get_id_detail); //perlu diperbaiki yg dikirm id detail_spt
                        $control .= $this->buildControl('pemeriksaan',$col->spt_id);

                        $get_data_peran_anggota = DetailSpt::where('spt_id',$col->id)->get();
                        foreach ($get_data_peran_anggota as $peran_anggota) {
                            $peran_anggota == 'Anggota Tim';
                            $isi_laporan = $peran_anggota->isi_laporan_pemeriksaan;
                            $var_data_peran_anggota = DetailSpt::where('spt_id',$col->id)->where('peran', '=', $peran_anggota)->get();
                            // dd($var_data_peran_anggota == true && $isi_laporan != null);
                            if ($var_data_peran_anggota == true && $isi_laporan != null) {
                                $control .= $this->buildControl('cetak_Nhp',$col->spt_id);
                            }
                        }
                    }else{
                        return 'no Action';
                    }
                    // $control .= $this->buildControl('pemeriksaan',$col->id_detail); //obat
                    return $control;
                })
                ->make(true);

        return $dt;
    }*/
    public function mySpt(){
        $user_id = auth()->user()->id;
        $cols = DB::table('spt')
                ->join('detail_spt','spt.id','=','detail_spt.spt_id')
                ->join('jenis_spt','jenis_spt.id','=','spt.jenis_spt_id')
                ->where('detail_spt.user_id','=',$user_id)
                ->whereNotNull('spt.nomor')
                ->select('jenis_spt.sebutan as jenis_spt','spt.*','detail_spt.id as id_detail','detail_spt.lama as lama_detail', 'detail_spt.status as status_detail','detail_spt.spt_id','detail_spt.status','detail_spt.info_dupak as info_dupak','lokasi_id')
                ->get();
         $dt = Datatables::of($cols)
                ->addIndexColumn()
                /*->addColumn('lokasi', function($col){ //hanya bisa untuk 1 lokasi tidak bisa untuk banyak lokasi.
                    $id_lokasi = json_decode($col->lokasi_id, true);
                    $lokasi = Lokasi::where('id',$id_lokasi)->get();
                    // dd($lokasi[0]->nama_lokasi);
                    return $lokasi[0]->nama_lokasi;
                })*/
                ->addColumn('ringkasan', function($col){
                    $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> ' . Common::cutText($col->tambahan, 2) . '</small>' : '';
                    return $col->jenis_spt . $tambahan ;
                    /*$tambahan = (!is_null($col->tambahan) ) ? Common::cutText($col->tambahan, 2) : '';
                    $ringkasan = [
                        'jenis' => $col->jenis_spt,
                        'tambahan' => $tambahan];
                    return $ringkasan;*/

                })
                ->addColumn('dupak', function($col){
                    if ($col->info_dupak) {
                        # code...
                        $info = json_decode($col->info_dupak);
                        return ( null !== $info->dupak ) ? $info->dupak : 0;
                    }
                    return;
                })
                // colum status
                ->addColumn('status', function($col){
                    $cekAnggota = DetailSpt::select('status')->where('spt_id',$col->spt_id)->where('peran', 'Anggota Tim');
                    // $cekStatus = DetailSpt::where('spt_id',$col->spt_id)->get();
                    foreach ($cekAnggota->get() as $status) {
                    // dd($status->status['PengendaliTeknis']);
                        if($status->status == null){
                            return 'Anggota belum menginputkan KKA';
                        }
                        if ($status->status['KetuaTim'] == null && $status->status['PengendaliTeknis'] == null) {
                            return 'Menunggu diunggah Ketua Tim';
                        }
                        if ($status->status['KetuaTim'] != null && $status->status['PengendaliTeknis'] == null) {
                            return 'Menunggu Persetujuan Pengendali Teknis';
                        }
                        if($status->status['PengendaliTeknis'] != null && $status->status['PengendaliMutu'] == null){
                            return 'Menunggu Persetujuan Pengendali Mutu';
                        }
                        if($status->status['PengendaliMutu'] != null && $status->status['PenanggungJawab'] == null){
                            return 'Menunggu Persetujuan Penanggung Jawab';
                        }
                        if($status->status['PengendaliMutu'] != null && $status->status['PenanggungJawab'] != null){
                            return 'Telah Disetujui Penanggung Jawab';
                        }
                    }
                })
                ->addColumn('periode', function($col){
                    $start = Carbon::parse($col->tgl_mulai)->formatLocalized('%d %B');
                    $end = Carbon::parse($col->tgl_akhir)->formatLocalized('%d %B %Y');
                    return $start . ' s.d ' . $end;
                })
                // colum info ketua, dalnis, daltu
                ->addColumn('ketuaTim', function($col){
                    $cekAnggota = DetailSpt::select('status')->where('spt_id',$col->spt_id)->where('peran', 'Anggota Tim');
                    $cekStatus = DetailSpt::where('spt_id',$col->spt_id)->where('user_id',auth()->user()->id)->get();
                    // dd($cekStatus);
                    foreach ($cekAnggota->get() as $status) {
                        if ($status->status['KetuaTim'] != null) {
                            return 'Mengunggah';
                        }else{
                            return 'belum mengunggah';
                        }
                    }
                })
                ->addColumn('pengendaliMutu', function($col){
                    $cekAnggota = DetailSpt::select('status')->where('spt_id',$col->spt_id)->where('peran', 'Anggota Tim');
                    $cekStatus = DetailSpt::where('spt_id',$col->spt_id)->where('user_id',auth()->user()->id)->get();
                    foreach ($cekAnggota->get() as $status) {
                        if ($status->status['PengendaliMutu'] != null) {
                            return 'Menyetujui';
                        }else{
                            return 'belum menyetujui';
                        }
                    }
                })
                ->addColumn('pengendaliTeknis', function($col){
                    $cekAnggota = DetailSpt::select('status')->where('spt_id',$col->spt_id)->where('peran', 'Anggota Tim');
                    $cekStatus = DetailSpt::where('spt_id',$col->spt_id)->where('user_id',auth()->user()->id)->get();
                    foreach ($cekAnggota->get() as $status) {
                        if ($status->status['PengendaliTeknis'] != null) {
                            return 'Menyetujui';
                        }else{
                            return 'belum menyetujui';
                        }
                    }
                })
                ->addColumn('lama_detail', function($col){
                    return $col->lama_detail * 6.5;
                })
                ->addColumn('action', function($col){
                    //perubahan ke download file spt (sudah ditandatangani) dari cetak pdf
                            $control = '<a href="'.$col->file.'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                    return $control;
                })
                ->escapeColumns([])
                ->make(true);
        return $dt;
    }

    public function InputTemuan($id)
    {
        $userid = auth()->user()->id;
        //berfungsi mengecek tb detail spt kolom file laporan kosong atau tidak
        $cek_radiobutt = DetailSpt::findOrFail($id);
        if($cek_radiobutt->file_laporan == null){
            $cek_radiobutts = 'disabledleforfile';
        }

        $id_lokasi_in_spt = Spt::where('id',$cek_radiobutt->spt_id)->get();
        $get_lokasi = Lokasi::where('id',$id_lokasi_in_spt[0]->lokasi_id)->get();

        //$refrensi = Refrensi_kka::where('refrensi_lokasi',$get_lokasi[0]->jenis_lokasi)->get();
        $kode = KodeTemuan::select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        $spt = DetailSpt::where('id',$id)->get();
        return view('admin.spt.auditor',['spt'=>$spt,'cek_radiobutts'=>$cek_radiobutts,'kode'=>$kode]);
    }



    public function storeSessionAnggota(Request $request){

        $uid = $request->user_id;
        $tgl_mulai = date($request->tgl_mulai);
        $tgl_akhir = date($request->tgl_akhir);

        if(Session::has('anggota')){
            //'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim'
            $listAnggota = Session::get('anggota');

            $anggota_uid = [];
            foreach( $listAnggota as $a){
                array_push($anggota_uid, $a['user_id']);
            }

            //SPT bisa input double anggota, dikommen
            /*if(in_array($uid,$anggota_uid)){
                return "User sudah ada dalam list anggota";
            }else{
                $session = Session::push('anggota', [
                    'user_id'    => $request->user_id,
                    'peran'   => $request->peran
                ]);
                return "Session anggota updated";
            }*/

            $session = Session::push('anggota', [
                    'user_id'    => $request->user_id,
                    'peran'   => $request->peran
                ]);
            return "Session anggota updated";

        }else{
            $session = Session::push('anggota', [
                'user_id'    => $request->user_id,
                'peran'   => $request->peran
            ]);
            return "Session anggota created";
        }

    }

    public function storeSessionAnggotaUmum(Request $request)
    {
        // dd($request);
        // die();

        $uid = $request->user_id;
        $tgl_mulai = date($request->tgl_mulai);
        $tgl_akhir = date($request->tgl_akhir);
        // $lama_jam = Common::cleanInput($request->lama_jam);
        // $dupak_anggota = Common::cleanInput($request->dupak_anggota);

        if(Session::has('anggota_umum')){
            //'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim'
            $listAnggota = Session::get('anggota_umum');

            $anggota_uid = [];
            foreach( $listAnggota as $a){
                array_push($anggota_uid, $a['user_id']);
            }

            if(in_array($uid,$anggota_uid)){
                return "User sudah ada dalam list anggota";
            }else{
                $session = Session::push('anggota_umum', [
                    'user_id'    => $request->user_id,
                    // 'peran'   => 'Pegawai'
                    'lama' => $request->lama_jam,
                    'dupak' => $request->dupak_anggota
                ]);
                return "Session anggota updated";
            }

        }else{
            $session = Session::push('anggota_umum', [
                'user_id'    => $request->user_id,
                // 'peran'   => 'Pegawai'
                'lama' => $request->lama_jam,
                'dupak' => $request->dupak_anggota
            ]);
            return "Session anggota created";
        }
    }

    public function getSessionAnggota(){
        //$data = [0=>['nama_anggota'=>'No data','peran'=>'No data','action'=>'No data']];
        $data = [0=>['DT_RowIndex'=> '', 'nama_anggota'=>'', 'peran'=>'', 'action' => '']];
        if(Session::has('anggota')){
            $data = Session::get('anggota');
            $list = usort($data, function($a, $b){
                if($a['peran'] == 'Penanggungjawab'){
                    return 0;
                }elseif($a['peran'] == 'Pembantu Penanggungjawab' ){
                    return 1;
                }elseif ($a['peran'] == 'Pengendali Mutu' ) {
                    return 2;
                }elseif ($a['peran'] == 'Pengendali Teknis' ) {
                    return 3;
                }elseif ($a['peran'] == 'Ketua Tim' ) {
                    return 4;
                }else{
                    return 5;
                }

            });
            //dd($list);
            //$data = Session::get('anggota')->orderByRaw('peran',['Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim']);
            //setup data anggota
            $dt = Datatables::of($list)
                ->addIndexColumn()
                ->addColumn('nama_anggota', function($col){
                    $user = User::findOrFail($col['user_id']);
                    return $user->full_name;
                })
                ->addColumn('action', function($col){
                    //hapus session by user_id
                    return '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
                })
                //->order(function($query){
                    //$query->orderByRaw('peran', ['Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim']);
                    //$query->orderByRaw("CASE WHEN peran = 'Penanggungjawab' THEN 1 WHEN peran = 'Pembantu Penanggungjawab' THEN 2 WHEN peran = 'Pengendali Mutu' THEN 3 WHEN peran = 'Pengendali Teknis' THEN 4 WHEN peran = 'Ketua Tim' THEN 5 ELSE 6 END");
                //})
                ->make(true);

        }else{

            $dt = Datatables::of($data)->toJson();
        }


        return $dt;
    }

    public function clearSessionAnggota(){
        Session::forget('anggota');
        return "Session Anggota deleted";
    }

    public function clearSessionAnggotaUmum(){
        Session::forget('anggota_umum');
        return "Session Anggota deleted";
    }

    public function deleteSessionAnggotaItem(Request $request){
        $user_id = $request->user_id;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;

        foreach (Session::get('anggota', []) as $id => $entries) {
            if ($entries['user_id'] === $user_id) {
                Session::forget('anggota.' . $id);
                break; // stop loop
            }
        }

    }

    // public function deleteSessionKepadaItem(Request $request){
    //     $user_id = $request->user_id;
    //     $tgl_mulai = $request->tgl_mulai;
    //     $tgl_akhir = $request->tgl_akhir;

    //     foreach (Session::get('kepada_umum', []) as $id => $entries) {
    //         if ($entries['user_id'] === $user_id) {
    //             Session::forget('kepada_umum.' . $id);
    //             break; // stop loop
    //         }
    //     }
    // }

    public function deleteSessionAnggotaUmumItem(Request $request){
        $user_id = $request->user_id;
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;

        foreach (Session::get('anggota_umum', []) as $id => $entries) {
            if ($entries['user_id'] === $user_id) {
                Session::forget('anggota_umum.' . $id);
                break; // stop loop
            }
        }
    }

    public function getSptUmumbyId($id)
    {
        $data = SptUmum::findOrFail($id);
        return $data;
    }

    // menampilkan data tambahan bedasarkan jenis_spt_id
    public function getLastDataTambahan($jenis_spt_id){
        $data = Spt::select('tambahan')->where('jenis_spt_id',$jenis_spt_id)->latest()->first();
        return $data;
    }

    // jenis data disesuikan dengan nama kolom ditabel
    public function getLastData($jenis_data){
        $spt = Spt::select($jenis_data);
        $data = ( $jenis_data === 'nomor' ) ? $spt->whereNotNull('nomor') : $spt;
        $data = $data->latest("updated_at")->first();
        return $data;
    }

    public function getLastDataUmum($jenis_data){
        $spt = SptUmum::select($jenis_data);
        $data = ( $jenis_data === 'nomor' ) ? $spt->whereNotNull('nomor') : $spt;
        $data = $data->latest("updated_at")->first();
        return $data;
    }

    public function getDurasi(Request $request){
        $start = $request->start;
        $end = $request->end;
        if($start !== null && $end !== null){
            $common = new Common;
            $data = $common->workingDays($start, $end);
            return $data;
        }
        return;
    }

    public function drawTableAnggota(Request $request){
        $spt = Spt::where('id', $request->spt_id)->whereHas('jenisSpt', function($q){
            $q->where('kategori','pengawasan');
        })->first();
        //dd($request->spt_id);$this->buildControl('deleteAnggota',$col->id); '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
        $return = '<table class="table table-bordered table-hover">'
                        .'<thead><tr>'
                            .'<th>No.</th>'
                            .'<th>Nama</th>'
                            .'<th>Peran</th>'
                            .'<th></th>'
                        .'</tr></thead>';
        if(!is_null($spt)){
            //bukan spt baru, data spt sudah ada, tampilkan data anggota spt dari tabel detail
            $list_anggota = DetailSpt::where('spt_id', $request->spt_id)->where('unsur_dupak', 'pengawasan')->with('user')->get();
            //dd($list_anggota);
            foreach($list_anggota as $i=>$anggota){
                $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$anggota->user->full_name_gelar.'</td>'
                            .'<td>'.$anggota->peran.'</td>'
                            .'<td>'.$this->buildControl('deleteAnggota',$anggota->id).'</td>'
                            .'</tr>';
            }
            if($list_anggota->count()<=0){
                $return .= '<tr><td colspan="4" align="center">Tidak ada data anggota</td></tr>';
            }

        }else{
            //data belum ada, cek session anggota, jika ada tampilkan data session anggota
            if(Session::has('anggota')){
                $session_anggota = Session::get('anggota');
                //setup data anggota
                foreach($session_anggota as $i=>$anggota){
                    $user = User::where('id',$anggota['user_id'])->first();
                    $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$user->full_name_gelar.'</td>'
                            .'<td>'.$anggota['peran'].'</td>'
                            .'<td><a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$anggota['user_id'].')" title="hapus anggota"><i class="fa fa-times"></i></a></td>'
                            .'</tr>';
                }
                if(count($session_anggota)<=0){
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

    public function drawTableAnggotaUmum(Request $request){
        $spt = SptUmum::where('id', $request->spt_id)->first();
        //dd($request->spt_id);$this->buildControl('deleteAnggota',$col->id); '<a href="#" class="btn btn-sm btn-outline-danger" onclick="unset('.$col['user_id'].')">Hapus</a>';
        $return = '<table class="table table-bordered table-hover">'
                        .'<thead><tr>'
                            .'<th>No.</th>'
                            .'<th>Nama</th>'
                            .'<th></th>'
                        .'</tr></thead>';
        if(!is_null($spt)){
            //bukan spt baru, data spt sudah ada, tampilkan data anggota spt dari tabel detail
            $list_anggota = DetailSpt::where('spt_id', $request->spt_id)->where('unsur_dupak', '!=','pengawasan')->with('user')->get();
            //dd($list_anggota);
            foreach($list_anggota as $i=>$anggota){
                $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$anggota->user->full_name_gelar.'</td>'
                            .'<td>'.$this->buildControl('deleteAnggotaUmum',$anggota->id).'</td>'
                            .'</tr>';
            }
            if($list_anggota->count()<=0){
                $return .= '<tr><td colspan="4" align="center">Tidak ada data anggota</td></tr>';
            }

        }else{
            //data belum ada, cek session anggota, jika ada tampilkan data session anggota
            if(Session::has('anggota_umum')){
                $session_anggota = Session::get('anggota_umum');
                //setup data anggota
                foreach($session_anggota as $i=>$anggota){
                    $user = User::where('id',$anggota['user_id'])->first();
                    $return .= '<tr>'
                            .'<td>'.++$i.'</td>'
                            .'<td>'.$user->full_name_gelar.'</td>'
                            .'<td><a href="#" class="btn btn-sm btn-outline-danger" onclick="unset_anggota('.$anggota['user_id'].')" title="hapus anggota"><i class="fa fa-times"></i></a></td>'
                            .'</tr>';
                }
                if(count($session_anggota)<=0){
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


}
