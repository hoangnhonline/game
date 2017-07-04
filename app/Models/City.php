<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class City extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'city';	

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
    protected $fillable = ['name', 'alias', 'display_order'];

    public function district(){
        return $this->hasMany('App\Models\District', 'city_id');
    }
}
