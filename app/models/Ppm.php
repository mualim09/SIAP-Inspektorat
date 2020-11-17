<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ppm extends Model
{
    protected $fillable = ['kegiatan', 'jenis_ppm','tgl_mulai', 'tgl_akhir','lama','nota_dinas'];
    protected $primaryKey = 'id';
    protected $table = 'ppm';
    protected $appends = [];
  	public $timestamps = false;

  	public function detailPpm(){
        return $this->hasMany('App\models\DetailPpm');
    }
}
