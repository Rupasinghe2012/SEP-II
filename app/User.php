<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status', 'BOD', 'address','job', 'mobile', 'fb','twiter','instagram','google','youtube','profile_pic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function widget()
    {
        return $this->hasMany('App\Widget');
    }

    public function notification()
    {
        return $this->hasMany('App\Notification');
    }
}
