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


class SptController extends Controller
{
    
    private $list_peran = ['Penanggungjawab', 'Pembantu Penanggungjawab','Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim'];
    
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
        return view('admin.spt.index', 
            [
            'spt'=>$spt,
            'jenis_spt'=>$jenisSpt,
            'listAnggota'=>$listAnggota,
            'listPeran'=>$this->list_peran,
            'listLokasi' => $listLokasi
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
        /*$request->tgl_mulai = Carbon::createFromLocaleIsoFormat('Y-m-d H:i:s', config('app.locale'), $request['tgl_mulai']);
        $request->tgl_akhir = Carbon::createFromLocaleIsoFormat('Y-m-d H:i:s', config('app.locale'), $request['tgl_akhir']);*/
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
            'name' => $request['name'],
            'tgl_mulai' => date('Y-m-d H:i:s',strtotime($request['tgl_mulai'])),
            'tgl_akhir' => date('Y-m-d H:i:s',strtotime($request['tgl_akhir'])),
            'lama' => $request['lama'],
            'lokasi_id' => $request['lokasi_id'],
            'tambahan' => $request['tambahan'],
            'info' => $request['info'],
        ];
        
        $spt = Spt::create($data);
        if($spt) {
            
            $this->storeDetail($spt->id, $spt->lama);

            /*//user id pembuat spt
            $info['user_id'] = $user->id;
            $info['type'] = 'spt';

            //role perencanaan jika membuat spt maka otomatis menjadi spt pengawasan, jika role TU umum: spt umum, selain itu set NULL.
            $info['jenis'] = ( $user->hasRole('TU Perencanaan') ) ? 'pengawasan' : (($user->hasRole('TU Umum')) ? 'umum' : NULL);
            
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

    public function storeDetailAnggota(Request $request){
        $this->validate($request,[
            'user_id' => 'required|integer',
            'peran' => 'required|string|min:5'
        ]);
        $spt = Spt::find($request->spt_id);
        $unsur_dupak = $spt->jenisSpt->kategori;
        $start =$spt->tgl_mulai;
        $end = $spt->tgl_akhir;
        $lama = $spt->lama;

        //cek lembur, set lembur to true jika tgl mulai spt ada di tgl akhir spt
        $lembur = Spt::where('tgl_akhir','=', $start)->where('user_id','=', $request['user_id'])->join('detail_spt','detail_spt.spt_id','=','spt.id')->get();
        $isLembur = ( $lembur->count() > 0) ? true : false;
         
        $anggota_spt = DB::table('detail_spt')->insertGetId([
            'spt_id' => $request['spt_id'],
            'user_id' => $request['user_id'],
            'peran' => $request['peran'],
            'unsur_dupak' => $unsur_dupak,
            //'dupak' => $this->hitungDupak($request['user_id'],$request['peran'],$lama, $isLembur)
        ]);
        return $request;
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

                DB::table('detail_spt')->insertGetId([
                'spt_id' => $spt_id,
                'user_id' => $anggota['user_id'],
                'peran' => $anggota['peran'],
                'unsur_dupak' => $unsur_dupak,
                //'dupak' => $this->hitungDupak($anggota['user_id'],$anggota['peran'],$lama,$isLembur)
            ]);
            }
            $this->clearSessionAnggota();
        }
        return;
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
        $spt = Spt::find($id);        
        $jenis_spt = $spt->jenisSpt;
        $spt['tgl_mulai'] = date('d-m-Y', strtotime($spt->tgl_mulai));
        $spt['tgl_akhir'] = date('d-m-Y', strtotime($spt->tgl_akhir));
        return $spt;
        return $jenis_spt;
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
            'tambahan' => $request['tambahan'],
            'info' => $request['info'],
        ];


        $spt = Spt::findOrFail($id);
        $spt->jenis_spt_id = $data['jenis_spt_id'];
        $spt->tgl_mulai = $data['tgl_mulai'];
        $spt->tgl_akhir = $data['tgl_akhir'];
        $spt->lama = $data['lama'];
        $spt->lokasi_id = $data['lokasi_id'];
        $spt->tambahan = $data['tambahan'];
        $spt->info = $data['info'];
        $spt = $spt->save();
        if($spt){
            $updated_spt = Spt::findOrFail($id);
            $jenis_spt = JenisSpt::select('name','sebutan')->where('id',$updated_spt['jenis_spt_id'])->first();

            $user = auth()->user();            
            $event = Event::where('info->spt_id',$id)->update([
               'title' => $jenis_spt->sebutan,
               'start' => $updated_spt->tgl_mulai,
               'end' => $updated_spt->tgl_akhir,
               'info' => json_encode([
                           'user_id' => $user->id, //user id pembuat spt
                           'type' => 'spt',
                           'jenis'=> ( $user->hasRole('Perencanaan') ) ? 'pengawasan' : 'umum',
                           'spt_id' => $id
                      ])
            ]);
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
                    $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> Info tambahan : ' . Common::cutText($col->tambahan, 2, 70) . '</small>' : '';
                    return $col->jenisSpt->name . $tambahan ;
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
                            $return .= '<a href="'.$col->file.'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
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
        if($user->hasAnyPermission(['Create SPT', 'Edit SPT', 'Delete SPT']) && $method == 'deleteAnggota'){
            $control = '<a href="javascript:void(0);" onclick="deleteAnggota('. $id .')" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }
        if($user->hasPermissionTo('View SPT') && $method === 'cetakPdf'){
        $control = '<a href="'.route('spt_pdf',$id).'" data-toggle="tooltip" title="Cetak PDF" class="btn btn-outline-primary btn-sm" target="__blank"><i class="fa fa-file-pdf"></i></a>';
        }
        if($user->hasPermissionTo('View SPT') && $method === 'viewAnggota'){
            $control = '<a href="javascript:void(0);" onclick="viewAnggota('. $id .')" data-toggle="tooltip" title="Anggota SPT" class="btn btn-outline-primary btn-sm"><i class="ni ni-single-02"></i></a>';
        }
        if($user->hasPermissionTo('Sign SPT') && $method === 'signOrReject'){
            $control = '<a href="#" onclick="showRejectFormModal('.$id.')" class="btn btn-outline-danger btn-sm">Tolak</a> 
                    <a href="#" onclick="sign('.$id.')" class="btn btn-outline-success btn-sm">Setuju</a> ';
        }

        if($user->hasRole('Auditor') && $method === 'buatKka'){
            $control = '<a href="'.route('input_kka',$id).'"data-toggle="tooltip" title="Upload KKA" class="btn btn-outline-success btn-sm" target="__blank"><i class="ni ni-folder-17"></i><span>Input KKA</span></a>';
        }

        if($user->hasRole('Auditor') && $method === 'buatLhp'){
            $control = '<a href="'.route('input_lhp',$id).'"data-toggle="tooltip" title="Upload LHP" class="btn btn-outline-success btn-sm" target="__blank"><i class="ni ni-folder-17"></i><span>Input LHP</span></a>';
        }

        if($user->hasRole('Auditor') && $method === 'buatLaporan-disable'){
            $control = '<a href="#"data-toggle="tooltip" title="Maaf untuk spt tsbt tidak bisa input kka" class="btn btn-outline-danger btn-sm disabled"><i class="ni ni-folder-17"></i><span>Input Temuan</span></a>';
        }

        if($user->hasRole('Auditor') && $method === 'Cetak_KKA'){
            // $control = '<a href="#"data-toggle="tooltip" title="Cetak KKA" class="btn btn-outline-danger btn-sm" target="__blank"><i class="ni ni-single-copy-04"></i><span>Cetak KKA</span></a>';
            $control = '<a href="'.route('laporan-cetak',$id).'" data-toggle="tooltip" title="Cetak KKA" class="btn btn-outline-danger btn-sm"><i class="ni ni-single-copy-04"></i><span>Lihat</span></a>';
        }

        if ( $user->hasAnyRole(['TU Umum', 'Super Admin']) && $method == 'penomoran') {
                    $control = '<a href="#" onclick="showFormModal('.$id.')" class="btn btn-outline-primary btn-sm" title="Penomoran SPT"><i class="fa fa-list-ol"></i></a>';
                    return $control;
                    }
        

        return $control;
    }

    public function sptPdf($id){        
        $spt = Spt::findOrFail($id);
        $sort_detail = implode(",",$this->list_peran);
        $detail_spt = DetailSpt::where('spt_id','=',$id)->with(['spt','user'])
            ->orderByRaw(DB::raw("FIELD(peran,'Penanggungjawab', 'Pembantu Penanggungjawab', 'Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim')"))->get();
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

    public function getAnggota($id=null)
    {        
        //setup tabel anggota spt, jika ada data di detail_spt maka mengambil data anggota dari tabel, jika tidak, cek apakah ada data session, selebihnya set empty data untuk menghindari pesan error

        //cek data di tabel
        $cek_data = ( $id == 0 ) ? 0 : DetailSpt::where('spt_id', $id)->count();        

        if($cek_data > 0){

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
                    $control = '<a href="#" onclick="showFormModal('.$col->id.')" class="btn btn-sm">Penomoran</a>';
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

    public function updateNomorSpt(Request $request){
        $id = $request->spt_id;
        $spt = Spt::findOrFail($id);
        $filename = ($request->file_spt) ? 'SPT-' . $id . '-' . $request->file_spt->getClientOriginalName() : null ;
        //dd(storage_path()."/spt");
        if($filename !== null ){
            if (! File::exists(public_path()."/storage/spt")) {
                File::makeDirectory(public_path()."/storage/spt", 0755, true);
            }
            $request->file_spt->move(public_path()."/storage/spt" , $filename);
        } 
        $spt->file = ($filename !== null ) ? url('/storage/spt/'.$filename) : null;
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
        if($spt->save()) {

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
        return false;
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
    public function createEventSpt($spt){
        $user = auth()->user();
        //user id pembuat spt
        $info['user_id'] = $user->id;
        $info['type'] = 'spt';

        //role perencanaan jika membuat spt maka otomatis menjadi spt pengawasan, jika role TU umum: spt umum, selain itu set NULL.
        $info['jenis'] = ( $user->hasRole('TU Perencanaan|Super Admin') ) ? 'pengawasan' : (($user->hasRole('TU Umum')) ? 'umum' : NULL);
        
        $info['spt_id'] = $spt->id;
        $insertArr = [ 
           'title' => $spt->jenisSpt->sebutan,
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
        if($filename !== null ) $request->file_spt->move(public_path('storage\files') , $filename);
        $spt->file = ($filename !== null ) ? url('storage/files/'.$filename) : null;
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

    public function hitungDupak($user_id,$peran,$lama_jam){
        $user = User::findOrFail($user_id,['jabatan']);
        $jabatan = $user->jabatan;

        //coba penyesuaian dari yogi untuk jenis SPT kategori A (Sidak, Kasus, AKIP, Lakip, Monev)/ bukan audit khusus berindikasi tindak pidana korupsi
        switch($peran){
            case 'Pengendali Mutu' :
                if ('Auditor Utama' == $jabatan ) {
                    //$dupak = 0.04 * $lama_jam;
                    $dupak = [
                        'koef' => 0.04,
                        'nilai'=> 0.04 * $lama_jam
                    ];
                }
                elseif ('Auditor Madya' == $jabatan) {
                    //$dupak = 0.032 * $lama_jam;
                    $dupak = [
                        'koef' => 0.032,
                        'nilai'=> 0.032 * $lama_jam
                    ];
                }
                else {
                    //$dupak = 0;
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Pengendali Teknis' :
                if ('Auditor Utama' == $jabatan ) {
                    //$dupak = 0.03 * $lama_jam;
                    $dupak = [
                        'koef' => 0.03,
                        'nilai'=> 0.03 * $lama_jam
                    ];
                }
                elseif('Auditor Madya' == $jabatan) {
                    //$dupak = 0.032 * $lama_jam;
                    $dupak = [
                        'koef' => 0.032,
                        'nilai'=> 0.032 * $lama_jam
                    ];
                }
                elseif('Auditor Muda' == $jabatan) {
                    //$dupak =  0.024 * $lama_jam;
                    $dupak = [
                        'koef' => 0.024,
                        'nilai'=> 0.024 * $lama_jam
                    ];
                }
                else {
                    //$dupak = 0;
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Ketua Tim' :
                if('Auditor Madya' == $jabatan) {
                    //$dupak = 0.02 * $lama_jam;
                    $dupak = [
                        'koef' => 0.02,
                        'nilai'=> 0.02 * $lama_jam
                    ];
                }
                elseif('Auditor Muda' == $jabatan) {
                    //$dupak = 0.02 * $lama_jam;
                    $dupak = [
                        'koef' => 0.02,
                        'nilai'=> 0.02 * $lama_jam
                    ];
                }
                elseif('Auditor Pertama' == $jabatan) {
                    //$dupak = 0.016 * $lama_jam;
                    $dupak = [
                        'koef' => 0.016,
                        'nilai'=> 0.016 * $lama_jam
                    ];
                }
                else {
                    //$dupak = 0;
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;

            case 'Anggota Tim' :
                if('Auditor Muda' == $jabatan) {
                    //$dupak = 0.01 * $lama_jam;
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Pertama' == $jabatan) {
                    //$dupak = 0.01 * $lama_jam;
                    $dupak = [
                        'koef' => 0.01,
                        'nilai'=> 0.01 * $lama_jam
                    ];
                }
                elseif('Auditor Pelaksana' == $jabatan) {
                    //$dupak = 0.004 * $lama_jam;
                    $dupak = [
                        'koef' => 0.004,
                        'nilai'=> 0.004 * $lama_jam
                    ];
                }
                else {
                    //$dupak = 0;
                    $dupak = [
                        'koef' => 0,
                        'nilai'=> 0
                    ];
                }
            break;
            
            default:
                //$dupak = 0;
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
                    $tambahan = (!is_null($col->tambahan) ) ? '<br /> <small class="text-muted"> Info tambahan : ' . Common::cutText($col->tambahan, 2) . '</small>' : '';
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
                    //$control = $this->buildControl('cetakPdf',$col->spt_id);

                    $control = "";
                    if( !is_null($col->nomor) ){
                        if(!is_null($col->file) || $col->file != ""){
                            $control .= '<a href="'.$col->file.'" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-primary btn-sm" target="__blank"><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                        }else{
                            $control .= '<a href="#" data-toggle="tooltip" title="Scan SPT" class="btn btn-outline-danger btn-sm disabled" ><i class="ni ni-paper-diploma"></i><span>Download</span></a>';
                        }
                    }

                    $get_id_detail = DetailSpt::where('id',$col->id_detail)->first(); //get by id detail
                    if($get_id_detail != false){
                        $control .= $this->buildControl('pemeriksaan',$col->spt_id);

                        $ceking_data_detail_sendiri = DetailSpt::where('spt_id',$col->id)->where('user_id',auth()->user()->id)->get();
                        
                        if ($ceking_data_detail_sendiri[0]->id_laporan_pemeriksaan != null) {
                            $control .= $this->buildControl('Cetak_KKA',$ceking_data_detail_sendiri[0]->id);
                        }
                            if ($ceking_data_detail_sendiri[0]->peran == 'Ketua Tim') {
                                // dd($ceking_data_detail_sendiri[0]->status);
                                if ($ceking_data_detail_sendiri[0]->status != null) {
                                    $control .= $this->buildControl('buatLhp',$get_id_detail);
                                    $control .= '<a href="#" onclick="showModalLihatLaporanPemeriksaan('.$ceking_data_detail_sendiri[0]->id.')" data-toggle="tooltip" title="Lihat KKA" class="btn btn btn-outline-info btn-sm"><i class="ni ni-paper-diploma"></i></a>';
                                }else{
                                    $control .= $this->buildControl('buatLaporan-disable',$get_id_detail);
                                    $control .= '<a href="#" onclick="showModalLihatLaporanPemeriksaan('.$ceking_data_detail_sendiri[0]->id.')" data-toggle="tooltip" title="Lihat KKA" class="btn btn btn-outline-info btn-sm"><i class="ni ni-paper-diploma"></i></a>';
                                }
                            }elseif($ceking_data_detail_sendiri[0]->peran == 'Anggota Tim'){
                                    if($ceking_data_detail_sendiri[0]->status == null){
                                        $control .= $this->buildControl('buatKka',$get_id_detail);
                                    }elseif($ceking_data_detail_sendiri[0]->status != null){
                                        $control .= $this->buildControl('buatLaporan-disable',$get_id_detail);
                                    }
                                    $control .= '<a href="#" onclick="showModalLihatLaporanPemeriksaan('.$ceking_data_detail_sendiri[0]->id.')" data-toggle="tooltip" title="Lihat KKA" class="btn btn btn-outline-info btn-sm"><i class="ni ni-paper-diploma"></i></a>';
                            }elseif($ceking_data_detail_sendiri[0]->peran == 'Pengendali Teknis' || $ceking_data_detail_sendiri[0]->peran == 'Pengendali Mutu' || $ceking_data_detail_sendiri[0]->peran == 'PenanggungJawab'){
                                $control .= $this->buildControl('buatLaporan-disable',$get_id_detail);
                                $control .= '<a href="#" onclick="showModalLihatLaporanPemeriksaan('.$ceking_data_detail_sendiri[0]->id.')" data-toggle="tooltip" title="Lihat KKA" class="btn btn btn-outline-info btn-sm"><i class="ni ni-paper-diploma"></i></a>';
                            }else{
                                $control .= null;
                            }
                            
                    }else{
                        return 'no Action';
                    }

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
            
            if(in_array($uid,$anggota_uid)){
                return "User sudah ada dalam list anggota";
            }else{
                $session = Session::push('anggota', [
                    'user_id'    => $request->user_id,
                    'peran'   => $request->peran
                ]);
                return "Session anggota updated";
            }
            
        }else{
            $session = Session::push('anggota', [
                'user_id'    => $request->user_id,
                'peran'   => $request->peran
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

    public function getLastDataTambahan($jenis_spt_id){
        $data = Spt::select('tambahan')->where('jenis_spt_id',$jenis_spt_id)->latest()->first();
        return $data;        
    }

    public function getLastData($jenis_data){
        $spt = Spt::select($jenis_data);
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

}
