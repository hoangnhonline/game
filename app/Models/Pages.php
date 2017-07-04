<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pages extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

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
    protected $fillable = ['title', 'slug', 'alias', 'status', 'display_order', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'created_user', 'updated_user'];
    
}
