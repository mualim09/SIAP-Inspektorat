<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'lokasi';
    protected $fillable = ['nama_lokasi', 'jenis_lokasi','sebutan_pimpinan','kecamatan','status'];

    public function getLokasiAttribute()
    {
        return ( $this->kecamatan != null) ? $this->nama_lokasi .' '. $this->kecamatan : $this->nama_lokasi;
    }

}
