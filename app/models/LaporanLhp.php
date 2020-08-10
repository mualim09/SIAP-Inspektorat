<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LaporanLhp extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['kode_lhp','custom_date','spt_id','tujuan_pemeriksaan', 'ruang_lingkup_pemeriksaan', 'batasan_pemeriksaan','pendekatan_pemeriksaan','hasil_pemeriksaan','sebab_pemeriksaan','akibat_pemeriksaan','komentar_pemeriksaan','rekomendasi_pemeriksaan'];
    protected $table = 'laporan_lhp';
}
