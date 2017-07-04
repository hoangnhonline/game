<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ward extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ward';	

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
    protected $fillable = ['name', 'slug', 'prefix', 'district_id', 'display_order', 'city_id', 'id_dothi', 'status', 'meta_id'];
}
