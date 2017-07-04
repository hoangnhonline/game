<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contact extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contact';	

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
    protected $fillable = ['type', 'title', 'full_name', 'email', 'phone', 'content', 'status', 'updated_user', 'gender'];
    
}
