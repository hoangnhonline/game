<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tag';

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
    protected $fillable = ['meta_id', 'name', 'slug', 'type', 'description', 'alias', 'created_user', 'updated_user'];

    public function objects()
    {
        return $this->hasMany('App\Models\TagObjects', 'tag_id');
    }
    
}
