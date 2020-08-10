<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LaporanSpt extends Model
{
    protected $table = 'laporan_spt';
    protected $primaryKey = 'id';

    protected $guarded = ['detail_spt_id','etc_laporan','jenis_laporan','nomor_laporan_nhp','isi','filename','laporan_status','user_id','note'];

    // bisa tapi belum spesifik datanya
    // protected $casts = [
    //     'isi' => 'array'
    // ];

    public function setLaporanAttributKode($value)
    {
        $isi = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['kode'])) {
                $isi[] = $array_item;
            }
        }

        $this->attributes['isi'] = json_encode($isi);
    }

    public function detail_spt(){
        return $this->belongsTo('App\models\DetailSpt');
    }

    public function nameUser()
    {
        return $this->belongsTo('App\User');
    }

    public function laporanSpt()
    {
        return $this->belongsTo('App\models\LhpSpt', 'laporan_spt_id', 'id');
    }  

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function spt(){
        return $this->belongsTo('App\models\Spt');
    }

    public function check(){
        return $this->belongsTo('App\models\DetailSpt');
    }    

}
