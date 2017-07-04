<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CustomLink extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'custom_link';	

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
    protected $fillable = ['link_text', 'link_url', 'block_id', 'display_order'];
   
}
