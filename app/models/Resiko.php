<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Resiko extends Model
{
    protected $fillable = ['opd','nama_kegiatan','tujuan_kegiatan','tujuan_pd','sasaran_pd','capaian','	tujuan'];
    protected $table = 'resiko';
}
