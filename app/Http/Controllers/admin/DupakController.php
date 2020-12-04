<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Spt, App\models\DetailSpt, App\models\Dupak, App\models\Pejabat, App\User;
use App\models\Ppm, App\models\DetailPpm;
use DB, Yajra\DataTables\DataTables, PDF;
use Redirect,Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Config, File;

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
        /*$user = auth()->user();
        //pisahkan index dupak sesuai role masing-masing fungsi
        if($user->hasAnyRole(['Super Admin', 'TU Umum', 'TU Perencanaan'])){
            return view('admin.dupak.form');
        }elseif ($user->hasAnyRole(['Auditor'])) {
            //fitur sementara disable by server, masih develop
            //return view('admin.dupak.auditor');
            return response('Fitur sementara sedang dalam perbaikan', 401);
        }*/
        return view('admin.dupak.index');
    }


    public function getData(Request $request) //tradisional
    {
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        if(isset($request->semester)) {
            if($request->semester == 1) {
                $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
            }
            elseif ($request->semester == 2) {
                $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
            }else{
                return response('Pilih periode semester terlebih dahulu.', 401);
            }
        }else{
            $start = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-01-01")) : date("Y-m-d H:i:s", strtotime("$year-07-01"));
            $end = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-06-30")) : date("Y-m-d H:i:s", strtotime("$year-12-31"));
        }

        //query dari model Spt
        /*$data = Spt::whereHas('detailSpt', function($q) use ($user_id){
            $q->where('user_id','=',$user_id);
        })
        ->whereNotNull('nomor') // nomor spt ga boleh null kalo buat dupak cuy
        //->whereBetween('tgl_mulai',[$start,$end])->with(['detailSpt','jenisSpt'])->get();
        ->whereBetween('tgl_mulai',[$start,$end])->with(['detailSpt','jenisSpt'])->get();*/

        //query dari model DetailSpt
        $data = DetailSpt::whereHas('spt', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('spt')
        ->where('unsur_dupak','=','pengawasan')->where('user_id','=',$user_id)->get();

        return $data;
    }

    public function getDataz(Request $request) //datatable
    {
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        if($request->ajax()):
            $year = ($request->tahun) ? $request->tahun : date('Y');
            if(isset($request->semester)) {
                if($request->semester == 1) {
                    $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                    $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
                }
                elseif ($request->semester == 2) {
                    $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                    $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
                }else{
                    return response('Pilih periode semester terlebih dahulu.', 401);
                }
            }else{
                $start = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-01-01")) : date("Y-m-d H:i:s", strtotime("$year-07-01"));
                $end = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-06-30")) : date("Y-m-d H:i:s", strtotime("$year-12-31"));
            }

        /*$detail_spt = DetailSpt::where('unsur_dupak','=','pengawasan');
        $dupak = ( isset($start) && isset($end) ) ? $detail_spt->whereHas('spt', function($query) use ($start,$end){
            $query->whereBetween('tgl_mulai', [$start, $end]);
        }) : $detail_spt;

        $data = $dupak->select('info_dupak')->with('spt', function($query) use ($start,$end){
            $query->whereBetween('tgl_mulai', [$start, $end]);
        })
        ->get();*/
        //query dari model DetailSpt
        /*$data = DetailSpt::whereHas('spt', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end]);
        })->with('spt')->where('unsur_dupak','=','pengawasan')->get();*/

        //query dari model Spt
        $data = Spt::whereHas('detailSpt', function($q) use ($user_id){
            $q->where('user_id','=',$user_id);
        })
        ->whereNotNull('nomor') // nomor spt ga boleh null kalo buat dupak cuy
        //->whereBetween('tgl_mulai',[$start,$end])->with(['detailSpt','jenisSpt'])->get();
        ->whereBetween('tgl_mulai',[$start,$end])->with(['detailSpt','jenisSpt'])->get();

        //dd($data->detailSpt);


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_spt', function($col){
                return $col->periode;
            })
            ->addColumn('lama_spt', function($col){
                return $col->lama;
            })
            ->addColumn('efektif', function($col) use ($user_id){
                $detail_spt = $col->detailSpt->toArray();
                $users = array_column($detail_spt,'user_id');
                $key = array_search($user_id, $users);
                return $col->detailSpt[$key]->info_dupak['efektif'];
            })
            ->addColumn('kegiatan', function($col){
                return $col->jenisSpt->sebutan;
            })
            ->addColumn('koefisien', function($col) use ($user_id){
                $detail_spt = $col->detailSpt->toArray();
                $users = array_column($detail_spt,'user_id');
                $key = array_search($user_id, $users);
                return $col->detailSpt[$key]->info_dupak['koefisien'];
            })
            ->addColumn('dupak', function($col) use ($user_id){
                $detail_spt = $col->detailSpt->toArray();
                $users = array_column($detail_spt,'user_id');
                $key = array_search($user_id, $users);
                return $col->detailSpt[$key]->info_dupak['dupak'];
            })
            ->addColumn('peran', function($col) use ($user_id){
                $detail_spt = $col->detailSpt->toArray();
                $users = array_column($detail_spt,'user_id');
                $key = array_search($user_id, $users);
                return $col->detailSpt[$key]->peran;
            })
            ->addColumn('lembur', function($col) use ($user_id){
                $detail_spt = $col->detailSpt->toArray();
                $users = array_column($detail_spt,'user_id');
                $key = array_search($user_id, $users);
                return $col->detailSpt[$key]->info_dupak['lembur'];
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

    public function getDupakPendidikanz(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        if($request->ajax()):
            $q = Dupak::where('user_id', $user_id)->where('unsur_dupak','pendidikan');
            if($q->count()>1){
                $dupak = $q->where('status','baru')->get();
            }else{
                $dupak = $q->get();
            }

            //set datatable column
            return Datatables::of($dupak)
            ->addIndexColumn()
            ->addColumn('sub_unsur', function($col) use ($user_id){
                $q = User::where('id', $user_id)->select('pendidikan')->first();
                $data = json_decode($q,true);
                //return $data[0]['tingkat'].' '.$data[0]['jurusan'];
                return $data['pendidikan']['tingkat'].' '.$data['pendidikan']['jurusan'];
            })
            ->addColumn('butir_kegiatan', function($col){
                return '';
            })
            ->addColumn('dupak', function($col){
                return $col->dupak;
            })
            ->addColumn('action', function($user){
                return;
            })
            ->make(true);
            //end datatable

        endif;
    }

    public function getDupakPendidikan(Request $request){
      $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
      $q = Dupak::where('user_id', $user_id)->where('unsur_dupak','pendidikan');
      if($q->count()>1){
          $dupak = $q->where('status','baru');
      }else{
          $dupak = $q;
      }
      $data = $dupak->get();

      return $data;

    }

    public function getDupakDiklat(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        if(isset($request->semester)) {
            if($request->semester == 1) {
                $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
            }
            elseif ($request->semester == 2) {
                $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
            }else{
                return response('Pilih periode semester terlebih dahulu.', 401);
            }
        }else{
            $start = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-01-01")) : date("Y-m-d H:i:s", strtotime("$year-07-01"));
            $end = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-06-30")) : date("Y-m-d H:i:s", strtotime("$year-12-31"));
        }

        //query dari model DetailSpt
        $data = DetailSpt::whereHas('sptUmum', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('sptUmum')
        ->where('unsur_dupak','=','diklat')->where('user_id','=',$user_id)->get();

        return $data;
        //getDupakPenunjang
    }

    public function getDupakPenunjang(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        if(isset($request->semester)) {
            if($request->semester == 1) {
                $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
            }
            elseif ($request->semester == 2) {
                $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
            }else{
                return response('Pilih periode semester terlebih dahulu.', 401);
            }
        }else{
            $start = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-01-01")) : date("Y-m-d H:i:s", strtotime("$year-07-01"));
            $end = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-06-30")) : date("Y-m-d H:i:s", strtotime("$year-12-31"));
        }

        //query dari model DetailSpt
        $data = DetailSpt::whereHas('sptUmum', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('sptUmum')
        ->where('unsur_dupak','=','penunjang')->where('user_id','=',$user_id)->get();

        return $data;
        //getDupakPenunjang
    }

    public function getLak(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        if(isset($request->semester)) {
            if($request->semester == 1) {
                $start = date("Y-m-d H:i:s", strtotime("$year-01-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-06-30"));
            }
            elseif ($request->semester == 2) {
                $start = date("Y-m-d H:i:s", strtotime("$year-07-01"));
                $end = date("Y-m-d H:i:s", strtotime("$year-12-31"));
            }else{
                return response('Pilih periode semester terlebih dahulu.', 401);
            }
        }else{
            $start = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-01-01")) : date("Y-m-d H:i:s", strtotime("$year-07-01"));
            $end = ( date('n')<=6 ) ? date("Y-m-d H:i:s", strtotime("$year-06-30")) : date("Y-m-d H:i:s", strtotime("$year-12-31"));
        }

        //setup array variabel dupak
        $dupak = [];

        //user dupak
        $dupak['user'] = User::where('id',$user_id)->first();

        //dupak pendidikan
        $q = Dupak::where('user_id', $user_id)->where('unsur_dupak','pendidikan');
        if($q->count()>1){
            $pendidikan = $q->where('status','baru');
        }else{
            $pendidikan = $q;
        }
        $dupak['pendidikan'] = $pendidikan->get();

        //dupak diklat
        $diklat = DetailSpt::whereHas('sptUmum', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('sptUmum')
        ->where('unsur_dupak','=','diklat')->where('user_id','=',$user_id)->get();
        $dupak['diklat'] = $diklat;

        //dupak pengawasan
        $pengawasan = DetailSpt::whereHas('spt', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('spt')
        ->where('unsur_dupak','=','pengawasan')->where('user_id','=',$user_id)->get();
        $dupak['pengawasan'] = $pengawasan;

        //dupak penunjang
        $penunjang = DetailSpt::whereHas('sptUmum', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('sptUmum')
        ->where('unsur_dupak','=','penunjang')->where('user_id','=',$user_id)->get();
        $dupak['penunjang'] = $penunjang;

        //dupak pengembangan profesi
        $pengembangan = DetailSpt::whereHas('sptUmum', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end])->whereNotNull('nomor');
        })->with('sptUmum')
        ->where('unsur_dupak','=','pengembangan profesi')->where('user_id','=',$user_id)->get();
        $ppm = DetailPpm::whereHas('ppm', function($q) use ($start, $end){
            $q->whereBetween('tgl_mulai',[$start,$end]);
        })->with('ppm')
        ->where('unsur_dupak','=','pengembangan profesi')->where('user_id','=',$user_id)->get();
        $pengembangan->concat($ppm);
        $dupak['pengembangan'] = $pengembangan;

        //pejabat AK
        /*$dupak['pejabat'] = User::whereHas('pejabat', function($q){
            $q->whereIn('name',['Inspektur Kabupaten','Ketua Penilai AK']);
        })->with([
            'pejabat', function($q){
                $q->select('id','name','status')->whereIn('name',['Inspektur Kabupaten','Ketua Penilai AK'])
            }])->get();*/
        $dupak['pejabat'] = Pejabat::whereIn('name',['Inspektur Kabupaten','Ketua Penilai AK'])->with(['user'=>function($q){
                    $q->select(['id', 'nip', 'first_name', 'last_name', 'gelar', 'jabatan', 'pangkat']);
                }])->get();

        return $dupak;
        
    }

    public function userPak(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        $dupak['penilai'] = ( auth()->user()->hasRole(['Super Admin', 'Tim Dupak']) ) ? true : false;
        $dupak['user'] = User::where('id',$user_id)->first();
        $dupak['pejabat'] = Pejabat::where('name','Penetap AK')->with(['user'=>function($q){
                    $q->select(['id', 'nip', 'first_name', 'last_name', 'gelar', 'jabatan', 'pangkat']);
                }])->get();
        return $dupak;
    }

    public function dupakLama(Request $request){
        $user_id = ($request->user_id) ? $request->user_id : auth()->user()->id;
        $year = ($request->tahun) ? $request->tahun : date('Y');
        //$dupak['penilai'] = ( auth()->user()->hasRole(['Super Admin', 'Tim Dupak']) ) ? true : false;
        //$dupak['user'] = User::where('id',$user_id)->first();
        $dupak['user'] = User::with(['dupak'=> function($q){
                    $q->where('status', 'lama');
                }])->where('id', $user_id)->first();
        $dupak['pejabat'] = Pejabat::where('name','Penetap AK')->with(['user'=>function($q){
                    $q->select(['id', 'nip', 'first_name', 'last_name', 'gelar', 'jabatan', 'pangkat']);
                }])->get();
        //$dupak['ak_lama'] = Dupak::where('status', 'lama')->where('user_id', $user_id)->get();DB::select('select * from users where active = ?', [1]);
        //$dupak['ak_lama'] = DB::select("select * from dupak where user_id = $user_id ");
        //dd($dupak['ak_lama']);
        return $dupak;
    }


}
