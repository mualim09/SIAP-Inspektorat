<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\JenisSpt;
use App\User, App\Common;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Redirect,Response;

class JenisSptController extends Controller
{
   
    public function __construct() {
        $this->middleware(['auth', 'spt'])->except('index','getAnggota'); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JenisSpt::all();
        $listAnggota = User::select(['id','first_name','last_name'])->get();
        $listPeran = ['Penanggung Jawab', 'Pembantu Penanggung jawab','Supervisor','Pengendali Mutu', 'Pengendali Teknis', 'Ketua Tim', 'Anggota Tim'];
        return view('admin.spt.jenis.index')->with([
            'data'=>$data,
            'listAnggota' => $listAnggota,
            'listPeran' => $listPeran
        ]); 
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
        $this->validate($request,[
            'sebutan' => 'string|min:3|max:191',
            'name' => 'string|nullable',
            'dasar' => 'string|nullable',
            //'isi' => 'required|string|min:10',
            //'kategori' => 'required|string|min:5',
            'kode_kelompok' => 'required|string|min:3|max:20',
            'input' => 'nullable',
            'radio' => 'nullable'

        ]);

        $user = auth()->user();
        //$kategori = ( $user->hasAnyRole(['TU Perencanaan','Super Admin']) ) ? 'pengawasan' : ( $user->hasAnyRole(['TU Umum']) ) ? 'umum' : null; //aktifkan jika ingin menggunakan fitur spt bag umum
        $kategori = ( $user->hasAnyRole(['TU Perencanaan','Super Admin']) ) ? 'pengawasan' : null;

        $data = [
            'name' => Common::cleanInput($request->name),
            'sebutan' => Common::cleanInput($request->sebutan),
            'dasar' => Common::cleanInput($request->dasar),
            'kode_kelompok' => Common::cleanInput($request->kode_kelompok),
            'input' => $request->input,
            'radio' => $request->radio,
            'kategori' => $kategori
        ];

        //$jenisSpt = JenisSpt::create($request->all());
        $jenisSpt = JenisSpt::create($data);
        return $jenisSpt;
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
        $cols = JenisSpt::findOrFail($id);
        return $cols;
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
        $jenis_spt = JenisSpt::findOrFail($id);
        $this->validate($request,[
            'name' => 'string|nullable',
            'sebutan' => 'string|min:3|max:191',
            'dasar' => 'string|nullable',
            'kode_kelompok' => 'required|string|min:3',
            'input' => 'nullable',
            'radio' => 'nullable'
        ]);
        $jenis_spt->name = Common::cleanInput($request->name);
        $jenis_spt->sebutan = Common::cleanInput($request->sebutan);
        $jenis_spt->dasar = Common::cleanInput($request->dasar);
        $jenis_spt->kode_kelompok = Common::cleanInput($request->kode_kelompok);
        $jenis_spt->input = $request->input;
        $jenis_spt->radio = $request->radio;

        //$cols->fill($request->all())->save();
        $jenis_spt->save();
        return 'Updated!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cols = JenisSpt::findOrFail($id); 
        return ($cols->delete()) ? 'deleted' :'no data';
    }

    public function getData()
    {
        $cols = JenisSpt::all()->except('input');
        return Datatables::of($cols)
                ->addIndexColumn()
                ->editColumn('name', function($col){
                    return $col->nama_sebutan;
                })
                ->editColumn('dasar', function($col){
                    //return (strlen($col->dasar) > 50) ? substr(strip_tags($col->dasar), 0,70).'....' : strip_tags($col->dasar);
                    return (strlen($col->dasar) > 50) ? Common::cutText(strip_tags($col->dasar), 2,100) : strip_tags($col->dasar);
                })
                ->editColumn('created_at', function ($col) {
                    return $col->created_at->format('d/m/Y H:i:s');
                })
                //->removeColumn(['password','remember_token'])
                ->addColumn('action', function($col){
                   return $this->buildControl($col->id);
                })->make(true);
    }

    public function cariJenisSpt(Request $request){
        
            
            if($request->has('q')) {

                $cari = $request->q;          
                $data = JenisSpt::where('name', 'LIKE', '%'.$cari.'%')->get();               
                $output = '';
               
                if (count($data)>0) {                  
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';                  
                    foreach ($data as $row){                       
                        $output .= '<li class="list-group-item">'.$row->name.'</li>';
                    }                  
                    $output .= '</ul>';
                }
                else {                 
                    $output .= '<li class="list-group-item">'.'No results'.'</li>';
                }               
                return $output;
            }

            return 'Error';
            
        
    }

    public function buildControl($id){
        $user = auth()->user();
        $control = '';
        if($user->hasAnyRole(['TU Perencanaan','Super Admin'])){
            $control .= '<a href="javascript:void(0);" onclick="editForm('. $id .')" data-toggle="tooltip" title="Edit Jenis SPT" class="btn btn-outline-primary btn-sm"><i class="ni ni-single-copy-04"></i></a>';            
        }
        if($user->hasAnyRole(['Super Admin'])){
            $control .= '<a href="javascript:void(0);" onclick="deleteData('. $id .')" data-toggle="tooltip" title="Hapus Jenis SPT" class="btn btn-outline-danger btn-sm"><i class="fa fa-times"></i></a>';
        }
        if ($user->can('View SPT')) {
            //$control .= '<a href="javascript:void(0);" onclick="view('. $id .')" data-toggle="tooltip" title="Lihat Jenis SPT" class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i></a>';
        }

        return $control;
    }

    public function getRadioValue($id){
        $jenis_spt = JenisSpt::findOrFail($id);
        $return = '';
        $radio = [];
        $radio = $jenis_spt->radio;
        foreach ($radio as $key => $value){
            $return .= '<div class="custom-control custom-radio mb-3 radio_input">'.
                            '<input name="radio_input" class="custom-control-input" id="radio-'.$key.'" type="radio" value="'.$key.'">'.
                            '<label class="custom-control-label mr-3" for="radio-'.$key.'">'.$value.'</label>'.
                        '</div>';
        }
        return $return;
    }   

}
