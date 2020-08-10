<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Detail_resiko extends Model
{
    protected $fillable = ['uraian','kategori', 'kebutuhan','ket', 'target', 'resiko_id','user_id'];
    protected $table = 'detail_resiko';

    // relasion table resiko with forign key "resiko_id"
    public function relasi_resiko()
    {
    	return $this->belongsTo('App\models\Resiko', 'resiko_id', 'id');
    }

    // relasion table user with forign key "user_id"
    public function relasi_user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
