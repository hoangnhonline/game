<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Articles extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

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
    protected $fillable = ['title', 
                            'slug', 
                            'alias', 
                            'cate_id', 
                            'is_hot', 
                            'project_id', 
                            'tab_id', 
                            'status', 
                            'display_order', 
                            'description', 
                            'image_url', 
                            'content', 
                            'meta_id', 
                            'created_user', 
                            'updated_user'];
    public static function getListTag($id){
        $query = TagObjects::where(['object_id' => $id, 'tag_objects.type' => 2])
            ->join('tag', 'tag.id', '=', 'tag_objects.tag_id')            
            ->get();
        return $query;
   }
}
