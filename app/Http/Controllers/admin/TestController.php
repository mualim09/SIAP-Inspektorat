<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\KodeTemuan, DB;

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
}
