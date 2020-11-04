<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User, App\models\Pejabat;

class Dupak extends Model
{
    protected $fillable = ['user_id', 'dupak', 'unsur_dupak','status', 'info_spt','created_at','updated_at'];
    protected $table = 'dupak';
    protected $appends = ['irban_kepala','user_dupak'];

    public function getIrbanKepalaAttribute(){
      $user_id = $this->user_id;
      $ruang = User::select('ruang->nama as nama_ruang')->where('id', $user_id)->first();
      if($ruang) :
        $nama_ruang = $this->translateRuang($ruang->nama_ruang);
        //$irban = User::where('ruang->jabatan','kepala')->where('ruang->nama', $ruang->nama_ruang)->first();
        $irban_default = User::where('jabatan',$nama_ruang)->first();
        $irban_pengganti = User::whereHas('pejabat', function($q) use ($nama_ruang){
          $q->where('name', $nama_ruang)->where('status', 'PLT');
        })->with('pejabat')->first();
        return (!is_null($irban_pengganti)) ? $irban_pengganti : $irban_default;
      endif;
    }

    public function getUserDupakAttribute(){
      $user_id= $this->user_id;
      $user = User::where('id', $user_id)->first();
      return $user;
    }

    public function user(){
    	$this->belongsTo('App\User');
    }

    public function translateRuang($nama_ruang){
      if($nama_ruang){
        switch($nama_ruang){
          case 'IRBAN I':
            return 'Inspektur Pembantu Wilayah I';
            break;
          case 'IRBAN II':
            return 'Inspektur Pembantu Wilayah II';
            break;
          case 'IRBAN III':
            return 'Inspektur Pembantu Wilayah III';
            break;
          case 'IRBAN IV':
            return 'Inspektur Pembantu Wilayah IV';
            break;
          default :
            return;
        }
      }
      return;
    }
}
