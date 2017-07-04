<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Newsletter extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'newsletter';	

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
    protected $fillable = ['email', 'status', 'is_member', 'updated_user'];

}
