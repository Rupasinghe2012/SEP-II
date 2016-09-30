<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preorder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'preorders';

    // Set primary key

    protected $primaryKey = 'preorder_id'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'status'];

    // Pending orders

    public function scopePending($query)
    {
        return $query->whereStatus('Pending');
    }

    // History

    public function scopeHistory($query)
    {
        return $query->whereIn('status', ['Completed', 'Cancelled', 'Rejected']);
    }

    public function scopeCompleted($query)
    {
        return $query->whereStatus('Completed');
    }

    public function scopeCancelled($query)
    {
        return $query->whereStatus('Cancelled');
    }

    public function scopeRejected($query)
    {
        return $query->whereStatus('Rejected');
    }


}
