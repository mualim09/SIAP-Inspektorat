<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, PDF;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\View;
use App\User, App\models\Sertifikat;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File; 

class SertifikatController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'role:Super Admin|TU Umum|Auditor'])->except(['search','show','getData','getSertifikatUsers','deleteSertifikat']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
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

    public function viewProfile()
    {        
        $profile = User::findOrFail(auth()->user()->id)->profile;
        
        
        return view('profile.edit')->with('profile',$profile);
    }


    public function getSertifikatUsers()
    {
        $sertifikat = Sertifikat::where('user_id',auth()->user()->id)->get();
        // dd($sertifikat);

        $data = Datatables::of($sertifikat)
                ->addIndexColumn()
                ->addColumn('nama_sertifikat', function($data){
                    return $data->nama_sertifikat;
                })
                ->addColumn('created_at', function($data){
                    return $data->created_at->format('d-M-Y');
                })
                ->addColumn('name', function($data){
                    foreach (User::where('id',$data->uploaded_by)->get() as $user) {
                        return $user->full_name;
                    }
                })
                ->addColumn('action', function($data){
                    $control = '';
                    // megecek status akses 1 sama dengan off akses 
                    // if ($data->status_akses == 1) { 
                        // mengecek file sertifikat jika ada .pdf maka tampil file pdf
                        // if(preg_match("/pdf/i", $data->file_sertifikat)) {
                        //     // button yang off
                        //     $control = '<a href='.$data->file_sertifikat.' target="_blank" data-toggle="tooltip" title="Lihat File Sertifikat" class="btn btn-secondary" style="pointer-events: none; color: #ccc;"><i class="fa fa-file-pdf"></i></a>';
                        //     $control .= '<a href="#" onclick="hapus_sertifkat('.$data->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-secondary" style="pointer-events: none; color: #ccc;"><i class="ni ni-fat-remove"></i></a>';

                        // }else{
                        //     $control .= '<a href="#" onclick="showModalLihatSertifikatbyUser('.$data->id.')" data-toggle="tooltip" title="Lihat Gambar Sertifikat" class="btn btn-secondary" style="pointer-events: none; color: #ccc;"><i class="ni ni-image"></i></a>';
                        //     $control .= '<a href="#" onclick="hapus_sertifkat('.$data->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-secondary" style="pointer-events: none; color: #ccc;"><i class="ni ni-fat-remove"></i></a>';
                        // }
                    // }else{
                        // button yg on
                        if(preg_match("/pdf/i", $data->file_sertifikat)) {
                            $control .= '<a href='.$data->file_sertifikat.' target="_blank" data-toggle="tooltip" title="Lihat File Sertifikat" class="btn btn-success"><i class="ni ni-archive-2"></i></a>';
                            $control .= '<a href="#" onclick="hapus_sertifkat('.$data->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-danger"><i class="ni ni-fat-remove"></i></a>';

                        }else{
                            $control .= '<a href="#" onclick="showModalLihatSertifikatbyUser('.$data->id.')" data-toggle="tooltip" title="Lihat Gambar Sertifikat" class="btn btn-success"><i class="ni ni-image"></i></a>';
                            $control .= '<a href="#" onclick="hapus_sertifkat('.$data->id.')" data-toggle="tooltip" title="Hapus" class="btn btn-danger"><i class="ni ni-fat-remove"></i></a>';
                        }
                    // }
                    return $control;
                    // $url = $data;
                })
                ->make(true);
        return $data;
    }

    public function dataSertifikat($id)
    {
        $dataSertifikat = Sertifikat::where('id', $id)->get();
        // dd($dataSertifikat[0]->file_sertifikat);
        // $files = Storage::disk('sertifikat_user');
        // dd($file);
        return $dataSertifikat;
    }

    public function storeSertifikat(Request $request) //insert multiple sertifikat image
    {
        // foreach ($request->file_sertifikat as $sertifikat ) { /*coba diubah simpan ke storage bukan public*/
        //     $file = $sertifikat;
        //     $filename = $sertifikat->getClientOriginalName();
        //     // generate a new filename. getClientOriginalExtension() for the file extension
        //     $filename = 'sertifikat-'. $filename;

        //     // save to storage/app/photos as the new $filename
        //     $path = $file->storeAs('sertifikat', $filename);

        //     $sertifikat->move(public_path('storage\sertifikat'),$path);

        //     $data = new sertifikat(); //save file sertifikat to database
        //     $data->user_id = $request->userid;
        //     $data->file_sertifikat = ($filename !== null ) ? url('storage/sertifikat/'.$filename) : null;
        //     $data->nama_sertifikat = $filename;
        //     // $data->file_sertifikat = $path;
        //     $data->uploaded_by = auth()->user()->id;
        //     // dd($data);
        //     $data->save();
        //     die();
        // }

        if ($request->hasFile('file_sertifikat')) {
            
            foreach ($request->file_sertifikat as $sertifikat ) {

                $filename = $sertifikat->getClientOriginalName(); /*dirubah ke store seharusnya*/

                $path = $sertifikat->move(public_path('storage\sertifikat_auditor') , $filename);

                $data = new sertifikat(); //save file sertifikat to database
                $data->user_id = $request->userid;
                $data->nama_sertifikat = $filename;
                $data->file_sertifikat = ($filename !== null ) ? url('storage/sertifikat_auditor/'.$filename) : null;
                $data->uploaded_by = auth()->user()->id;
                $data->save();
            }

        }

        return back()->with('success', 'Your sertifikat has been successfully');
    }

    public function editSertifikat(Request $request) //insert multiple sertifikat image
    {   
        $id_Auditor = Sertifikat::findOrFail($request->id_sertifikat);
        // dd($request->file_sertifikat2);
        $filename = $request->file_sertifikat2->getClientOriginalName();
        $path = $request->file_sertifikat2->move(public_path('storage\sertifikat_auditor') , $filename);
        $delete = File::delete($id_Auditor->file_sertifikat);

        $id_Auditor['nama_sertifikat'] = $filename;
        $id_Auditor['file_sertifikat'] = ($filename !== null ) ? url('storage/sertifikat_auditor/'.$filename) : null;
        $id_Auditor->save();

        return back()->with('success', 'Your sertifikat has been successfully');
    }

    public function deleteSertifikat($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $delete = File::delete($sertifikat->file_sertifikat);
        // $delete = unlink($sertifikat->file_sertifikat);
        return ($sertifikat->delete()) ? 'deleted' :'no data';

    }

    public function getdataSertifikatUsers($id)
    {
        $getUsers = Sertifikat::where('user_id',$id)->orderBy('created_at', 'ASC')->get();
        return $getUsers;
    }


}
