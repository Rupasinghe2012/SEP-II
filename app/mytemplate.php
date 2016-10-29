<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mytemplate extends Model
{
    protected $fillable = [
        'userid', 'templateid'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
