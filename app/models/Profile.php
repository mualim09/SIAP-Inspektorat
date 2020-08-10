<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Profile extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['user_id','address','country','city','zipcode','about'];

    public function user(){
    	return $this->belongsTo('\App\User');
    }

    //profile picture and cover
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->manualCrop(200, 200, 0, 0);
       
    }
}
