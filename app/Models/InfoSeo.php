<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class InfoSeo extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'info_seo';	

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
    protected $fillable = ['title', 'url', 'keywords', 'description', 'image_url', 'custom_text'];
    
}
