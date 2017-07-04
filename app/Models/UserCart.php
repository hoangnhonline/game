<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserCart extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_cart';	

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
    protected $fillable = [ 'user_id', 'cart_id' ];
        
}