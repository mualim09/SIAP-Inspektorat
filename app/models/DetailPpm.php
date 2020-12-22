<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DetailPpm extends Model
{
    protected $fillable = ['user_id', 'kode_kelompok','lama', 'unsur_dupak','info_dupak','nota_dinas'];
    protected $table = 'detail_ppm';
    protected $appends = [];
  	public $timestamps = false;
    protected $casts = [
        'info_dupak' => 'array'
    ];

  	public function users(){
    	return $this->belongsTo('App\User');
    }

    public function ppm(){
        return $this->belongsTo('App\models\Ppm','id_ppm');
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
}
