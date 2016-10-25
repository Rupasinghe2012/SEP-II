<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class preorderItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'preorderItems';

    // Set primary key

    //protected $primaryKey = ['preorder_id', 'item_id'];
    protected $primaryKey = 'preorder_item_id';

    // Mention that this table does not have 'updated_at', 'created_at' fields
    public $timestamps = false;

    // Mutator for item_id, so that item_name, uvalue is retrieved

    public function setItemIdAttribute($value)
    {
    	$this->attributes['item_id'] = $value;
    	
        $item = DB::table('templates')->where('id', $value)->first();
    	
    	$this->attributes['item_name'] = $item->name;
    	$this->attributes['uvalue'] = $item->price;

    }

    // Get items for particular preorder

    public function scopePreorder($query, $preorder_id)
    {
        return $query->where('preorder_id', $preorder_id);
    }

}
