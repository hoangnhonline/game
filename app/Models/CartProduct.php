<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CartProduct extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cart_product';	

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
    protected $fillable = [ 
                            'name', 
                            'cart_id', 
                            'direction', 
                            'price',
                            'area',
                            'floor',
                            'no_room',
                            'no_wc',
                            'display_order',
                            'hoa_hong',
                            'status',
                            'user_id',
                            'notes'
                        ];
    
}
