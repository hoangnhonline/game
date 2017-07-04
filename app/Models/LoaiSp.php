<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LoaiSp extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'loai_sp';	

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
                        'slug', 
                        'alias',
                        'is_hot', 
                        'status', 
                        'display_order', 
                        'description', 
                        'meta_id',
                        'created_user',
                        'updated_user'
                        ];

    public function cates()
    {
        return $this->hasMany('App\Models\Cate', 'loai_id');
    }

    public function banners()
    {
        return $this->hasMany('App\Models\Banner', 'object_id')->where('object_type', 1);
    }

}
