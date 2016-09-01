<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'location_id', 'department_id', 'email', 'user_type', 'status', 'android_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department(){
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function location(){
        return $this->belongsTo('App\Location', 'location_id', 'id');
    }
}
