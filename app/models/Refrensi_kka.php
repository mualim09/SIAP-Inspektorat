<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Refrensi_kka extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'refrensi_kka';
    protected $fillable = ['refrens_kka', 'refrensi_lokasi'];

   
}
