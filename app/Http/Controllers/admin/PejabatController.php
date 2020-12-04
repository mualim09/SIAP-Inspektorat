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
        $sekretaris = User::where('jabatan', 'Sekertaris')->select(['id' ,'first_name','last_name'])->first();
        $irban_i_default = User::where('jabatan', 'Inspektur Pembantu Wilayah I')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_ii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah II')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah III')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iv_default = User::where('jabatan', 'Inspektur Pembantu Wilayah IV')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $penyusun_ak_default = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $penetap_ak_default = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();

        //$plt_inspektur = Pejabat::where('name', 'Inspektur Kabupaten')->with('user:id,first_name,last_name')->first();
        $plt_inspektur = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Kabupaten')->whereNotNull('status');
        })->first();

        $plt_sekretaris = User::whereHas('pejabat', function($q){
            $q->where('name','Sekertaris')->whereNotNull('status');
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

        $ketua_penilai_ak = User::whereHas('pejabat', function($q){
            $q->where('name','Ketua Penilai AK');
        })->first();
        $penyusun_ak = User::whereHas('pejabat', function($q){
            $q->where('name','Penyusun AK')->whereNull('status');
        })->first();
        $penetap_ak = User::whereHas('pejabat', function($q){
            $q->where('name','Penetap AK')->whereNull('status');
        })->first();

        $data_user_ppm = User::whereHas('pejabat', function($q){
            $q->where('name','PPM');
        })->get();
        $users = User::all();
        // dd((empty($data_user_ppm)) ? $data_user_ppm : $users);
        // dd(empty($data_user_ppm));
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
            'ketua_penilai'=> [
                'user'=>(($ketua_penilai_ak != '99992')) ? $ketua_penilai_ak : $users, // NOTE : SOLUSI MENGUBAH ID UPDATE YG STATIC, YAKNI DENGAN GET ID BY NAMA PADA TB PEJABAT
                'is_ketua_penilai'=>(!is_null($ketua_penilai_ak)) ? true : false
            ],
            'penyusun_ak'=> [
                'user'=>(!is_null($penyusun_ak)) ? $penyusun_ak : $penyusun_ak_default,
                'is_penyusun'=>(!is_null($penyusun_ak)) ? true : false
            ],
            'penetap_ak'=> [
                'user'=>(!is_null($penetap_ak)) ? $penetap_ak : $penetap_ak_default,
                'is_plt'=>(!is_null($penetap_ak)) ? true : false
            ],
            /*sementara butuh di koreksi kembali*/
            'data_user_ppm'=> [
                'user'=>(empty($data_user_ppm)) ? $users : $data_user_ppm,
                'ppm_is_null'=>(!is_null($data_user_ppm)) ? true : false
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
        // dd($request->select_ppm);
        /* $request->select_ppm datanya array */
        $inspektur = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $sekretaris = User::where('jabatan', 'Sekertaris')->select(['id' ,'first_name','last_name'])->first();
        $irban_i_default = User::where('jabatan', 'Inspektur Pembantu Wilayah I')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_ii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah II')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iii_default = User::where('jabatan', 'Inspektur Pembantu Wilayah III')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $irban_iv_default = User::where('jabatan', 'Inspektur Pembantu Wilayah IV')->select(['id' ,'first_name','last_name','ruang->nama as nama_ruang'])->first();
        $ketua_penilai_ak_default = User::all();
        $penyusun_ak_default = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $penetap_ak_default = User::where('jabatan', 'Inspektur Kabupaten')->select(['id' ,'first_name','last_name'])->first();
        $ppm_user_default = User::all();
        // dd($request->ketua_penilaian_ak === $ketua_penilai_ak_default);

        //$plt_inspektur = Pejabat::where('name', 'Inspektur Kabupaten')->with('user:id,first_name,last_name')->first();
        $plt_inspektur = User::whereHas('pejabat', function($q){
            $q->where('name','Inspektur Kabupaten')->whereNotNull('status');
        })->first();

        $plt_sekretaris = User::whereHas('pejabat', function($q){
            $q->where('name','Sekertaris')->whereNotNull('status');
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

        // NOTE : SOLUSI MENGUBAH ID UPDATE YG STATIC, YAKNI DENGAN GET ID BY NAMA PADA TB PEJABAT
        
        // dd(json_decode($request->inspektur) === $inspektur->id);
        // dd($request->ketua_penilaian_ak);
        $cek_pejabat = Pejabat::where('name', 'Inspektur Kabupaten')->count();
        $cek_pejabat_sekretaris = Pejabat::where('name', 'Sekertaris')->count();
        $cek_pejabat_irban_i = Pejabat::where('name', 'Inspektur Pembantu Wilayah I')->count();
        $cek_pejabat_irban_ii = Pejabat::where('name', 'Inspektur Pembantu Wilayah II')->count();
        $cek_pejabat_irban_iii = Pejabat::where('name', 'Inspektur Pembantu Wilayah III')->count();
        $cek_pejabat_irban_iv = Pejabat::where('name', 'Inspektur Pembantu Wilayah IV')->count();
        $cek_ketua_penilai_ak = Pejabat::where('name','Ketua Penilai AK')->count();
        $cek_penyusun_ak = Pejabat::where('name','Penyusun AK')->count();
        $cek_penetap_ak = Pejabat::where('name','Penetap AK')->count();
        $cek_ppm = Pejabat::where('name','PPM')->count();
        $array_ppm_view = ($request->select_ppm != null) ? count($request->select_ppm) : 0;
         // dd(($cek_ppm == $array_ppm_view) ? true : false);
        $compare_ppm = ($cek_ppm == $array_ppm_view) ? true : false; /*jika true maka data array ppm sama jadi hanya diupdate jika tidak sama maka insert ulang*/

        // die();
        
        /* if($request->inspektur !== $inspektur->id && $request->sekretaris !== $sekretaris->id && $request->irban_i !== $irban_i_default->id && $request->irban_ii !== $irban_ii_default->id && $request->irban_iii !== $irban_iii_default->id && $request->irban_iv !== $irban_iv_default->id && $request->ketua_penilaian_ak !== $ketua_penilai_ak_default)*/
        
        if($request->inspektur !== $inspektur['id'] && $request->sekretaris !== $sekretaris['id'] && $request->irban_i !== $irban_i_default['id'] && $request->irban_ii !== $irban_ii_default['id'] && $request->irban_iii !== $irban_iii_default['id'] && $request->irban_iv !== $irban_iv_default['id'] && $request->ketua_penilaian_ak !== $ketua_penilai_ak_default){


            if($cek_pejabat>0 && $cek_pejabat_sekretaris>0 && $cek_pejabat_irban_i>0 && $cek_pejabat_irban_ii>0 && $cek_pejabat_irban_iii>0 && $cek_pejabat_irban_iv>0 && $cek_ketua_penilai_ak>0 && $compare_ppm == false){
                //query update tabel pejabat 'semua pejabat'

                ($request->ketua_penilaian_ak == null) ? $ketua_penilaian_ak = null : $ketua_penilaian_ak = $request->ketua_penilaian_ak;
                ($request->select_ppm == null) ? $anggota_ppm = null : $anggota_ppm = $request->select_ppm;

                if($request->inspektur != null){
                    if (json_decode($request->inspektur) === $inspektur['id']) {
                        $update_inspektur = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>null]);
                    }else{
                        $update_inspektur = Pejabat::where('id','1')->update(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>'PLT']);
                    }
                    $update = $update_inspektur;
                }if ($request->sekretaris != null) {
                    if (json_decode($request->sekretaris) === $sekretaris['id']) {
                        $update_sekretaris = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekertaris','status'=>null]);
                    }else{
                        $update_sekretaris = Pejabat::where('id','2')->update(['user_id'=>$request->sekretaris,'name'=>'Sekertaris','status'=>'PLT']);
                    }
                    $update = $update_sekretaris;
                }if ($request->irban_i != null) {
                    if (json_decode($request->irban_i) === $irban_i_default['id']) {
                        $update_irban_i = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>null]);
                    }else{
                        $update_irban_i = Pejabat::where('id','3')->update(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>'PLT']);
                    }
                    $update = $update_irban_i;
                }if ($request->irban_ii != null) {
                    if (json_decode($request->irban_ii) === $irban_ii_default['id']) {
                        $update_irban_ii = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>null]);
                    }else{
                        $update_irban_ii = Pejabat::where('id','4')->update(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>'PLT']);
                    }
                    $update = $update_irban_ii;
                }if ($request->irban_iii != null) {
                    if (json_decode($request->irban_iii) === $irban_iii_default['id']) {
                        $update_irban_iii = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>null]);
                    }else{
                        $update_irban_iii = Pejabat::where('id','5')->update(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>'PLT']);
                    }
                    $update = $update_irban_iii;
                }if ($request->irban_iv != null) {
                    if (json_decode($request->irban_iv) === $irban_iv_default['id']) {
                        $update_irban_iv = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>null]);
                    }else{
                        $update_irban_iv = Pejabat::where('id','6')->update(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>'PLT']);
                    }
                    $update = $update_irban_iv;
                }if($request->ketua_penilaian_ak == null || $request->ketua_penilaian_ak != null){
                    if ($ketua_penilaian_ak != null) {
                        $update_ketua_penilai = Pejabat::where('id','7')->update(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK']);
                    }else{
                        $update_ketua_penilai = Pejabat::where('id','7')->update(['user_id'=>'99992','name'=>'Ketua Penilai AK']);
                    }
                    $update = $update_ketua_penilai;
               }if ($request->penyusun_ak != null) {
                    if (json_decode($request->penyusun_ak) === $penyusun_ak_default['id']) {
                        $update_penyusun = Pejabat::where('id','8')->update(['user_id'=>$request->penyusun_ak,'name'=>'Penyusun AK']);
                    }else{
                        $update_penyusun = Pejabat::where('id','8')->update(['user_id'=>$request->penyusun_ak,'name'=>'Penyusun AK']);
                    }
                    $update = $update_penyusun;
                }if ($request->penetap_ak != null) {
                    if (json_decode($request->penetap_ak) === $penetap_ak_default['id']) {
                        $update_penyusun = Pejabat::where('id','9')->update(['user_id'=>$request->penetap_ak,'name'=>'Penetap AK']);
                    }else{
                        $update_penyusun = Pejabat::where('id','9')->update(['user_id'=>$request->penetap_ak,'name'=>'Penetap AK']);
                    }
                    $update = $update_penyusun;
                }if($request->select_ppm != null || $request->select_ppm == null){
                    // if ($anggota_ppm != null && $request->select_ppm == null) {
                        
                        $dataPPM = Pejabat::where('name','PPM')->get();
                        foreach ($dataPPM as $dataPPM_index => $dataPPM_value) {
                            $id_ppm = $dataPPM[$dataPPM_index];
                            $delete_data_first = Pejabat::where('id',$id_ppm->id)->where('name','PPM')->delete();
                        }
                        if($anggota_ppm != null){
                            foreach ($anggota_ppm as $index_ppm => $value_ppm) {
                                /*json_decode($anggota_ppm[$index_ppm])*/
                                if ($compare_ppm == true) {
                                    $update_ketua_penilai = Pejabat::insert(['user_id'=>$request->ketua_penilaian_ak,'name'=>'PPM']);
                                }else{
                                    // $delete_data_first = Pejabat::where('id',$id_ppm->id)->where('name','PPM')->delete();
                                    $update_ketua_penilai = Pejabat::insert(['user_id'=>json_decode($anggota_ppm[$index_ppm]),'name'=>'PPM']);
                                }
                                $update = $update_ketua_penilai;
                            }
                        }
                    // }else{
                    //     $update_ketua_penilai = 'user kosong';
                    // }
               }

                return $update.' pejabat has been Update !';

            }if($cek_pejabat==0 && $cek_pejabat_sekretaris==0 && $cek_pejabat_irban_i==0 && $cek_pejabat_irban_ii==0 && $cek_pejabat_irban_iii==0 && $cek_pejabat_irban_iv==0 && $cek_ketua_penilai_ak==0 && $cek_ppm==0){
                //query insert pejabat semua
                if($request->inspektur != null){
                    if (json_decode($request->inspektur) === $inspektur['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->inspektur,'name'=>'Inspektur Kabupaten','status'=>'PLT']);
                    }
                }if ($request->sekretaris != null) {
                    if (json_decode($request->sekretaris) === $sekretaris['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->sekretaris,'name'=>'Sekertaris']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->sekretaris,'name'=>'Sekertaris','status'=>'PLT']);
                    }
                }if ($request->irban_i != null) {
                    if (json_decode($request->irban_i) === $irban_i_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->irban_i,'name'=>'Inspektur Pembantu Wilayah I','status'=>'PLT']);
                    }
                }if ($request->irban_ii != null) {
                    if (json_decode($request->irban_ii) === $irban_ii_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->irban_ii,'name'=>'Inspektur Pembantu Wilayah II','status'=>'PLT']);
                    }
                }if ($request->irban_iii != null) {
                    if (json_decode($request->irban_iii) === $irban_iii_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->irban_iii,'name'=>'Inspektur Pembantu Wilayah III','status'=>'PLT']);
                    }
                }if ($request->irban_iv != null) {
                    if (json_decode($request->irban_iv) === $irban_iv_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->irban_iv,'name'=>'Inspektur Pembantu Wilayah IV','status'=>'PLT']);
                    }
                }if($cek_ketua_penilai_ak<1){
                    if ($request->ketua_penilaian_ak == null) {
                        $save = Pejabat::insert(['user_id'=>'99991','name'=>'Ketua Penilai AK']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK']);
                    }
                }if ($request->penyusun_ak != null) {
                    if (json_decode($request->penyusun_ak) === $penyusun_ak_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->penyusun_ak,'name'=>'Penyusun AK']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->penyusun_ak,'name'=>'Penyusun AK']);
                    }
                }if ($request->penetap_ak != null) {
                    if (json_decode($request->penetap_ak) === $penetap_ak_default['id']) {
                        $save = Pejabat::insert(['user_id'=>$request->penetap_ak,'name'=>'Penetap AK']);
                    }else{
                        $save = Pejabat::insert(['user_id'=>$request->penetap_ak,'name'=>'Penetap AK']);
                    }
                }if ($cek_ppm == 0) {
                    for ($i=0; $i < count($request->select_ppm); $i++) {
                        // dd($request->ketua_penilaian_ak == null);
                        if ($request->select_ppm == null) {
                            $save = Pejabat::insert(['user_id'=>json_decode($request->select_ppm[$i]),'name'=>'PPM']);
                        }else{
                            $save = Pejabat::insert(['user_id'=>json_decode($request->select_ppm[$i]),'name'=>'PPM']);
                        }
                    }
                }
                return $save.' pejabat has been save !';
            }
        }

        // $request->ketua_penilaian_ak == null && $request->penyusun_ak !== null && $request->cek_penetap_ak !== null
        // dd($request->ketua_penilaian_ak !== $ketua_penilai_ak_default->id);
        // die();
       // if ($request->ketua_penilaian_ak !== $ketua_penilai_ak_default && $request->cek_penyusun_ak !== $penyusun_ak_default->id && $request->cek_penetap_ak !== $penetap_ak_default->id) {
       //     // dd($cek_penyusun_ak>0);
       //     if($cek_ketua_penilai_ak<1){
       //          if ($request->ketua_penilaian_ak == null) {
       //              $update2 = Pejabat::where('id','7')->update(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK','status'=>'ketuaAK']);
       //          }else{
       //              $update2 = Pejabat::where('id','7')->update(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK','status'=>'ketuaAK']);
       //          }
       //     }if ($cek_penyusun_ak>0) {
       //         if ($request->cek_penyusun_ak == null) {
       //              $update2 = Pejabat::where('id','8')->update(['user_id'=>$request->cek_penyusun_ak,'name'=>'Penyusun AK','status'=>'penyusunAK']);
       //          }else{
       //              $update2 = Pejabat::where('id','8')->update(['user_id'=>$request->cek_penyusun_ak,'name'=>'Penyusun AK','status'=>'penyusunAK']);
       //          }
       //     }if ($cek_penetap_ak>0) {
       //         if ($request->cek_penetap_ak == null) {
       //              $update2 = Pejabat::where('id','9')->update(['user_id'=>$request->cek_penetap_ak,'name'=>'Penetap AK','status'=>'penetapAK']);
       //          }else{
       //              $update2 = Pejabat::where('id','9')->update(['user_id'=>$request->cek_penetap_ak,'name'=>'Penetap AK','status'=>'penetapAK']);
       //          }
       //     }
       //     return $update2.' has been updated!';
       // }else{
       //      // dd($cek_ketua_penilai_ak<1);
       //  if($cek_ketua_penilai_ak<1){
       //       if ($request->ketua_penilaian_ak == null) {
       //           $save2 = Pejabat::insert(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK','status'=>'ketuaAK']);
       //       }else{
       //           $save2 = Pejabat::insert(['user_id'=>$request->ketua_penilaian_ak,'name'=>'Ketua Penilai AK','status'=>'ketuaAK']);
       //       }
       //  }if ($cek_penyusun_ak>0) {
       //      if ($request->cek_penyusun_ak == null) {
       //           $save2 = Pejabat::insert(['user_id'=>$request->cek_penyusun_ak,'name'=>'Penyusun AK','status'=>'penyusunAK']);
       //       }else{
       //           $save2 = Pejabat::insert(['user_id'=>$request->cek_penyusun_ak,'name'=>'Penyusun AK','status'=>'penyusunAK']);
       //       }
       //  }if ($cek_penetap_ak>0) {
       //      if ($request->cek_penetap_ak == null) {
       //           $save2 = Pejabat::insert(['user_id'=>$request->cek_penetap_ak,'name'=>'Penetap AK','status'=>'penetapAK']);
       //       }else{
       //           $save2 = Pejabat::insert(['user_id'=>$request->cek_penetap_ak,'name'=>'Penetap AK','status'=>'penetapAK']);
       //       }
       //  }
       //     return $save2.' has been saved!';
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
