<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = ['sasaran_kegiatan', 'detail_tujuan_kegiatan'];
    protected $table = 'kegiatan';

    // relasion table skpd with forign key "detail_kegiatan_id"
    public function relasi_tbl_kegiatan(){
    	return $this->belongsTo('App\models\Detail_kegiatan', 'kegiatan_id', 'id');
    }

    // public function relasi_skpd(){
    // 	return $this->hasMany('App\models\Skpd','id');
    // }
}
