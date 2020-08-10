<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class JenisSpt extends Model
{
    protected $fillable = ['name', 'sebutan', 'dasar', 'kode_kelompok', 'input','radio', 'kategori'];
    protected $table = 'jenis_spt';
    protected $appends = ['input_lokasi', 'input_tambahan', 'cek_radio', 'nama_sebutan'];
    protected $casts = [
        'input' => 'array',
        'radio' => 'array'
    ];

    public function spt(){
    	return $this->hasMany('App\models\Spt');
    }

    public function getInputLokasiAttribute(){
    	if(isset($this->input['lokasi'])){
            return ($this->input['lokasi'] == 1) ? true : false;
        }
        return false;
    }

    public function getInputTambahanAttribute(){
    	if(isset($this->input['tambahan'])){
            return ($this->input['tambahan'] == 1) ? true : false;
        }
        return false;
    }

    public function getCekRadioAttribute(){
        return ($this->radio[1] != null && $this->radio[2] != null) ? 1 : 0;
    }

    public function getNamaSebutanAttribute(){
        if(!is_null($this->sebutan)) {
            return $this->sebutan;
        }else{
            return $this->name;
        }
        
    }
}
