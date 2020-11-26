<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use DB;

//spatie media library
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['first_name','last_name', 'email', 'phone', 'password', 'nip', 'jabatan', 'pangkat','gelar','pendidikan','gelar','sex','jenis_auditor','tempat_lahir','tanggal_lahir', 'ruang'];
    protected $appends = ['full_name', 'full_name_gelar', 'formatted_pangkat'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ruang' => 'array',
        'pendidikan' => 'array',
        'tanggal_lahir' => 'datetime:d-m-Y',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getFullNameGelarAttribute(){
        $user = ucfirst($this->first_name) . ' ' . ucfirst($this->last_name) . ', ' .$this->gelar;
        return str_replace( ', , ', ', ', $user);
    }



    public function getTempatTanggalLahirAttribute(){
        $tanggal = Carbon::parse($this->tanggal_lahir);
        return ($this->tempat_lahir != null) ? $this->tempat_lahir.', '. $tanggal->formatLocalized('%d %B %Y') : $tanggal->formatLocalized('%d %B %Y');
    }

    public function getRuangJabatanAttribute(){

        return $this->ruang['nama'] . '/ ' . $this->ruang['jabatan'];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    public function profile(){
        return $this->hasOne('\App\models\Profile');
    }

    public function bisa(array $permissions):bool
    {
        return $this->hasAnyPermission($permissions);
    }


    /*public function setSerfikatAttribute($value)
    {
        $sertifikat = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['name'])) {
                $sertifikat[] = $array_item;
            }
        }

        $this->attributes['sertifikat'] = json_encode($sertifikat);
    }*/

    public function userSertifikat(){
        return $this->hasMany('App\models\Sertifikat');
    }
    public function dupak(){
      return $this->hasMany('App\models\Dupak');
    }

    //membership (to hide super admin visibility from another member )
    public function scopeMember($query){
        return $query->where('email','!=','admin@local.host');        
    }

    //relasi ke pejabat
    public function pejabat(){
        return $this->hasMany('App\models\Pejabat');
    }

    public function menuPpm()
    {
        // $plt_sekretaris = User::whereHas('pejabat', function($q){
        //     $q->where('name','Sekretaris')->whereNotNull('status');
        // })->first();

        $query = DB::table('pejabat')
                    ->join('users','pejabat.user_id','=','users.id')
                    ->whereNotNull('status')
                    ->get()
        ;
        // dd(!is_null($query));
        return $query;
    }

    public function detailPpm(){
        return $this->belongsTo('App\models\DetailPpm');
    }

    public function getFormattedPangkatAttribute()
    {        
        
        switch($this->pangkat){
            //golongan I
            case 'I/A':
                $pangkat = 'Juru Muda ('.$this->pangkat.')';
                break;
            case 'I/B':
                $pangkat = 'Juru Muda Tingkat 1 ('.$this->pangkat.')';
                break;
            case 'I/C':
                $pangkat = 'Juru ('.$this->pangkat.')';
                break;
            case 'I/D':
                $pangkat = 'Juru Tingkat 1 ('.$this->pangkat.')';
                break;

            //golongan II
            case 'II/A':
                $pangkat = 'Pengatur Muda ('.$this->pangkat.')';
                break;
            case 'II/B':
                $pangkat = 'Pengatur Muda Tingkat 1 ('.$this->pangkat.')';
                break;
            case 'II/C':
                $pangkat = 'Pengatur ('.$this->pangkat.')';
                break;
            case 'II/D':
                $pangkat = 'Pengatur Tingkat 1 ('.$this->pangkat.')';
                break;
            
            //golongan III
            case 'III/A':
                $pangkat = 'Penata Muda ('.$this->pangkat.')';
                break;
            case 'III/B':
                $pangkat = 'Penata Muda Tingkat 1 ('.$this->pangkat.')';
                break;
            case 'III/C':
                $pangkat = 'Penata ('.$this->pangkat.')';
                break;
            case 'III/D':
                $pangkat = 'Penata Tingkat 1 ('.$this->pangkat.')';
                break;

            //golongan IV
            case 'IV/A':
                $pangkat = 'Pembina ('.$this->pangkat.')';
                break;
            case 'IV/B':
                $pangkat = 'Pembina Tingkat 1 ('.$this->pangkat.')';
                break;
            case 'IV/C':
                $pangkat = 'Pembina Utama Muda ('.$this->pangkat.')';
                break;
            case 'IV/D':
                $pangkat = 'Pembina Utama Madya ('.$this->pangkat.')';
                break;
            case 'IV/E':
                $pangkat = 'Pembina Utama ('.$this->pangkat.')';
                break;

            default :
                $pangkat = $this->pangkat;
        }
        return $pangkat;
    }

}
