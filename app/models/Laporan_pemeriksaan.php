<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Laporan_pemeriksaan extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['detail_spt_id','sasaran_audit','kode_temuan_id','judultemuan', 'kondisi', 'kriteria','created_at','updated_at'];
    protected $table = 'laporan_pemeriksaan';
    protected $cast = [
    	'atribut' => 'array'
    ];
    // public $timestamps = false;
}
