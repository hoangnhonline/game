<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Settings extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'settings';	

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
    protected $fillable = ['site_title', 'site_description', 'site_keywords', 'admin_email', 'mail_login_name', 'mail_password', 'site_name', 'google_analystic', 'facebook_appid', 'google_fanpage', 'facebook_fanpage', 'twitter_fanpage', 'logo', 'favicon', 'home_banner'];
    
}