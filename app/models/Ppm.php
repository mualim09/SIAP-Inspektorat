<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ppm extends Model
{
    protected $fillable = ['user_id', 'kode_kelompok','lama', 'unsur_dupak','info_dupak'];
    protected $table = 'detail_ppm';
    protected $appends = [];
  	public $timestamps = false;
}
