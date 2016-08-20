<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $table = 'login_log';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'token', 'logged_in_datetime', 'logged_out_datetime'];
    public  $timestamps = false;
}
