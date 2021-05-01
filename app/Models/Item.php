<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $item_type_id
 * @property integer $unit_measure_id
 * @property integer $company_id
 * @property string $name
 * @property string $specifics
 * @property float $availability_threshold
 * @property boolean $is_expirydate_applicable
 * @property boolean $is_item_dependent
 * @property string $created_at
 * @property string $updated_at
 * @property Company $company
 * @property ItemType $itemType
 * @property UnitMeasure $unitMeasure
 * @property Item[] $items
 */
class Item extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['item_type_id', 'unit_measure_id', 'company_id', 'name', 'specifics', 'availability_threshold', 'is_expirydate_applicable', 'is_item_dependent', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemType()
    {
        return $this->belongsTo('App\ItemType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitMeasure()
    {
        return $this->belongsTo('App\UnitMeasure');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_dependences', 'independent_item_id');
    }
}
