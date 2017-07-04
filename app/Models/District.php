<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class District extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'district';	

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
    protected $fillable = [ 'name', 'slug', 'city_id', 'display_order', 'meta_id'];

    public function ward(){
        return $this->hasMany('App\Models\Ward', 'district_id');
    }
}
