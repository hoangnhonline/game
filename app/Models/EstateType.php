<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EstateType extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'estate_type';	

	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'slug', 'type', 'display_order', 'status', 'meta_id'];
        
}