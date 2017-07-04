<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Project extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';	

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
                            'type', 
                            'district_id', 
                            'city_id', 
                            'address', 
                            'contact', 
                            'phone', 
                            'image_url', 
                            'ward_id',
                            'video_url', 
                            'description', 
                            'content', 
                            'hot', 
                            'longt',
                            'latt', 
                            'status', 
                            'meta_id',      
                            'id_dothi',                     
                            'display_order'
                        ];

    
}
