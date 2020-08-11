<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\DetailSpt, App\models\Dupak, App\User;
use DB, Yajra\DataTables\DataTables, PDF;
use Redirect,Response;

class DupakController extends Controller
{
    public function __construct() {
        $this->middleware(['auth','role:Super Admin|TU Umum|TU Perencanaan|Auditor']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        //pisahkan index dupak sesuai role masing-masing fungsi
        if($user->hasAnyRole(['Super Admin', 'TU Umum', 'TU Perencanaan'])){
            return view('admin.dupak.form');
        }elseif ($user->hasAnyRole(['Auditor'])) {
            //fitur sementara disable by server, masih develop
            //return view('admin.dupak.auditor');
            return response('Fitur sementara sedang dalam perbaikan', 401);
        }
    }

    public function reviuDupak()
    {
        # code...
    }

    public function getData(Request $request)
    {
        if($request->ajax()):
            $year = ($request->tahun) ? $request->tahun : date('Y');
            if(isset($request->semester)) {
                if($request->semester === 1) {
                    $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                    $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
                }
                elseif ($request->semester === 2) {
                    $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                    $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
                }else{
                    return response('Pilih periode semester terlebih dahulu.', 401);
                }
            }

        /*$detail_spt = DetailSpt::where('unsur_dupak','=','pengawasan');
        $dupak = ( isset($start) && isset($end) ) ? $detail_spt->whereHas('spt', function($query) use ($start,$end){
            $query->whereBetween('tgl_mulai', [$start, $end]);
        }) : $detail_spt;

        $data = $dupak->select('info_dupak')->with('spt', function($query) use ($start,$end){
            $query->whereBetween('tgl_mulai', [$start, $end]);
        })
        ->get();*/
        $data = DetailSpt::whereHas('spt', function($q){
            $q->whereBetween('tgl_mulai',['2020-08-11 00:00:00','2020-08-15 00:00:00']);
        })->with('spt')->where('unsur_dupak','=','pengawasan')->get();
        //dd($data);

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_spt', function($col){
                return $col->spt->periode;
            })
            ->addColumn('lama_spt', function($col){
                return $col->spt->lama;
            })
            ->addColumn('efektif', function($col){
                return $col->info_dupak['efektif'];
            })
            ->addColumn('kegiatan', function($col){
                return;
            })
            ->addColumn('koefisien', function($col){
                return $col->info_dupak['koefisien'];
            })
            ->addColumn('dupak', function($col){
                return $col->info_dupak['dupak'];
            })
            ->addColumn('peran', function($col){
                return $col->peran;
            })
            ->addColumn('lembur', function($col){
                return $col->info_dupak['lembur'];
            })                
            ->addColumn('action', function($user){                    
                return;
            })
            ->make(true);
        endif;
    }

    public function dupakUser($user_id)
    {
        $user = User::find($user_id);
        $dupak_pengawasan_lama = Dupak::where('user_id',$user->id)->where('unsur_dupak','pengawasan')->where('status', 'lama')->sum('dupak');
        $dupak_pengawasan_baru = Dupak::where('user_id',$user->id)->where('unsur_dupak','pengawasan')->where('status', 'baru')->sum('dupak');
        $dupak_pendidikan = Dupak::select('dupak')->where('unsur_dupak','pendidikan')->orderByRaw(DB::raw("FIELD(status,'baru','lama')"))->first();
        $dupak_pengawasan_spt = DetailSpt::where('user_id',$user_id)->where('unsur_dupak','pengawasan')->where('status_dupak','aktif')->with('spt')->get();      
        $pdf = PDF::loadView('admin.laporan.dupak.index', 
            [
                'user'=>$user,
                'dupak_pengawasan_lama'=>$dupak_pengawasan_lama,
                'dupak_pengawasan_baru'=>$dupak_pengawasan_baru,
                'dupak_pendidikan'=>$dupak_pendidikan->pluck('dupak')[0],
                'dupak_pengawasan_spt'=>$dupak_pengawasan_spt
            ]);
        return $pdf->stream('dupak-'.$user_id.'.pdf',array('Attachment'=>1));
    }

     public function buildControl($method,$id){
        //$id = id SPT
        $user = auth()->user();
        $user_dupak = User::find($id);
        $control = '';
        if($user->hasAnyRole(['Super Admin', 'TU Umum', 'Auditor']) && $method === 'detail'){
            $control = '<a href="'.route('get_dupak_user',$id).'" data-toggle="tooltip" title="Lihat detail dupak" class="btn btn-outline-primary btn-sm" target="__blank"<i class="ni ni-paper-diploma"></i><span>Lihat</span></a>';
        }
        if($method === 'add' ){
           if (($user_dupak->ruang['nama'] == $user->ruang['nama'] && $user->ruang['jabatan'] == 'kepala') || $user->hasAnyRole(['Super Admin'])){
            $control = '<a href="javascript:void(0);" onclick="isiDupakUser('.$id.')" data-toggle="tooltip" title="isi dupak" class="btn btn-outline-primary btn-sm" <span>Isi Dupak</span></a>';
           }
        }
        return $control;
    }

    public function storePenunjang(Request $request){
        $user_id = $request->user_id;
        $dupak_penunjang = $request->dupak_penunjang;
        $recent_dupak_penunjang = Dupak::where('user_id', $user_id)->where('unsur_dupak','penunjang')->where('status','baru');
        if($recent_dupak_penunjang->count() > 0){
            //update dupak penunjang yang sudah ada menjadi dupak penunjang lama
            $recent_dupak_penunjang_lama = Dupak::where('user_id', $user_id)->where('unsur_dupak','penunjang')->where('status','lama');
            
            $dupak_penunjang_lama = ($recent_dupak_penunjang_lama->count() > 0) ? $recent_dupak_penunjang->pluck('dupak')[0] + $recent_dupak_penunjang_lama->pluck('dupak')[0] : $recent_dupak_penunjang->pluck('dupak')[0];
            $update_dupak_penunjang = $recent_dupak_penunjang->update(['dupak' => $dupak_penunjang_lama]);
            if($recent_dupak_penunjang_lama->count()>0 && $update_dupak_penunjang){
                $recent_dupak_penunjang_lama->delete();
            }
            $recent_dupak_penunjang->update(['status' => 'lama']);
        }
        //store inputan dupak menjadi dupak penunjang baru
        $data = [
            'user_id' => $user_id,
            'dupak' => $dupak_penunjang,
            'status' => 'baru',
            'unsur_dupak' => 'penunjang'
        ];
        $dupak = Dupak::create($data);
        return $dupak;

        
    }

    public function dupakAuditor(){
        //processed only on ajax request
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
         $user = auth()->user();
 
         //query db between date
         $data = Dupak::whereDate('info_spt->tgl_mulai', '>=', $start)->whereDate('info_spt->tgl_akhir',   '<=', $end)->where('user_id',$user->id)->get(['id', 'info_spt->tgl_mulai as start', 'info_spt->tgl_akhir as end', 'info_spt->jenis_spt as title', 'info_spt as info']);
         
         return Response::json($data);
        }
        return view('admin.calendar.user.index');
    }

    
}
