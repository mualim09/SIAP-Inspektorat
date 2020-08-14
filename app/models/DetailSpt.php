<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class DetailSpt extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['spt_id', 'user_id', 'peran', 'status','status_dupak','unsur_dupak','isi_laporan_pemeriksaan','kode_temuan_id','jenis_laporan','file_laporan','filename','info_dupak'];
    protected $table = 'detail_spt';
    public $timestamps = false;
    protected $appends = ['kode_file_laporan'];

    protected $casts = [
        'isi_laporan_pemeriksaan' => 'array',
        'status' => 'array',
        'info_dupak' => 'array'
    ];

    public function spt(){
        return $this->belongsTo('App\models\Spt');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getLamaJamAttribute(){
        $lama = $this->lama;
        return $lama*6.5;
    }


    public function setLaporAttribute($value)
    {
        $isi_laporan_pemeriksaan = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['kode'])) {
                $isi_laporan_pemeriksaan[] = $array_item;
            }
        }

        $this->attributes['isi_laporan_pemeriksaan'] = json_encode($isi_laporan_pemeriksaan);
    } 

    public function setStatusAttribute($value)
    {
        $status = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['status'])) {
                $status[] = $array_item;
            }
        }

        $this->attributes['status'] = json_encode($status);
    }

    public function setInfoDupakAttribute($value)
    {
        $info_dupak = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['info_dupak'])) {
                $info_dupak[] = $array_item;
            }
        }

        $this->attributes['info_dupak'] = json_encode($info_dupak);
    }

    public function pemeriksaan()
    {
        return $this->hasMany('App\models\Laporan_pemeriksaan');
    }

    public function getKodeFileLaporanAttribute(){
        return $this->isi_laporan_pemeriksaan;
    }

}