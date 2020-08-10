<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\models\Laporan_pemeriksaan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use App\models\DetailSpt;
use App\models\Spt;
use App\models\JenisSpt;
use App\models\Lokasi;
use App\models\Refrensi_kka;
use App\User;
use App\models\KodeTemuan;
use Carbon\Carbon;
use Config;
use DB, PDF;
use App\Common;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Response;
use App\models\FileMedia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class KkaController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])->except(['ProsesButtonKAA','getDataTemuan']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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

    public function ProsesButtonKAA($id)
    {
        $find = DetailSpt::find($id);
        $data = DetailSpt::where('spt_id',$find->spt_id)->get();
        return $data;
    }

    public function getDataTemuan($id){
        // dd('jalan');
        $find_spt_id = DetailSpt::find($id);
        $data_detail = DetailSpt::where('spt_id',$find_spt_id->spt_id);
        $status_anggota = DetailSpt::where('spt_id',$find_spt_id->spt_id)->where('peran','Anggota Tim')->get(); //parameter status dari data anggota tim per spt 
        $array_total = count($data_detail->get());
        // dd($array_total);
        // dd($data_detail->where('peran','Pengendali Mutu')->get()[0]->status['PengendaliMutu'] == 'revisi');

        for ($i = 0;$i <= $array_total;$i++) // ada yang kurang dalam logika, tapi hapur 50% > bisa. (updated bisa 'date:21/07/2020')
        {
            // if($i==$i && $status_anggota[0]->status['KetuaTim'] != null && $status_anggota[0]->status != null){  /*di acc ketua*/
            //     $query = $data_detail->where('peran','Anggota Tim');
            //     break;
            // }
            // elseif($i==$i && $status_anggota[0]->status['PengendaliMutu'] == null && $status_anggota[0]->status['KetuaTim'] == null && $status_anggota[0]->status['PengendaliTeknis'] == null && $status_anggota[0]->status['PenanggungJawab'] == null && $status_anggota[0]->status != null){
            //     $query = $data_detail->where('peran','Anggota Tim');
            //     break;
            // }
            // elseif ($i==$i && $status_anggota[0]->status['KetuaTim'] != null && $status_anggota[0]->status['PengendaliTeknis'] == null)
            // {
            //     $query = $data_detail->where('peran','Ketua Tim');
            //     break;
            // }
            // elseif($i==$i && $status_anggota[0]->status['PengendaliTeknis'] != null && $status_anggota[0]->status['PengendaliMutu'] == null){
            //     $query = $data_detail->where('peran','Pengendali Teknis');
            //     break;
            // }
            // elseif($i==$i && $status_anggota[0]->status['PengendaliMutu'] != null && $status_anggota[0]->status['PenanggungJawab'] == null){
            //     $query = $data_detail->where('peran','Pengendali Mutu');
            //     break;
            // }
            // elseif($i==$i && $status_anggota[0]->status['PenanggungJawab'] != null && $status_anggota[0]->status['KetuaTim'] != null && $status_anggota[0]->status['PengendaliTeknis'] != null && $status_anggota[0]->status['PengendaliMutu'] != null){
            //     $query = $data_detail->where('peran','Penanggungjawab');
            //     break;
            // }

            if($i==$i && $status_anggota[0]->status['PengendaliMutu'] == null && $status_anggota[0]->status['KetuaTim'] == null && $status_anggota[0]->status['PengendaliTeknis'] == null && $status_anggota[0]->status['PenanggungJawab'] == null && $status_anggota[0]->status != null){
                $query = $data_detail->where('peran','Anggota Tim');
                break;
            }
            elseif ($i==$i && $status_anggota[0]->status['KetuaTim'] != null && $status_anggota[0]->status['PengendaliTeknis'] == null)
            {
                $query = $data_detail->where('peran','Ketua Tim');
                break;
            }
            elseif($i==$i && $status_anggota[0]->status['PengendaliTeknis'] != null && $status_anggota[0]->status['PengendaliMutu'] == null){
                $query = $data_detail->where('peran','Pengendali Teknis');
                break;
            }
            elseif($i==$i && $status_anggota[0]->status['PengendaliMutu'] != null && $status_anggota[0]->status['PenanggungJawab'] == null){
                $query = $data_detail->where('peran','Pengendali Mutu');
                break;
            }
            elseif($i==$i && $status_anggota[0]->status['PenanggungJawab'] != null && $status_anggota[0]->status['KetuaTim'] != null && $status_anggota[0]->status['PengendaliTeknis'] != null && $status_anggota[0]->status['PengendaliMutu'] != null){
                $query = $data_detail->where('peran','Penanggungjawab');
                break;
            }
        }

        $data = $query->with('pemeriksaan')->get();
        // dd($data);
        $dt = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_temuan_id',function($col){
                    // dd($col);
                    $kode = KodeTemuan::where('id',$col->pemeriksaan[0]->kode_temuan_id)->select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
                    // $id_kode = $kode[0]->kode_kelompok +' '+ $kode[0]->deskripsi;
                    // dd($kode[0]['select_supersub_kode']. '' .$kode[0]['select_deskripsi']);
                    return $kode[0]['select_supersub_kode'];
                    // return $col->pemeriksaan[0]->kode_temuan_id;
                })
                ->addColumn('nama_anggota', function($col){
                    $user = User::findOrFail($col->user_id);
                    return $user->full_name;
                })
                ->addColumn('judultemuan', function($col){
                    return $col->pemeriksaan[0]->judultemuan;
                })
                ->addColumn('action', function($col){
                    $get_value_penanggung_jawab = DetailSpt::where('spt_id',$col->spt_id)->where('peran','Anggota Tim')->get();
                    $control = '<a href="'.route('laporan-cetak',$col->id).'" data-toggle="tooltip" title="Cetak KKA" class="btn btn-outline-danger btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    $control .= '<a href="#" onclick="showModalEditKKA('.$col->id.')" data-toggle="tooltip" title="Ubah KKA" class="btn btn btn-outline-success btn-sm"><i class="ni ni-ruler-pencil"></i></a>';
                    // if ($get_value_penanggung_jawab[0]->status['PenanggungJawab'] != null) {
                        $control .= '<a href="'.route('laporan-lhp-cetak',$col->id).'" data-toggle="tooltip" title="Cetak LHP" class="btn btn btn-outline-info btn-sm"><i class="ni ni-collection"></i></a>';
                    // }
                    // $control .= '<a href="#" data-toggle="tooltip" title="Lihat KKA Sebelumnya" class="btn btn btn-outline-warning btn-sm"><i class="ni ni-book-bookmark"></i></a>'; //buttom lihat kka
                return $control;
                })
                ->make(true);
        return $dt;
    }

    public function proses_upload(Request $request){
        // revisi daltu dalni
        // dd($request);
        if ($request->edit_kka == null) {
            $dalnis_atau_daltu = DetailSpt::where('spt_id',$request->spt_id)->where('user_id',auth()->user()->id)->get();
            $get_status_anggota = DetailSpt::where('spt_id',$request->spt_id)->where('peran','Anggota Tim')->get();
            $get_detail_id = DetailSpt::where('spt_id',$request->spt_id)->where('user_id',auth()->user()->id);
        }elseif($request->edit_kka != null){
            $dalnis_atau_daltu = DetailSpt::where('spt_id',$request->id)->where('user_id',auth()->user()->id)->get(); //get peran daltu & dalnis by auth
            $get_status_anggota = DetailSpt::where('spt_id',$request->id)->where('peran','Anggota Tim')->get(); //get data status anggota by peran
            $get_detail_id = DetailSpt::where('spt_id',$request->id)->where('user_id',auth()->user()->id);
            $data_anggota = DetailSpt::where('spt_id',$request->id)->where('peran','Anggota Tim');
        }
        $kode = $request->file_laporan['kode_temuan_id'];
        $sasaran = $request->file_laporan['sasaran_audit'];
        $judultemuan = $request->file_laporan['judultemuan'];
        $jenis_laporan = 'KKA';
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();
        $kondisi = json_encode($request->file_laporan['kondisi']);
        $kriteria = json_encode($request->file_laporan['kriteria']);

        // dd(str_replace('&nbsp;', ' ', preg_replace('/<[^>]*>|"/', '', $request->file_laporan['kondisi'])));
        // die();

        if ($dalnis_atau_daltu[0]->peran == 'Anggota Tim' && $get_status_anggota[0]->status == null) {
           
            $jenis_laporan = 'KKA';//proses insert anggota tim

            $status_anggota['KetuaTim'] = null; //status anggota default
            $status_anggota['PengendaliTeknis'] = null;
            $status_anggota['PengendaliMutu'] = null;
            $status_anggota['PenanggungJawab'] = null;
            
            // $kondisi_anggota = str_replace('&nbsp;', ' ', preg_replace('/<[^>]*>|"/', '', $request->file_laporan['kondisi']));  <!--menghilangkan css dari summernote dan gambar inputan untuk pemakaian kurang recom-->
            // $kriteria_anggota = str_replace('&nbsp;', ' ', preg_replace('/<[^>]*>|"/', '', $request->file_laporan['kriteria']));

            $update_anggota = $get_detail_id->update(['jenis_laporan'=>$jenis_laporan,'status'=>json_encode($status_anggota)]);
            $kriteria = Laporan_pemeriksaan::insert(['detail_spt_id'=>$get_detail_id->get()[0]->id,'kode_temuan_id'=>$kode,'sasaran_audit'=>$sasaran,'judultemuan'=>$judultemuan,'kondisi'=>$kondisi,'kriteria'=>$kriteria,'created_at'=>$created_at,'updated_at'=>$updated_at]);
            $find_spt_id = Spt::findOrFail($request->spt_id);
            $get_jenis_lokasi = Lokasi::findOrFail(json_decode($find_spt_id->lokasi_id[0]));
            $Refrensi_kka = Refrensi_kka::insert(['refrensi_lokasi'=>$get_jenis_lokasi->jenis_lokasi,'refrens_kka'=>$request->file_laporan['kondisi']]);

            return redirect()->back()->with('alert', 'Anda telah berhasil mengubah KKA tersebut');
        }
        elseif($dalnis_atau_daltu[0]->peran == 'Ketua Tim' && $get_status_anggota[0]->status['KetuaTim'] == null){
            $status['KetuaTim']= 'revisi';//proses revisi ketua tim
            
            $status_anggota['KetuaTim'] = auth()->user()->id; //nilai status yg melakukan revisi bedasarkan auth id
            $status_anggota['PengendaliTeknis'] = null;
            $status_anggota['PengendaliMutu'] = null;
            $status_anggota['PenanggungJawab'] = null;

            $update_ketua = $get_detail_id->update(['jenis_laporan'=>$jenis_laporan,'status'=>json_encode($status)]); //update ketua tim yg sedang merevisi/mengedit di detail tabel
            $update_anggota = $data_anggota->where('peran','Anggota Tim')->update(['status'=>json_encode($status_anggota)]);//update status anggota
            $insert_ketua = Laporan_pemeriksaan::insert(['detail_spt_id'=>$get_detail_id->get()[0]->id,'kode_temuan_id'=>$kode,'sasaran_audit'=>$sasaran,'judultemuan'=>$judultemuan,'kondisi'=>$kondisi,'kriteria'=>$kriteria,'created_at'=>$created_at,'updated_at'=>$updated_at]);//insert laraporan bedasarkan id detail
            return redirect()->back()->with('alert', 'Anda telah berhasil mengubah KKA tersebut');
        }
        elseif ($get_status_anggota[0]->status['PengendaliTeknis'] == null && $dalnis_atau_daltu[0]->peran == 'Pengendali Teknis') { //proses revisi dalnis
            $status['PengendaliTeknis']= 'revisi';

            $status_anggota['KetuaTim'] = $get_status_anggota[0]->status['KetuaTim']; //nilai status yg melakukan revisi bedasarkan auth id
            $status_anggota['PengendaliTeknis'] = auth()->user()->id;
            $status_anggota['PengendaliMutu'] = null;
            $status_anggota['PenanggungJawab'] = null;

            $update_dalnis = $get_detail_id->update(['jenis_laporan'=>$jenis_laporan,'status'=>json_encode($status)]);//update dalnis yg sedang merevisi/mengedit di detail tabel
            $update_anggota = $data_anggota->where('peran','Anggota Tim')->update(['status'=>json_encode($status_anggota)]);//update status anggota
            $insert_dalnis = Laporan_pemeriksaan::insert(['detail_spt_id'=>$get_detail_id->get()[0]->id,'kode_temuan_id'=>$kode,'sasaran_audit'=>$sasaran,'judultemuan'=>$judultemuan,'kondisi'=>$kondisi,'kriteria'=>$kriteria,'created_at'=>$created_at,'updated_at'=>$updated_at]);  
        }
        elseif ($get_status_anggota[0]->status['PengendaliTeknis'] != null && $get_status_anggota[0]->status['PengendaliMutu'] == null && $dalnis_atau_daltu[0]->peran == 'Pengendali Mutu') { //proses revisi dalnis
            $status['PengendaliMutu']= 'revisi';//proses revisi Pengendali Mutu

            $status_anggota['KetuaTim'] = $get_status_anggota[0]->status['KetuaTim']; 
            $status_anggota['PengendaliTeknis'] = $get_status_anggota[0]->status['PengendaliTeknis'];
            $status_anggota['PengendaliMutu'] = auth()->user()->id; //nilai status yg melakukan revisi bedasarkan auth id
            $status_anggota['PenanggungJawab'] = null;

            $update_daltu = $get_detail_id->update(['jenis_laporan'=>$jenis_laporan,'status'=>json_encode($status)]);//update daltu yg sedang merevisi/mengedit di detail tabel
            $update_anggota = $data_anggota->where('peran','Anggota Tim')->update(['status'=>json_encode($status_anggota)]);//update status anggota
            $insert_daltu = Laporan_pemeriksaan::insert(['detail_spt_id'=>$get_detail_id->get()[0]->id,'kode_temuan_id'=>$kode,'sasaran_audit'=>$sasaran,'judultemuan'=>$judultemuan,'kondisi'=>$kondisi,'kriteria'=>$kriteria,'created_at'=>$created_at,'updated_at'=>$updated_at]);  
        }
        elseif ($get_status_anggota[0]->status['PengendaliTeknis'] != null && $get_status_anggota[0]->status['PengendaliMutu'] != null && $get_status_anggota[0]->status['PenanggungJawab'] == null && $dalnis_atau_daltu[0]->peran == 'Penanggungjawab') { //proses revisi Penanggung jawab
            // dd('berhasil');
            $status['PenanggungJawab']= 'revisi';

            $status_anggota['KetuaTim'] = $get_status_anggota[0]->status['KetuaTim']; 
            $status_anggota['PengendaliTeknis'] = $get_status_anggota[0]->status['PengendaliTeknis'];
            $status_anggota['PengendaliMutu'] = $get_status_anggota[0]->status['PengendaliMutu']; //nilai status yg melakukan revisi bedasarkan auth id
            $status_anggota['PenanggungJawab'] = auth()->user()->id;

            $update_penanggung_jawab = $get_detail_id->update(['jenis_laporan'=>$jenis_laporan,'status'=>json_encode($status)]);
            $update_anggota = $data_anggota->where('peran','Anggota Tim')->update(['status'=>json_encode($status_anggota)]);
            $insert_penanggung_jawab = Laporan_pemeriksaan::insert(['detail_spt_id'=>$get_detail_id->get()[0]->id,'kode_temuan_id'=>$kode,'sasaran_audit'=>$sasaran,'judultemuan'=>$judultemuan,'kondisi'=>$kondisi,'kriteria'=>$kriteria,'created_at'=>$created_at,'updated_at'=>$updated_at]);  
        }
    }

    public function cetakLaporan($id) /*cetak kka*/
    {
        // dd($id);
        //stream pdf by spt_id
        $Laporan = DetailSpt::findOrFail($id);
        $getNameUser = User::findOrFail($Laporan->user_id); //user yg membuat laporan
        $getdataall = DetailSpt::where('spt_id',$Laporan->spt_id);
        $getPenyetujuLaporan = User::findOrFail($getdataall->where('peran','Pengendali Teknis')->get()[0]->user_id);
        
        $getdaltu = DetailSpt::where('spt_id',$getdataall->where('peran','Pengendali Teknis')->get()[0]->spt_id)->where('peran','Pengendali Mutu')->get(); //get data pengendali mutu
        // dd($getdaltu);
        $getSPT = Spt::where('id',$Laporan->spt_id)->get();

        $isiLaporan = Laporan_pemeriksaan::where('detail_spt_id',$Laporan->id)->get();
        $selected_kode_kka = KodeTemuan::where('id',$isiLaporan[0]->kode_temuan_id)->select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        
        $pdf =PDF::loadView('admin.laporan.kka.index', ['Laporan'=>$Laporan,'getNameUser'=>$getNameUser,'getPenyetujuLaporan'=>$getPenyetujuLaporan,'getSPT'=>$getSPT,'isiLaporan'=>$isiLaporan,'getdaltu'=>User::findOrFail($getdaltu[0]->user_id),'kode_temuan'=>$selected_kode_kka]);
        return $pdf->stream('LaporanAuditor-'.$id.'.pdf',array('Attachment'=>1));

    }

    public function cetakLhp($id)
    {// belum bisa mengambil semua kka
        $getdata = DetailSpt::where('id',$id)->with('pemeriksaan','spt')->get();
        $data_detail = $getdata[0];
        $data_pemeriksaan = $getdata[0]->pemeriksaan;
        $data_spt = $getdata[0]->spt;
        $data_lokasi = Lokasi::find($data_spt['lokasi_id'][0]);
        $data_jenis_spt = JenisSpt::findOrFail($getdata[0]->spt->jenis_spt_id);
        // dd($data_spt->created_at);

        // return view('admin.laporan.lhp.index',compact('data_pemeriksaan','data_detail','data_spt','data_jenis_spt','data_lokasi'));
        $pdf =PDF::loadView('admin.laporan.lhp.index',['data_pemeriksaan'=>$data_pemeriksaan,'data_detail'=>$data_detail,'data_spt'=>$data_spt,'data_jenis_spt'=>$data_jenis_spt,'data_lokasi'=>$data_lokasi]);
        return $pdf->stream('LHP-'.$id.'.pdf',array('Attachment'=>1));
    }

    public function uploadKKA($id)//proses unggah ketua tim
    {
        // dd('berhasil bisa berjalan');
        $cekDetail_id = DetailSpt::where('id',$id);
        $findSptSame = DetailSpt::where('spt_id',$cekDetail_id->get()[0]->spt_id); //get semua user yg terkait dengan spt
        $cekKKA = $findSptSame->where('peran','Anggota Tim');
        foreach ($cekKKA->get() as  $status_data_anggota)
        {
            $id_ketua_tim = json_encode($status_data_anggota->status['KetuaTim']);
        }
        // dd($id_ketua_tim);
        $data['KetuaTim'] =  auth()->user()->id;
        $data['PengendaliTeknis'] = null;
        $data['PengendaliMutu'] = null;
        $data['PenanggungJawab'] = null;
        if ($id_ketua_tim == "null") {
            $update = $cekKKA->update(['status'=>json_encode($data),'jenis_laporan'=>'KKA']);
            return redirect('admin');
        }else{
            return redirect()->back()->with('alert', 'Anda sudah mengupload KKA tersebut');
        }
    }

    public function Penyetujuan_daltu_dalnis($id) //parameter id berisikan id detail_spt "proses acc daltu dalnis"
    {
        // find data detail spt by id dari paramter
        $find_spt_id = DetailSpt::find($id);
        // get data anggota tim untuk di update statusnya
        $get_data_anggota = DetailSpt::where('spt_id',$find_spt_id->spt_id)->where('peran','Anggota Tim');
        // select detail by spt
        $get_peran = DetailSpt::where('spt_id',$find_spt_id->spt_id);

        foreach ($get_data_anggota->get() as  $status_data_anggota)
        {
            $id_ketua_tim = json_encode($status_data_anggota->status['KetuaTim']);
        }
        // kondisi pengecekkan apakah pengendali teknis sudah mengisikan apa belum " note : digunakan bila mana button tidak dihilangkan jika dihilangkan maka ini tidak berfungsi"
        if ($status_data_anggota->status['PengendaliTeknis'] == null && $get_peran->where('user_id',auth()->user()->id)->get()[0]->peran == 'Pengendali Teknis') { //agar tidak mengupload double //Pengendali Teknis acc
            if ($id_ketua_tim != null) {

                // berisikan id ketua tim
                $status['KetuaTim'] = json_decode($id_ketua_tim);
                // berisikan id pengendali teknis
                $status['PengendaliTeknis'] = auth()->user()->id;

                $status['PengendaliMutu'] = null;
                $status['PenanggungJawab'] = null;
                // update detail spt
                $update = $get_data_anggota->update(['status'=>json_encode($status)]);
                return redirect('admin');
            }
        }else if($status_data_anggota->status['KetuaTim'] != null && $status_data_anggota->status['PengendaliTeknis'] != null && $get_peran->where('user_id',auth()->user()->id)->get()[0]->peran != 'Pengendali Teknis' && $get_peran->where('user_id',auth()->user()->id)->get()[0]->peran == 'Pengendali Mutu'){ 
            //kondisi acc pengendali mutu
            // array status berisikan data2 yg meng acc kka
            $status['KetuaTim'] = json_decode($id_ketua_tim);
            $status['PengendaliTeknis'] = json_decode(json_encode($status_data_anggota->status['PengendaliTeknis']));
            $status['PengendaliMutu'] = auth()->user()->id;
            $status['PenanggungJawab'] = null;

            if ($status_data_anggota->status['PengendaliMutu'] == null) {//agar tidak mengupload double
                $update = $get_data_anggota->update(['status'=>json_encode($status)]);
                return redirect('admin');
            }else{
                return redirect()->back()->with('alert', 'Anda sudah menyetujui KKA tersebut');
            }
        }else{
            return redirect()->back()->with('alert', 'Anda sudah menyetujui KKA tersebut');
        }
    }

    public function Penyetujuan_penanggungjawab($id) // "proses acc penanggung jawab"
    {
        // dd($id);
        // id penanggung jawab
        $data_penanggungjawab = DetailSpt::findOrFail($id);
        $data_anggota = DetailSpt::where('spt_id',$data_penanggungjawab->spt_id)->where('peran','Anggota Tim');
        // dd($data_anggota->get()[0]->status['PenanggungJawab'] == null);
        if ($data_anggota->get()[0]->status['PenanggungJawab'] == null && $data_penanggungjawab->user_id == auth()->user()->id) {
            // dd("acc penanggung jawab");
            $status['KetuaTim'] = $data_anggota->get()[0]->status['KetuaTim'];
            $status['PengendaliTeknis'] = $data_anggota->get()[0]->status['PengendaliTeknis'];
            $status['PengendaliMutu'] = $data_anggota->get()[0]->status['PengendaliMutu'];
            $status['PenanggungJawab'] = auth()->user()->id;
            // dd($status);
            $data_anggota->update(['status'=>json_encode($status)]);
            return redirect()->back();
        }else{
            return redirect()->back()->with('alert', 'anda telah menyetujui kka tersebut');
        }
    }

    public function getEditKodeTemuanKKA($id)
    {
        $laporan_pemeriksaan = Laporan_pemeriksaan::where('detail_spt_id',$id)->get();
        $data['data_kka'] = DB::table('detail_spt')
                ->join('laporan_pemeriksaan', 'detail_spt.id', '=', 'laporan_pemeriksaan.detail_spt_id')
                ->join('spt','detail_spt.spt_id','=','spt.id')
                ->join('jenis_spt','spt.jenis_spt_id','=','jenis_spt.id')
                ->where('detail_spt.id','=',$id)
                ->select('detail_spt.id as id_detail','nomor','kode_kelompok','sebutan','kode_temuan_id','sasaran_audit','judultemuan','kondisi','kriteria','spt_id')
                ->get();
        $data['selected_kode_kka'] = KodeTemuan::where('id',$laporan_pemeriksaan[0]->kode_temuan_id)->select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        $data['get_kode_temuan'] = KodeTemuan::select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        // dd($data);
        return $data;
    }

    public function InputKka($id)
    {
        $userid = auth()->user()->id;
        //berfungsi mengecek tb detail spt kolom file laporan kosong atau tidak
        $cek_radiobutt = DetailSpt::findOrFail($id);
        if($cek_radiobutt->file_laporan == null){
            $cek_radiobutts = 'disabledleforfile';
        }

        $id_lokasi_in_spt = Spt::where('id',$cek_radiobutt->spt_id)->get();
        $get_lokasi = Lokasi::where('id',$id_lokasi_in_spt[0]->lokasi_id)->get();

        $refrensi = Refrensi_kka::where('refrensi_lokasi',$get_lokasi[0]->jenis_lokasi)->get();
        $kode = KodeTemuan::select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        $spt = DetailSpt::where('id',$id)->get();
        return view('admin.spt.form_input_kka',['spt'=>$spt,'cek_radiobutts'=>$cek_radiobutts,'kode'=>$kode,'refrensi'=>$refrensi]);
    }

    public function InputLhp($id)
    {
        // dd($id); id berisikan id detail spt
        $userid = auth()->user()->id;
        $get_spt_id = DetailSpt::findOrFail($id);
        $kode = KodeTemuan::select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        $get_laporan_all_by_spt_id = DetailSpt::where('spt_id',$get_spt_id->spt_id)->with('user')->get();
        // dd($get_laporan_all_by_spt_id);
        $spt = Spt::where('id',$get_spt_id->spt_id)->get();
        $get_jenis_spt = JenisSpt::findOrFail($spt[0]->jenis_spt_id);
        // dd($get_jenis_spt);
        $lokasi = Lokasi::where('id',json_decode($spt[0]->lokasi_id[0]))->get();
        $data_Laporan = DB::table('detail_spt')
                        ->where('spt_id','=',$get_spt_id->spt_id)
                        ->join('laporan_pemeriksaan','detail_spt.id','=','laporan_pemeriksaan.detail_spt_id')
                        ->where('peran','=','Anggota Tim')
                        // ->select('')
                        ->get();

        return view('admin.lhp.form_input_lhp',['kode'=>$kode,'spt'=>$spt,'lokasi'=>$lokasi,'data_pemeriksaan'=>$data_Laporan,'data_jenis_spt'=>$get_jenis_spt/*,'data_ttd'=>$get_laporan_all_by_spt_id*/]);
    }
}
