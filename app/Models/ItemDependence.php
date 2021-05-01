<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $item_id
 * @property integer $independent_item_id
 * @property Item $item
 * @property Item $item
 */
class ItemDependence extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['item_id', 'independent_item_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function independentItems()
    {
        return $this->belongsTo('App\Item', 'independent_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Item','item_id');
    }
}
