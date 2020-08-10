<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tkegiatan extends Model
{
    protected $fillable = ['tskpd', 'sskpd', 'kskpd', 'tkegiatan', 'tr_resiko_id'];
    protected $table = 'tr_tkegiatan';

    // relationship dengan tabel informasi resik "tr_iresiko"
    public function riresiko(){
    	return $this->belongsTo('App\models\Iresiko', 'tr_resiko_id');
    }


}
