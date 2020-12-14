<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use App\Common;
use App\Event;
use App\models\JenisSpt;
use Code16\CarbonBusiness\BusinessDays;
use App\models\Lokasi;
/*use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;*/

class Spt extends Model
{
    //use HasMediaTrait;
    protected $fillable = ['jenis_spt_id', 'lokasi_id', 'nomor', 'tgl_mulai', 'tgl_akhir', 'lama','tambahan','info'];
    protected $table = 'spt';
    protected $appends = ['periode','lama_hari','lokasi_spt','info_lanjutan','periodekka','kegiatan'];
    protected $casts = [
        'lokasi_id' => 'array',
        'info' => 'array',
    ];

    public function getKegiatanAttribute(){
      $keg_id = $this->jenis_spt_id;
      $keg = JenisSpt::select(['name', 'sebutan'])->where('id', $keg_id)->first();
      return $keg;
    }

    public function getTanggalMulaiAttribute(){
        $tanggal = Carbon::parse($this->tgl_mulai);
        return $tanggal->formatLocalized('%d %B %Y');
    }

     public function getTanggalAkhirAttribute(){
        $tanggal = Carbon::parse($this->tgl_akhir);
        return $tanggal->formatLocalized('%d %B %Y');
    }

    public function getPeriodeAttribute(){
        $start = Carbon::parse($this->tgl_mulai)->formatLocalized('%d %b');
        $end = Carbon::parse($this->tgl_akhir)->formatLocalized('%d %b %Y');
        return $start . ' s.d ' . $end;
    }

    public function getPeriodeKKAAttribute(){
        $start = Carbon::parse($this->tgl_mulai)->formatLocalized('%B');
        $end = Carbon::parse($this->tgl_akhir)->formatLocalized('%B %Y');
        return $start . ' s.d ' . $end;
    }

    public function getLamaHariAttribute(){
        $lama = $this->lama;
        $common = new Common;
        $lama_hari = $lama . ' (' . $common->terbilang($lama) . ') hari';
        return $lama_hari;
    }

    public function getLokasiSptAttribute(){
        $lokasi_id = $this->lokasi_id;
        if( $lokasi_id != null ){
            $nama_lokasi = '';
            $lokasi = Lokasi::findOrFail($lokasi_id);
            for($i=0;$i<count($lokasi_id);$i++){
                $separator = ($i === (count($lokasi_id)-2) ) ? ' dan ' : ', ';
                $nama_lokasi .= $lokasi[$i]->nama_lokasi . $separator;
            }
            $nama_lokasi = rtrim($nama_lokasi, ", ");
            return $nama_lokasi;
        }
    }

    public function getInfoLanjutanAttribute(){

        return (isset($this->info['lanjutan'])) ? $this->info['lanjutan'] : 'undefined';
    }

    //relationship
    public function jenisSpt(){
        return $this->belongsTo('App\models\JenisSpt');
    }

    public function detailSpt(){
        return $this->hasMany('App\models\DetailSpt');
    }

    public function delete(){
        $this->detailSpt()->delete();
        return parent::delete();
    }

    public function by(){
        return $this->belongsTo('App\User','approval_by');
    }

    public function lokasi(){
        return $this->hasMany('App\models\Lokasi');
    }

}
