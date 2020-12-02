<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB, PDF;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User, App\Common, App\models\Dupak,App\models\Sertifikat;
use Yajra\DataTables\DataTables;
use Redirect,Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\View;
use File;
//Enables us to output flash messaging
use Session;

class UserController extends Controller
{
    private $list_jabatan = ['Inspektur Kabupaten', 'Sekertaris', 'Inspektur Pembantu Wilayah I', 'Inspektur Pembantu Wilayah II', 'Inspektur Pembantu Wilayah III', 'Inspektur Pembantu Wilayah IV', 'Auditor Utama', 'Auditor Madya', 'Auditor Muda', 'Auditor Pertama', 'Auditor Penyelia', 'Auditor Pelaksana Lanjutan', 'Auditor Pelaksana', 'Auditor', 'PENGOLAH DATA','Staff / Fungsional', 'Kasubag Evaluasi dan Pelaporan', 'Kasubag Perencanaan', 'Kasubag Administrasi dan Umum', 'Pengadministrasi Umum'];

    private $list_pangkat = ['I/A', 'I/B', 'I/C', 'I/D', 'II/A', 'II/B', 'II/C', 'II/D', 'III/A', 'III/B', 'III/C', 'III/D', 'IV/A', 'IV/B', 'IV/C', 'IV/D'];
    
    private $list_pendidikan = ['Sekolah Menengah Atas (SMA)','Diploma 1 (D1)','Diploma 2 (D2)', 'Diploma 3 (D3)','Diploma 4 (D4)','Sarjana (S1)','Pasca Sarjana (S2)','Doktor (S3)'];

    private $listRuang = ['IRBAN I', 'IRBAN II', 'IRBAN III', 'IRBAN IV'];
    private $listJabatanRuang = ['kepala', 'anggota'];



