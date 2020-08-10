<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $fillable = ['user_id', 'nama_sertifikat', 'file_sertifikat','created_at','updated_at'];
    protected $primaryKey = 'id';
    protected $table = 'sertifikat';

    public function user(){
    	$this->belongsTo('App\User');
    }

}
