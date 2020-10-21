<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Dupak extends Model
{
    protected $fillable = ['user_id', 'dupak', 'unsur_dupak','status', 'info_spt','created_at','updated_at'];
    protected $table = 'dupak';
    protected $appends = ['irban_kepala','user_dupak'];

    public function getIrbanKepalaAttribute(){
      $user_id = $this->user_id;
      $ruang = User::select('ruang->nama as nama_ruang')->where('id', $user_id)->first();
      if($ruang) :
        $irban = User::where('ruang->jabatan','kepala')->where('ruang->nama', $ruang->nama_ruang)->first();
        return $irban;
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
}
