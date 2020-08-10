<?php

namespace App\Http\Controllers\admin;

use App\models\KodeTemuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KodeTemuanController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //user must authenticated
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$kelompok = KodeTemuan::whereJsonContains('atribut->kelompok',null)->get();
        //$kelompok = KodeTemuan::where('atribut->kelompok',0)->get();
        $kelompok = KodeTemuan::whereRaw('JSON_EXTRACT(atribut, "$.kelompok") = CAST("null" AS JSON)')->get();
        return view('admin.kode.index',['kelompok'=>$kelompok]);
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
            'kode' => 'required|string|max:255|min:1',
            'deskripsi' => 'required|string|min:10'
        ]);        

        $kode = KodeTemuan::create($request->all());        
        
        if($kode){
            $msg = 'Kode Temuan tersimpan';
        }else{
            $msg = 'Kode Temuan gagal tersimpan';
        }
        return $msg;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\KodeTemuan  $kodeTemuan
     * @return \Illuminate\Http\Response
     */
    public function show(KodeTemuan $kodeTemuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\KodeTemuan  $kodeTemuan
     * @return \Illuminate\Http\Response
     */
    public function edit(KodeTemuan $kodeTemuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\KodeTemuan  $kodeTemuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KodeTemuan $kodeTemuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\KodeTemuan  $kodeTemuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KodeTemuan $kodeTemuan)
    {
        //
    }

    public function getSubKelompok($kode){
        //$subKelompok = KodeTemuan::where('atribut->kelompok',$kode)->where('atribut->subkelompok',null)->get();
        $subKelompok = KodeTemuan::where('atribut->kelompok',$kode)->whereRaw('JSON_EXTRACT(atribut, "$.subkelompok") = CAST("null" AS JSON)')->get();
        return $subKelompok;
    }

    public function kodeTemuanSelect(){
        $kodes = KodeTemuan::select('id','kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
        $return = '<select id="select-kode" name="select_kode">';
        foreach($kodes as $kode){
            $return .= '<option value="'.$kode->id.'">'.$kode->select_supersub_kode.'&nbsp;&nbsp;'.$kode->deskripsi.'</option>';
        }
        $return .= '</select>';

        $return .=  '<script type="text/javascript">'
                        .'var select_kode = $("#select-kode").selectize({'
                            .'allowEmptyOption: true,'
                            .'placeholder: "Pilih Kode Temuan",'
                            .'create: false,'
                        .'});'
                    .'</script>';

        return $return;

    }
    
}
