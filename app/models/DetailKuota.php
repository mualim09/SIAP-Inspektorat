<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


class DetailKuota extends Model
{
    public $timestamps = false;
    protected $fillable = ['tanggal', 'detail_kuota'];
    protected $table = 'kuota_kalender';
    protected $appends = ['jumlah_spt'];

    protected $cast = [
        'detail_kuota' => 'array',
    ];

   public function setDetailAttribute($value)
    {
        $detail = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['kode'])) {
                $detail[] = $array_item;
            }
        }

        $this->attributes['detail_kuota'] = json_encode($detail);
    } 
    public function getJumlahSptAttribute(){
        if(isset($this->detail_kuota['jumlah_spt'])){
            return $this->detail_kuota['jumlah_spt'];
        }
        return false;
    }

    
}
