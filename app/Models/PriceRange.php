<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PriceRange extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'price_range';	

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'alias', 'from', 'to', 'loai_id'];
    
}
