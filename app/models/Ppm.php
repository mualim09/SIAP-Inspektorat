<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ppm extends Model
{
    protected $fillable = ['kegiatan', 'kegiatan','tgl_mulai', 'tgl_akhir','lama','nota_dinas'];
    protected $primaryKey = 'id';
    protected $table = 'ppm';
    protected $appends = [];
  	public $timestamps = false;
}
