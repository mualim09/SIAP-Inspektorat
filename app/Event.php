<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{
    protected $fillable = ['title', 'start','end', 'info', 'created_at','updated_at'];
    protected $table = 'events';
    protected $appends = ['event_type', 'event_user_id', 'event_jenis', 'event_user_full_name'];
     protected $casts = [
        'info' => 'array',
    ];

    public function getEventTypeAttribute(){
    	return ( isset($this->info['type']) )  ? $this->info['type'] : null;
    }

    public function getEventUserIdAttribute(){
    	return ( isset($this->info['user_id']) ) ? $this->info['user_id'] : null;
    }

    public function getEventJenisAttribute(){
    	return ( isset($this->info['jenis']) ) ? $this->info['jenis'] : null;
    }

    public function getEventUserFullNameAttribute(){
    	if( $this->event_user_id ){
    		$user = User::findOrFail($this->event_user_id);
    		return $user->full_name;
    	}
    	return;
    }

    public function getTitleAttribute(){
        return '';
    }

   
}
