<?php

namespace App\Http\Controllers\admin;

use App\models\Pejabat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inspektur = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $sekretaris = User::where('jabatan', 'Sekretaris')->select(['id' ,'first_name','last_name'])->first();
        $irban_i_default = User::where('jabatan', 'Inspektur Pembantu Wilayah I')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_ii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah II')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah III')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iv_default = User::where('jabatan', 'Inspektur Pembantu Wilayah IV')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();

        //$plt_inspektur = Pejabat::where('name', 'Inspektur Kabupaten')->with('user:id,first_name,last_name')->first();
        $plt_inspektur = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Kabupaten')->whereNotNull('status');
        })->first();

        $plt_sekretaris = User::whereHas('pejabat', function($q){
            $q->where('name','Sekretaris')->whereNotNull('status');
        })->first();

        $plt_irban_i = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah I')->whereNotNull('status');
        })->first();

        $plt_irban_ii = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah II')->whereNotNull('status');
        })->first();

        $plt_irban_iii = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah III')->whereNotNull('status');
        })->first();

        $plt_irban_iv = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah IV')->whereNotNull('status');
        })->first();
        
        //dd($sekretaris);
        $users = User::all();
        /*return view('admin.pejabat.index')->with([
            'inspektur' => (!is_null($plt_inspektur)) ? $plt_inspektur : $inspektur,
            'sekretaris' => (!is_null($plt_sekretaris)) ? $plt_sekretaris : $sekretaris,
            'irban_i'=> (!is_null($plt_irban_i)) ? $plt_irban_i : $irban_i_default,
            'irban_ii'=> (!is_null($plt_irban_ii)) ? $plt_irban_ii : $irban_ii_default,
            'irban_iii'=> (!is_null($plt_irban_iii)) ? $plt_irban_iii : $irban_iii_default,
            'irban_iv'=> (!is_null($plt_irban_iv)) ? $plt_irban_iv : $irban_iv_default,
            'users'=>$users
        ]);*/
        return view('admin.pejabat.index')->with([
            'inspektur' => [
                'user' =>(!is_null($plt_inspektur)) ? $plt_inspektur : $inspektur,
                'is_plt' =>(!is_null($plt_inspektur)) ? true : false
            ],
            'sekretaris' => [
                'user'=>(!is_null($plt_sekretaris)) ? $plt_sekretaris : $sekretaris,
                'is_plt'=>(!is_null($plt_sekretaris)) ? true : false
            ],
            'irban_i'=> [
                'user'=>(!is_null($plt_irban_i)) ? $plt_irban_i : $irban_i_default,
                'is_plt'=>(!is_null($plt_irban_i)) ? true : false
            ],
            'irban_ii'=> [
                'user'=>(!is_null($plt_irban_ii)) ? $plt_irban_ii : $irban_ii_default,
                'is_plt'=>(!is_null($plt_irban_ii)) ? true : false
            ],
            'irban_iii'=> [
                'user'=>(!is_null($plt_irban_iii)) ? $plt_irban_iii : $irban_iii_default,
                'is_plt'=>(!is_null($plt_irban_iii)) ? true : false
            ],
            'irban_iv'=> [
                'user'=>(!is_null($plt_irban_iv)) ? $plt_irban_iv : $irban_iv_default,
                'is_plt'=>(!is_null($plt_irban_iv)) ? true : false
            ],
            'users'=>$users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        $inspektur = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $sekretaris = User::where('jabatan', 'Sekretaris')->select(['id' ,'first_name','last_name'])->first();
        $irban_i_default = User::where('jabatan', 'Inspektur Pembantu Wilayah I')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_ii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah II')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah III')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iv_default = User::where('jabatan', 'Inspektur Pembantu Wilayah IV')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();

        //$plt_inspektur = Pejabat::where('name', 'Inspektur Kabupaten')->with('user:id,first_name,last_name')->first();
        $plt_inspektur = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Kabupaten')->whereNotNull('status');
        })->first();

        $plt_sekretaris = User::whereHas('pejabat', function($q){
            $q->where('name','Sekretaris')->whereNotNull('status');
        })->first();

        $plt_irban_i = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah I')->whereNotNull('status');
        })->first();

        $plt_irban_ii = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah II')->whereNotNull('status');
        })->first();

        $plt_irban_iii = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah III')->whereNotNull('status');
        })->first();

        $plt_irban_iv = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Pembantu Wilayah IV')->whereNotNull('status');
        })->first();
       
        if($request->inspektur !== $inspektur->id){
            $cek_pejabat = Pejabat::where('name', 'Inspektur Kabupaten')->count();
            if($cek_pejabat>0){
                //query update tabel pejabat 'name:Inspektur Kabupaten'

            }else{
                //query insert pejabat inspektur
            }
        }

        //if request sekretaris
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
     * @param  \App\models\Pejabat  $pejabat
     * @return \Illuminate\Http\Response
     */
    public function show(Pejabat $pejabat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Pejabat  $pejabat
     * @return \Illuminate\Http\Response
     */
    public function edit(Pejabat $pejabat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Pejabat  $pejabat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pejabat $pejabat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Pejabat  $pejabat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pejabat $pejabat)
    {
        //
    }

    public function penunjukan(){
        return;
    }
}
