<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\KodeTemuan, DB;
use App\models\DetailSpt, App\models\Spt;

class TestController extends Controller
{
    public function kodeTemuanSelect(){    	
    	$kodes = KodeTemuan::select('kode','deskripsi', 'atribut')->whereRaw('JSON_EXTRACT(atribut, "$.kelompok") <> CAST("null" AS JSON) AND JSON_EXTRACT(atribut, "$.subkelompok") <> CAST("null" AS JSON)')->orderBy('sort_id', 'ASC')->get();
    	$return = '<select id="select-kode" name="select_kode">';
    	foreach($kodes as $kode){
    		$return .= '<option value="'.$kode->kode.'">'.$kode->select_supersub_kode.'&nbsp;&nbsp;'.$kode->deskripsi.'</option>';
    	}
    	$return .= '</select>';

    	$return .=	'<script type="text/javascript">'
    					.'var select_kode = $("#select-kode").selectize({'
    						.'allowEmptyOption: true,'
							.'placeholder: "Pilih Kode Temuan",'
							.'create: false,'
    					.'});'
    				.'</script>';

    	return $return;

    }

    public function testDupak(){
        $detail = DetailSpt::whereHas('spt', function($q){
            $q->whereBetween('tgl_mulai',['2020-08-11 00:00:00','2020-08-15 00:00:00']);
        })->where('unsur_dupak','=','pengawasan')->get();
       dd($detail[0]['info_dupak']);
    }

    /*$posts = App\Post::whereHas('comments', function (Builder $query) {
    $query->where('content', 'like', 'foo%');
    })->get();*/
}
