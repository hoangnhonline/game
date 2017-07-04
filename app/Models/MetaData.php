<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MetaData extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'meta_data';	

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
    protected $fillable = ['title', 'description', 'keywords', 'custom_text', 'created_user', 'updated_user'];
 
}
