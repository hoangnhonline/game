<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hash;
use App\Models\Settings;
use App\Models\LoaiSp;
use App\Models\Cate;
use App\Models\CustomLink;
use App\Models\Product;

class ViewComposerServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call function composerSidebar
		$this->composerMenu();	
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Composer the sidebar
	 */
	private function composerMenu()
	{
		
		view()->composer( '*' , function( $view ){		
			$banList = $thueList = [];	
			
	        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
	        $loaiSpList = LoaiSp::where('status', 1)->orderBy('display_order', 'asc')->get();
	        foreach($loaiSpList as $loaiSp){
	        	$cateList[$loaiSp->id] = Cate::where(['status' => 1, 'loai_id' => $loaiSp->id])->orderBy('display_order', 'asc')->get();
	        }        
	        $gameHotList = Product::where('product.slug', '<>', '')                  
		                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')            
		                    ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')      
		                    ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai', 'loai_sp.name as ten_loai')		
		                    ->where('product.is_hot', 1)                   
		                    ->where('product.loai_id', 1)
		                    ->orderBy('product.id', 'desc')->limit(5)->get();
		    $appHotList = Product::where('product.slug', '<>', '')                  
		                    ->leftJoin('product_img', 'product_img.id', '=','product.thumbnail_id')            
		                    ->join('loai_sp', 'loai_sp.id', '=','product.loai_id')      
		                    ->select('product_img.image_url as image_url', 'product.*', 'loai_sp.slug as slug_loai', 'loai_sp.name as ten_loai')		
		                    ->where('product.is_hot', 1)                   
		                    ->where('product.loai_id', 2)
		                    ->orderBy('product.id', 'desc')->limit(5)->get();                
		    $customLink = CustomLink::where('block_id', 1)->orderBy('display_order', 'asc')->get();
		    $cateHot = Cate::where('loai_id', 1)
		    		->join('loai_sp', 'cate.loai_id', '=', 'loai_sp.id')
		    		->select('cate.*', 'loai_sp.slug as slug_loai')
		    		->orderBy('is_hot', 'desc')
		    		->get();
			$view->with([
							'settingArr' => $settingArr, 
							'loaiSpList' => $loaiSpList, 
							'cateList' => $cateList,
							'gameHotList' => $gameHotList,
							'appHotList' => $appHotList,
							'customLink' => $customLink,
							'cateHot' => $cateHot
						]);
			
		});
	}
	
}
