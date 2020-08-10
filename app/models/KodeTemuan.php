<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KodeTemuan extends Model
{
    
    protected $fillable = ['kode', 'deskripsi', 'atribut'];
    protected $table = 'kode_temuan';
    protected $appends = ['select_deskripsi','kode_kelompok','jenis','select_supersub_kode'];
    protected $cast = [
    	'atribut' => 'array'
    ];
    public $timestamps = false;

    public function setAtributAttribute($value)
    {
        
        $this->attributes['atribut'] = json_encode($value);
    }

    public function getSelectDeskripsiAttribute()
    {
        return $this->kode .'. '. $this->deskripsi;
    }

    //return value must [kelompok].[subkelompok].[kode] (ie : 1.1.03)
    public function getSelectSupersubKodeAttribute(){
        //$arr = json_decode($this->attributes['atribut'],true);
        $arr = json_decode($this->atribut, true);
        $kelompok = $arr['kelompok'].'.';
        //$kel = $arr['kelompok'];
        $subkelompok = ($arr['subkelompok']) ? $arr['subkelompok'].'.' : '';
        $kode = $this->kode;
        return $kelompok.$subkelompok.$kode;
        //dd($arr);
    }

    public function getJenisAttribute()
    {
         $arr = json_decode($this->attributes['atribut'],true);
        if($arr['kelompok']!= null && $arr['subkelompok'] == null){
            $return =  $arr['kelompok'] .'. '. $this->kode .'. '.$this->deskripsi;
        }elseif($arr['kelompok']!= null && $arr['subkelompok'] != null){
            $return = $arr['kelompok'] .'. '. $arr['subkelompok'] .'. '. $this->kode .'. '.$this->deskripsi;
        }else{
            $return = $this->kode .'. '.$this->deskripsi;
        }
        return $return;
    }

    public function getKodeKelompokAttribute(){
        $arr = json_decode($this->attributes['atribut'],true);
        return $arr['kelompok'];
    }

    public function childs(){
        return $this->hasMany('App\models\KodeTemuan','parent_id','id') ;
    }
    /*public function subkelompok(){
        return $this->hasMany('App\models\KodeTemuan',['atribut->subkelompok'=>'kode'])->where('atribut->kelompok',$this->kelompok['kode']);
        //return KodeTemuan::where('atribut->subkelompok',$this->kelompok->kode)->where('atribut->subkelompok','kode')->get();
    }*/
}
