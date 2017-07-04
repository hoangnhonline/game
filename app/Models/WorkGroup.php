<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WorkGroup extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'work_group';	

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
    protected $fillable = [ 'name', 'description', 'status', 'created_user', 'updated_user'];
        
}