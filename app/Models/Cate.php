<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cate extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cate';	

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
    protected $fillable = ['name', 'slug', 'alias', 'loai_id', 'is_hot', 'status', 'display_order', 'description', 'meta_id', 'created_user', 'updated_user'];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cate_id');
    }
    
}
