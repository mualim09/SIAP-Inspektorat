<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DetailPpm extends Model
{
    protected $fillable = ['user_id', 'kode_kelompok','lama', 'unsur_dupak','info_dupak','nota_dinas'];
    protected $table = 'detail_ppm';
    protected $appends = [];
  	public $timestamps = false;

  	public function users(){
    	return $this->hasMany('App\User');
    }

    public function ppm(){
        return $this->belongsTo('App\models\Ppm');
    }
}
