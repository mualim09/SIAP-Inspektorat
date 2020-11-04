<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use App\Common;
use App\Event;
use Code16\CarbonBusiness\BusinessDays;
// use App\models\Lokasi;

class SptUmum extends Model
{
	protected $primaryKey = 'id';
    protected $fillable = ['jenis_spt_umum', 'lokasi_id','info_untuk_umum', 'nomor', 'info_dasar_umum', 'tgl_mulai', 'tgl_akhir', 'lama','tgl_register','file','created_at','updated_at'];
    protected $table = 'spt_umum';
    protected $appends = ['periode','lokasi_spt'];
    protected $casts = [
        'lokasi_id' => 'array',
        'info' => 'array',
    ];

    // public function getTanggalMulaiAttribute(){
    //     $tanggal = Carbon::parse($this->tgl_mulai);
    //     return $tanggal->formatLocalized('%d %B %Y');
    // }

    //  public function getTanggalAkhirAttribute(){
    //     $tanggal = Carbon::parse($this->tgl_akhir);
    //     return $tanggal->formatLocalized('%d %B %Y');
    // }
    // 
    
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

    public function getPeriodeAttribute(){
        $start = Carbon::parse($this->tgl_mulai)->formatLocalized('%d %B');
        $end = Carbon::parse($this->tgl_akhir)->formatLocalized('%d %B %Y');
        return $start . ' s.d ' . $end;
    }

    public function detailSpt(){
        return $this->hasMany('App\models\DetailSpt');
    }

}