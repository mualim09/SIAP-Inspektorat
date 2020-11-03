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
        // dd($request);
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
        
        // dd(json_decode($request->inspektur) === $inspektur->id);

        if($request->inspektur !== $inspektur->id && $request->sekretaris !== $sekretaris->id && $request->irban_i !== $irban_i_default->id && $request->irban_ii !== $irban_ii_default->id && $request->irban_iii !== $irban_iii_default->id && $request->irban_iv !== $irban_iv_default->id){

            $cek_pejabat = Pejabat::where('name', 'Inspektur Kabupaten')->count();
            $cek_pejabat_sekretaris = Pejabat::where('name', 'Sekretaris')->count();
            $cek_pejabat_irban_i = Pejabat::where('name', 'Inspektur Pembantu Wilayah I')->count();
            $cek_pejabat_irban_ii = Pejabat::where('name', 'Inspektur Pembantu Wilayah II')->count();
            $cek_pejabat_irban_iii = Pejabat::where('name', 'Inspektur Pembantu Wilayah III')->count();
            $cek_pejabat_irban_iv = Pejabat::where('name', 'Inspektur Pembantu Wilayah IV')->count();

            if($cek_pejabat>0 && $cek_pejabat_sekretaris>0 && $cek_pejabat_irban_i>0 && $cek_pejabat_irban_ii>0 && $cek_pejabat_irban_iii>0 && $cek_pejabat_irban_iv>0){
                //query update tabel pejabat 'semua pejabat'

                if(json_decode($request->inspektur) === $inspektur->id && json_decode($request->sekretaris) === $sekretaris->id && json_decode($request->irban_i) === $irban_i_default->id && json_decode($request->irban_ii) === $irban_ii_default->id && json_decode($request->irban_iii) === $irban_iii_default->id && json_decode($request->irban_iv) === $irban_iv_default->id){
                    $update = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>null]);
                    $update = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekretaris','status'=>null]);
                    $update = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>null]);
                    $update = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>null]);
                    $update = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>null]);
                    $update = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>null]);
                    return $update.'has been updated no plt';
                }else{
                    $update = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>'PLT']);
                    $update = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekretaris','status'=>'PLT']);
                    $update = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>'PLT']);
                    $update = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>'PLT']);
                    $update = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>'PLT']);
                    $update = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>'PLT']);
                    return $update.'has been updated with plt';
                }
            }else{
                //query insert pejabat semua
                if(json_decode($request->inspektur) === $inspektur->id && json_decode($request->sekretaris) === $sekretaris->id && json_decode($request->irban_i) === $irban_i_default->id && json_decode($request->irban_ii) === $irban_ii_default->id && json_decode($request->irban_iii) === $irban_iii_default->id && json_decode($request->irban_iv) === $irban_iv_default->id){
                    $save = Pejabat::insert(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten']);
                    $save = Pejabat::insert(['user_id'=>$request->sekretaris,'name'=>'Sekretaris']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV']);
                    return $save.'has been saved on pejabat satgas without plt';
                }else{
                    $save = Pejabat::insert(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>'PLT']);
                    $save = Pejabat::insert(['user_id'=>$request->sekretaris,'name'=>'Sekretaris','status'=>'PLT']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>'PLT']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>'PLT']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>'PLT']);
                    $save = Pejabat::insert(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>'PLT']);
                    return $save.'has been saved on pejabat satgas with plt';
                }
                
            }
        }

        // // if request pejabat inspektur
        // if($request->inspektur !== $inspektur->id){
        //     $cek_pejabat = Pejabat::where('name', 'Inspektur Kabupaten')->count();
        //     if($cek_pejabat>0){
        //         //query update tabel pejabat 'name:Inspektur Kabupaten'
        //         if(json_decode($request->inspektur) === $inspektur->id){
        //             $update = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>null]);
        //             return $update.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>'PLT']);
        //             return $update.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat inspektur
        //         $save = Pejabat::insert(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten']);
        //         return $save.'has been saved on pejabat satgas';
        //     }
        // }

        // //if request sekretaris
        // if($request->sekretaris !== $sekretaris->id){
        //     $cek_pejabat_sekretaris = Pejabat::where('name', 'Sekretaris')->count();
        //     // dd(count($cek_pejabat_sekretaris));
        //     if($cek_pejabat_sekretaris>0){
        //         //query update tabel pejabat 'name:sekretaris'
        //         if(json_decode($request->sekretaris) === $sekretaris->id){
        //             $update = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekretaris','status'=>null]);
        //             return $update.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekretaris','status'=>'PLT']);
        //             return $update.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat sekretaris
        //         $save = Pejabat::insert(['user_id'=>$request->sekretaris,'name'=>'Sekretaris']);
        //         return $save.'has been saved on pejabat satgas';
        //     }
        // }

        // // if request irban i
        // if($request->irban_i !== $irban_i_default->id){
        //     $cek_pejabat_irban_i = Pejabat::where('name', 'Inspektur Pembantu Wilayah I')->count();
        //     // dd(count($cek_pejabat_sekretaris));
        //     if($cek_pejabat_irban_i>0){
        //         //query update tabel pejabat 'name:irban_i'
        //         if(json_decode($request->irban_i) === $irban_i_default->id){
        //             $update = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>null]);
        //             return $update.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>'PLT']);
        //             return $update.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat irban_i
        //         $save = Pejabat::insert(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I']);
        //         return $save.'has been saved on pejabat satgas';
        //     }
        // }

        // // if request irban ii
        // if($request->irban_ii !== $irban_ii_default->id){
        //     $cek_pejabat_irban_ii = Pejabat::where('name', 'Inspektur Pembantu Wilayah II')->count();
        //     // dd($cek_pejabat_irban_ii);
        //     if($cek_pejabat_irban_ii>0){
        //         //query update tabel pejabat 'name:irban_ii'
        //         if(json_decode($request->irban_ii) === $irban_ii_default->id){
        //             $update = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>null]);
        //             return $update.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>'PLT']);
        //             return $update.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat irban_ii
        //         $save = Pejabat::insert(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II']);
        //         return $save.'has been saved on pejabat satgas';
        //     }
        // }

        // // if request irban iii
        // if($request->irban_iii !== $irban_iii_default->id){
        //     $cek_pejabat_irban_iii = Pejabat::where('name', 'Inspektur Pembantu Wilayah III')->count();
        //     // dd($cek_pejabat_irban_iii);
        //     if($cek_pejabat_irban_iii>0){
        //         //query update tabel pejabat 'name:irban_iii'
        //         if(json_decode($request->irban_iii) === $irban_iii_default->id){
        //             $update = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>null]);
        //             return $update.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>'PLT']);
        //             return $update.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat irban_iii
        //         $save = Pejabat::insert(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III']);
        //         return $save.'has been saved on pejabat satgas';
        //     }
        // }

        // // if request irban iv
        // if($request->irban_iv !== $irban_iv_default->id){
        //     $cek_pejabat_irban_iv = Pejabat::where('name', 'Inspektur Pembantu Wilayah IV')->count();
        //     // dd($cek_pejabat_irban_iii);
        //     if($cek_pejabat_irban_iv>0){
        //         //query update tabel pejabat 'name:irban_iii'
        //         if(json_decode($request->irban_iv) === $irban_iv_default->id){
        //             $update = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>null]);
        //             return $update.' '.'has been updated no plt';
        //         }else{
        //             $update = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>'PLT']);
        //             return $update.' '.'has been updated with plt';
        //         }
        //     }else{
        //         //query insert pejabat irban_iii
        //         $save = Pejabat::insert(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV']);
        //         return $save.' '.'has been saved on pejabat satgas';
        //     }
        // }

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