    public function __construct() {
        $this->middleware(['auth', 'role:Super Admin|TU Umum'])->except(['search','show','getData']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

   /* public function init(){
        $columns = [
            ''
        ];
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::active()->get();
        $users = User::where(function ($q){
            $q->active();
        })
        ->where(function ($q){
            $q->member();
        })
        ->get();
        $roles = ( auth()->user()->hasPermissionTo('Administer roles & permissions') ) ? Role::all() : Role::whereNotIn('name', ['Super Admin'])->get();
        return view('admin.user.index', ['roles'=>$roles, 'listJabatan' => $this->list_jabatan, 'listPangkat'=>$this->list_pangkat, 'listPendidikan'=>$this->list_pendidikan, 'listRuang'=>$this->listRuang, 'listJabatanRuang'=>$this->listJabatanRuang]);
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
       

        $validator = Validator::make($request->all(), [
            'first_name'=>'required|string|max:255|min:3',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'phone' =>'string',
            'last_name'=>'string',
            'email' =>'required|email|max:255|min:3|unique:users',
            'password'=>'required|min:6|confirmed',
            'nip' => 'required|unique:users',
            'jabatan' => 'string',
            'pangkat' => 'string',
            'gelar' => 'string',
            'sex' => 'required',
            'image' => 'mimes:jpeg,jpg,JPG,JPEG',
            'jenis_auditor' => 'string',
            'tempat_lahir' => 'string',
            'tanggal_lahir'=>'date_format:"d-m-Y"',
        ]);

        if ($validator->fails()){
            return $validator->errors();
        }

        
        

        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'pendidikan' => $request['pendidikan'],
            'sex' => $request['sex'],
            'password' => $request['password'],
            'nip' => $request['nip'],
            'jabatan' => $request['jabatan'],
            'pangkat' => $request['pangkat'],
            'gelar' => $request['gelar'],
            'ruang' => $request['ruang'],
            //'sertifikat' => $request['sertifikat'],
            'jenis_auditor' => $request['jenis_auditor'],
            'tempat_lahir' => $request['tempat_lahir'],
            'tanggal_lahir' => date('Y-m-d',strtotime($request['tanggal_lahir'])),
        ];
        $nama_ruang = $request['ruang']['nama'];
        $jabatan_ruang = $request['ruang']['jabatan'];
        

        $cek_irban = User::where('ruang->nama', $nama_ruang)->where('ruang->jabatan', 'kepala')->get();

        if($cek_irban->count() > 0 && $jabatan_ruang == 'kepala'){
            return 'Error! Jabatan Kepala '.$nama_ruang.' sudah diisi ';
        }else{
            $user = User::create($data);
        }

        if($user->jenis_auditor != null){ 
            $this->updateDupakPendidikan($user->id,'lama');

        }          

        $roles = $request['roles'];
        if(isset($roles)){
            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
            }
        }
        return $user;
    }

    public function storeSertifikat(Request $request) //insert multiple sertifikat image
    {
        if ($request->hasFile('file_sertifikat')) {
            
            foreach ($request->file_sertifikat as $sertifikat ) {

                $filename = $sertifikat->getClientOriginalName();

                $urlSertifikat = $sertifikat->store('sertifikat_auditor'); //save ke folder public\sertifikat_auditor 

                $data = new sertifikat(); //save file sertifikat to database
                $data->user_id = $request->userid;
                $data->nama_sertifikat = $filename;
                $data->file_sertifikat = $urlSertifikat;
                $data->save();
            }

        }

        return back()->with('success', 'Your sertifikat has been successfully');
    }   

    public function deleteSertifikat($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $delete = unlink($sertifikat->file_sertifikat);
        return ($sertifikat->delete()) ? 'deleted' :'no data';
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
        $user = User::find($id);
        $roles = $user->roles;
        return $user;
        return $roles;
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
        $user = User::findOrFail($id);//Get role with the given id

        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->phone = $request['phone'];
        $user->email = $request['email'];
        $user->pendidikan = $request['pendidikan'];
        $user->sex = $request['sex'];
        $user->password = $request['password'];
        $user->nip = $request['nip'];
        $user->jabatan = $request['jabatan'];
        $user->pangkat = $request['pangkat'];
        $user->gelar = $request['gelar'];
        //$user->sertifikat = $request['sertifikat'];
        $user->jenis_auditor = $request['jenis_auditor'];
        $user->tempat_lahir = $request['tempat_lahir'];
        $user->tanggal_lahir = date('Y-m-d',strtotime($request['tanggal_lahir']));
        //ruang dan jabatan irban
        $nama_ruang = $request['ruang']['nama'];
        $jabatan_ruang = $request['ruang']['jabatan'];
        

        $cek_irban = User::where('ruang->nama', $nama_ruang)->where('ruang->jabatan', 'kepala')->get();
        //return $cek_irban->count();

        if($cek_irban->count() > 0 && $jabatan_ruang == 'kepala'){
            $return = "jabatan kepala ".$nama_ruang." sudah diisi";
        }else{            
            $user->ruang = $request['ruang'];
            $return = $nama_ruang ." sebagai ".$jabatan_ruang;
        }

        $roles = $request['roles'];
        $user->save();

        if(in_array($user->jenis_auditor,['ahli','terampil'])){
            $this->updateDupakPendidikan($user->id,'baru');
        }
        

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

        return 'User '. $user->full_name.' updated! with '. $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyz($id)
    {
        $user = User::findOrFail($id); 
        return ($user->delete()) ? 'deleted' :'no data';
    }

    public function destroy($id){
        $user = User::findOrFail($id); 
        $user->user_status = 'nonaktif';
        $user->save();
    }

    public function getData()
    {
        //$users = User::active()->get();
        $users = User::where(function ($q){
            $q->active();
        })
        ->where(function ($q){
            $q->member();
        })
        ->get();
        //dd($users);
        return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('full_name', function($user){
                    return $user->full_name;
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d/m/Y H:i:s');
                })
                ->addColumn('ruang_jabatan', function($user){
                    return (isset($user->ruang['nama'])) ? $user->ruang_jabatan : '-';
                })
                //->removeColumn(['password','remember_token'])
                ->addColumn('pendidikan', function($user){
                    return ($user->pendidikan['tingkat']);
                })
                ->addColumn('action', function($user){                    
                    return $this->buildControl($user->id);
                })->make(true);               
    }

    public function buildControl($id){
        $user = auth()->user();
        $control = '';
        if($user->hasAnyRole(['TU Umum','Super Admin'])){
            $control .= '<a href="javascript:void(0);" onclick="editForm('. $id .')" data-toggle="tooltip" title="Edit Pegawai" class="btn btn-outline-primary btn-sm"><i class="ni ni-single-copy-04"></i></a>';
            $control .= '<a href="javascript:void(0);" onclick="deleteData('. $id .')" data-toggle="tooltip" title="Nonaktifkan Pegawai" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
            $control .= '<a href="#" onclick="showModalLihatSertifikat('.$id.')" data-toggle="tooltip" title="Lihat Sertifikat" class="btn btn-outline-success btn-sm"><i class="ni ni-paper-diploma"></i></a>';
            $control .= '<a href="javascript:void(0);" onclick="insertSertifikat('. $id .')" data-toggle="tooltip" title="Input Sertifikat" class="btn btn-outline-warning btn-sm"><i class="ni ni-single-copy-04"></i></a>';
        }

        return $control;
    }

    public function search($select=null){
        $users = User::select('id')->get();
    }

    public function getAuditor(Request $request){
        $user = User::select('id', DB::raw('CONCAT(first_name, " ", last_name, " ", gelar) AS name'))->whereNotNull('jenis_auditor');
        return $user->get()->toJson();
    }

    public function updateDupakPendidikan($user_id, $status = null){
        $user = User::findOrFail($user_id);
        $jenis_auditor = $user->jenis_auditor;
        $tingkat = $user->pendidikan['tingkat'];
        $unsur_dupak = 'pendidikan';
        
        switch($jenis_auditor){
            case 'ahli':
             if (in_array($tingkat, ['Diploma 4 (D4)','Sarjana (S1)'])){ $dupak = 100; } 
                elseif($tingkat == 'Pasca Sarjana (S2)') {$dupak = 150;}
                elseif($tingkat = 'Doktor (S3)'){$dupak = 200;}
                else{$dupak = 0;}
                break;
            case 'terampil':
                if(in_array($tingkat, ['Diploma 4 (D4)','Sarjana (S1)'])){ $dupak = 100; }
                elseif($tingkat == 'Diploma 3 (D3)'){$dupak = 60;}
                else{$dupak=0;}
                break;
        }
        $dupak_pendidikan = Dupak::where('unsur_dupak','=','pendidikan')->where('user_id',$user_id)->where('status',$status)->first();
        if(!isset($dupak_pendidikan)){
            Dupak::create(['user_id'=>$user_id, 'unsur_dupak'=>$unsur_dupak, 'dupak'=>$dupak,'status'=>$status]);
        }else{
            $input = ['dupak'=>$dupak,'unsur_dupak'=>$unsur_dupak,'status'=>$status];
            $dupak_pendidikan->fill($input)->save();
        }
        
    }

    
}
