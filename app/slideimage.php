<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class slideimage extends Model
{
    public $timestamps = true;
    protected $fillable = array('title','image');
}
