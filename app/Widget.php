<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'user_id', 'code'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
