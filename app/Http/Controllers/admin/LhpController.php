<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\LaporanLhp;

class LhpController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])/*->except(['ProsesButtonKAA','getDataTemuan'])*/; //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function upload_lhp(Request $request)
    {
    	// $byGroup = group_by("lhp-sebab", $request->point_kka_lhp);
    	// echo "<pre>" . var_export($byGroup, true) . "</pre>";
        dd($request);
        die();
        // $save = LaporanLhp::insert(['kode_lhp'=>$request->kode_lhp,'custom_date'=>$request->custom_date,'spt_id'=>$request->spt_id,'tujuan_pemeriksaan'=>$request->lhp_bab_II['tujuan-pemeriksaan'],'ruang_lingkup_pemeriksaan'=>$request->lhp_bab_II['ruang-lingkup-pemeriksaan'], 'batasan_pemeriksaan'=>$request->lhp_bab_II['batasan-pemeriksaan'],'pendekatan_pemeriksaan'=>$request->lhp_bab_II['pendekatan-pemeriksaan'],'hasil_pemeriksaan'=>$request->lhp_bab_II['hasil-pemeriksaan'],'sebab_pemeriksaan'=>$request->lhp_bab_II[''],'akibat_pemeriksaan'=>$request->lhp_bab_II[''],'komentar_pemeriksaan'=>$request->lhp_bab_II[''],'rekomendasi_pemeriksaan'=>$request->lhp_bab_II['']]);

    }

    // public function FunctionName($value='')
    // {
    // 	# code...
    // }
}
