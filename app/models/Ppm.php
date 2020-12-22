<?php

namespace App\models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Ppm extends Model
{
    protected $fillable = ['kegiatan', 'jenis_ppm','tgl_mulai', 'tgl_akhir','lama','nota_dinas'];
    protected $primaryKey = 'id';
    protected $table = 'ppm';
    protected $appends = ['periode',"format_kegiatan"];
  	public $timestamps = false;

  	public function detailPpm(){
        return $this->hasMany('App\models\DetailPpm', 'id_ppm');
    }

    public function getPeriodeAttribute(){
        $start = Carbon::parse($this->tgl_mulai)->formatLocalized('%d %b %Y');        
        return $start ;
    }

     public function getFormatKegiatanAttribute(){      
      $keg = "Program Pelatihan Mandiri (PPM) ". "\"".$this->kegiatan."\"";
      return $keg;
    }
}
