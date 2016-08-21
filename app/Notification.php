<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
//    protected $fillable = [
//        'description', 'price','temp_source','colour', 'name','temp_pic',
//    ];

    protected $table = "notification";


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}