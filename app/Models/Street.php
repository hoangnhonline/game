<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Street extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'street';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    protected $fillable = ['name', 'slug', 'prefix', 'district_id', 'display_order', 'city_id', 'id_dothi', 'status'];
}
