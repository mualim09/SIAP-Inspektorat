<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = ['user_id', 'name', 'status','description'];
    protected $table = 'pejabat';
    protected $appends = [];
  	public $timestamps = false;
    protected $casts = [
        
    ];

    //relasi ke user
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
