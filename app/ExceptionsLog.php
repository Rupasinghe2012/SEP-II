<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExceptionsLog extends Model
{
    protected $table = 'exception_log';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'time', 'exception'];
    public  $timestamps = false;

}
