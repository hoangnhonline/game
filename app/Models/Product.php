<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product';	

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
                            'description', 
                            'loai_id', 
                            'cate_id', 
                            'price',                           
                            'content', 
                            'alias', 
                            'thumbnail_id',                           
                            'status', 
                            'in_stock', 
                            'is_hot', 
                            'display_order',
                            'meta_id',                            
                            'created_user',
                            'updated_user'
                        ];

    public static function productTag( $id )
    {
        $arr = [];
        $rs = TagObjects::where( ['type' => 1, 'object_id' => $id] )->lists('tag_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    public static function productTienIch( $id )
    {
        $arr = [];
        $rs = TagObjects::where( ['type' => 3, 'object_id' => $id] )->lists('tag_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    public static function productTienIchName( $id )
    {
        $arr = [];
        $rs = TagObjects::where( ['tag_objects.type' => 3, 'tag_objects.object_id' => $id] )
            ->join('tag', 'tag.id', '=', 'tag_objects.tag_id')
            ->select('tag.*')->get();
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    public static function getListTag($id){
        $query = TagObjects::where(['object_id' => $id, 'tag_objects.type' => 1])
            ->join('tag', 'tag.id', '=', 'tag_objects.tag_id')            
            ->get();
        return $query;
   }
    
}
