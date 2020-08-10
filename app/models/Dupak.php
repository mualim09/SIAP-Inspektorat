<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Dupak extends Model
{
    protected $fillable = ['user_id', 'dupak', 'unsur_dupak','status', 'info_spt','created_at','updated_at'];
    protected $table = 'dupak';

    public function user(){
    	$this->belongsTo('App\User');
    }
}
