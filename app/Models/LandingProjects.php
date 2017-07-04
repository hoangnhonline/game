<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class LandingProjects extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'landing_projects';	

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
                            'image_url', 
                            'logo_url',
                            'address', 
                            'is_hot', 
                            'address_contact', 
                            'phone_contact',
                            'email_contact', 
                            'created_user', 
                            'updated_user',
                            'meta_id',
                            'description',
                            'status'
                            ];
   public static function getListTabProject($project_id){
        $query = ProjectTab::where('project_id', $project_id)
            ->join('tab', 'tab.id', '=', 'project_tab.tab_id')
            ->select('tab_id as id', 'name')
            ->get();
        return $query;
   }
   public function contents()
    {
        return $this->hasMany('App\Models\Articles', 'project_id');
    }
}
